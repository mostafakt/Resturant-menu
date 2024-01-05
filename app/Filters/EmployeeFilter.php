<?php

namespace App\Filters;


use App\Filters\Main\BaseFilter;
use App\Filters\Main\FilterOperation;
use App\Filters\Main\ICanGetAll;
use Illuminate\Database\Eloquent\Builder;


class EmployeeFilter extends BaseFilter implements ICanGetAll
{
    protected function attributesMap(): array
    {
        return [
            'id' => 'user_id',
            'createdBy' => 'created_by',
            'updatedBy' => 'updated_by',
            'firstName' => 'first_name',
            'lastName' => 'last_name',
            'address',
            'status',
            'role',

        ];
    }

    protected function roleFilter(Builder $builder, string $column, FilterOperation $operation, mixed $value): Builder
    {

        $builder->addSelect('employees.*')
            ->leftJoin('users','users.id', '=','employees.user_id')
            ->leftJoin('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->leftJoin('roles', 'roles.id', '=', 'model_has_roles.role_id');
        return parent::addFilter($builder, 'roles.id', $operation, $value);
    }

    protected function search(Builder $builder, string $keyword): Builder
    {
        $builder->join('users', 'employees.user_id', '=', 'users.id')
            ->where(function ($query) use ($keyword) {
                $query->orwhereRaw('LOWER(users.first_name) like ?', ['%' . $keyword . '%'])
                    ->orwhereRaw('LOWER(users.last_name) like ?', ['%' . $keyword . '%']);
            });

        return $builder;
    }

    public function statusFilter(Builder $builder, string $column, $operation, mixed $value): Builder
    {
        $builder->join('users', 'employees.user_id', '=', 'users.id');

        return parent::addFilter($builder, 'users.status', $operation, $value);

    }

    function defaultOrder(Builder $builder): Builder
    {
        return $builder;
    }

    function firstNameOrder(Builder $builder, $column, $direction): Builder
    {
        $builder->join('users', 'employees.user_id', '=', 'users.id')->orderBy('first_name',$direction);

        return $builder;
    }function lastNameOrder(Builder $builder, $column, $direction): Builder
    {
        $builder->join('users', 'employees.user_id', '=', 'users.id')->orderBy('last_name', $direction);

        return $builder;
    }

    protected function TableName(): string
    {
        return 'employees';
    }

}
