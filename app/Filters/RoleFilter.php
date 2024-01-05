<?php

namespace App\Filters;

use App\Filters\Main\BaseFilter;
use Illuminate\Database\Eloquent\Builder;

class RoleFilter extends BaseFilter
{
    protected function attributesMap(): array
    {
        return [
            'id',
            'name'
        ];
    }

    protected function search(Builder $builder, string $keyword): Builder
    {
        return $builder;
    }

    function defaultOrder(Builder $builder): Builder
    {
        return $builder;
    }

    protected function TableName(): string
    {
        return 'roles';
    }
}
