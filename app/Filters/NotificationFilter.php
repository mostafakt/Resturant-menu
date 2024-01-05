<?php

namespace App\Filters;


use App\Filters\Main\BaseFilter;
use App\Filters\Main\ICanGetAll;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\MorphMany;


class NotificationFilter extends BaseFilter
{
   protected function attributesMap(): array
   {
        return [
            'id',
            'title',
            'body',

            'createdAt' => 'created_at',
            'updatedAt' => 'updated_at',
            'deletedAt' => 'deleted_at',
            'createdBy' => 'created_by',
            'updatedBy' => 'updated_by',
            'deletedBy' => 'deleted_by',
        ];
   }

   protected function search(Builder $builder, string $keyword): Builder
   {
          return $builder;
   }

   function defaultOrder(Builder $builder): Builder
   {
       return parent::addOrder($builder, 'id');
   }

   protected function TableName(): string
   {
        return 'notifications';
   }

    public function paginate(Builder|MorphMany $builder, ?int $page, ?int $perPage): Builder|MorphMany
    {
        if ($perPage && $perPage == -1 && $this instanceof ICanGetAll) {
            return $builder;
        }

        if (!$perPage || $perPage == -1) {
            $perPage = $builder->getModel()->getPerPage();
        }

        return $builder->skip($perPage * ($page - 1))->take($perPage);
    }

}
