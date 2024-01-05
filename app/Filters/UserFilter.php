<?php

namespace App\Filters;

use App\Filters\Main\BaseFilter;
use App\Filters\Main\FilterOperation;
use App\Filters\Main\ICanGetAll;
use Illuminate\Database\Eloquent\Builder;

class UserFilter extends BaseFilter implements ICanGetAll
{
    protected function attributesMap(): array
    {
        return [
            'firstName' => 'first_name',
            'lastName' => 'first_name',
            'email',
            'mobile',
            'phone',
            'note',
            'status',

        ];
    }

    protected function testFilter(Builder $builder, string $column, $operation, mixed $value): Builder
    {
        return parent::addFilter($builder, $column, $operation, $value);
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
        return 'users';
    }
}
