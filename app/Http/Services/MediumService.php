<?php

namespace App\Http\Services;

use App\Http\Services\Base\CrudService;
use App\Models\Base\BaseModel;
use App\Models\Medium;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;

class MediumService extends CrudService
{
    protected function getModelClass(): string
    {
        return Medium::class;
    }

    public function create(array $data): BaseModel
    {
        /** @var UploadedFile $medium */
        $medium = $data['medium'];

        $path = 'media/' . str_replace('-', '/', $data['for']);
        $mediumName = $medium->hashName();
        $extension = $medium->extension();

        $medium->storeAs(
            $path,
            $mediumName . '.' . $extension,
            ['disk' => 'public']
        );

        return parent::create([
            'path' => $path . '/' . $mediumName . '.' . $extension,
            'extension' => $extension,
            'for' => $data['for'],
            'type' => $data['type'],
        ]);
    }

    public function createMultiple($data): array
    {
        return DB::transaction(function () use ($data) {
            $media = [];
            foreach ($data['media'] as $medium) {
                $media[] = $this->create($medium);
            }

            return $media;
        });
    }
}
