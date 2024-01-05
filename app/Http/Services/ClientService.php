<?php

namespace App\Http\Services;

use App\Http\Services\Base\CrudService;
use App\Models\Base\BaseModel;
use App\Models\Client;
use App\Models\Points;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class ClientService extends CrudService
{

    public function update(mixed $id, array $data): BaseModel
    {
        $dataClient = $this->dataClient($data);
        $dataUser = $this->dataUser($data);

        /** @var Client $client */
        $client = parent::update($id, $dataClient);
        $this->setDisease($client, $data['diseaseId'] ?? null);
        $client->user()->update($dataUser);
        return $client;
    }

    public function setDisease(Client $client, $disease)
    {
        if (isset($disease)) {
            $client->diseases()->sync($disease);
        }
    }

    public function dataClient(array $data)
    {
        $dataClient = [];

        if (isset($data['blood_type'])) {
            $dataClient['blood_type'] = $data['blood_type'];
        }
        if (isset($data['birth_date'])) {
            $dataClient['birth_date'] = $data['birth_date'];
        }
        if (isset($data['city_id'])) {
            $dataClient['city_id'] = $data['city_id'];
        }
        if (isset($data['weight'])) {
            $dataClient['weight'] = $data['weight'];
        }
        if (isset($data['height'])) {
            $dataClient['height'] = $data['height'];
        }
        if (isset($data['health_status'])) {
            $dataClient['health_status'] = $data['health_status'];
        }
        return $dataClient;
    }

    public function dataUser(array $data)
    {
        $dataUser = [];

        if (isset($data['gender'])) {
            $dataUser['gender'] = $data['gender'];
        }
        if (isset($data['first_name'])) {
            $dataUser['first_name'] = $data['first_name'];
        }
        if (isset($data['last_name'])) {
            $dataUser['last_name'] = $data['last_name'];
        }
        if (isset($data['image_id'])) {
            $dataUser['image_id'] = $data['image_id'];
        }
        if (isset($data['mobile'])) {
            $dataUser['mobile'] = $data['mobile'];
        }
        if (isset($data['phone'])) {
            $dataUser['phone'] = $data['phone'];
        }
        if (isset($data['note'])) {
            $dataUser['note'] = $data['note'];
        }
        if (isset($data['status'])) {
            $dataUser['status'] = $data['status'];
        }
        if (isset($data['email'])) {
            $dataUser['email'] = $data['email'];
        }

        return $dataUser;
    }

    public function updateProfile(array $data,int $clientId): BaseModel
    {
        /** @var Client $client */
        $client = parent::update($clientId, $data);

        $this->setDisease($client, $data['diseaseId'] ?? null);

        return $client->refresh();
    }

    public function pointsDeduct(mixed $clientId, int $numberOfPoints)
    {
        $points = null;
        DB::transaction(function () use ($clientId, $numberOfPoints, &$points) {

            $tempNumberOfPoints = $numberOfPoints;
            /** @var  $client Client */
            $client = Client::query()->findOrFail($clientId);
            abort_if($client->active_points < $numberOfPoints, 422, __('exceptions.discount_code.not_enough_points'));
            $client->active_points = $client->active_points - $numberOfPoints;
            $client->all_points = $client->all_points + $numberOfPoints;
            $client->save();
            $points = $client->points()->where('current_points_numbers', '!=', 0)
                ->orderBy('created_at', 'asc')
                ->get();
            /** @var  $point Points */
            foreach ($points as $point) {

                if (0 >= $tempNumberOfPoints) {
                    break;
                } else {

                    if ($point['current_points_numbers'] >= $tempNumberOfPoints) {

                        $point->update(['current_points_numbers' => $point['current_points_numbers'] - $tempNumberOfPoints]);
                        $tempNumberOfPoints = 0;
                    } else {

                        $point->update(['current_points_numbers' => 0]);
                        $tempNumberOfPoints = $tempNumberOfPoints - $point['current_points_numbers'];

                    }
                    $point->save();

                }

            }
        });
        return $points;
    }

    protected function getModelClass(): string
    {
        return Client::class;
    }


}
