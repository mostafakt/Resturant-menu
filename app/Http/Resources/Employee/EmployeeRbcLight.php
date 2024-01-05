<?php

namespace App\Http\Resources\Employee;

use App\Http\Resources\Base\BaseJsonResource;

class EmployeeRbcLight extends BaseJsonResource
{
    protected static function relations(): array
    {
        return [

        ];
    }

    public function toArray($request): array
    {
        return [
            'id' => $this->user_id,
            //todo
        ];
    }
}
