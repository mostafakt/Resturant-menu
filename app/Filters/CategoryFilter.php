<?php

namespace App\Filters;


use App\Filters\Main\BaseFilter;
use App\Filters\Main\ICanGetAll;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\MorphToMany;


class CategoryFilter extends BaseFilter implements ICanGetAll
{
    protected function attributesMap(): array
    {
        $locale = app()->getLocale();

        return [
            'id',
            'name' => 'name->' . $locale,
            'note' => 'note->' . $locale,
            'order',
            'parentId' => 'parent_id',
            'grandId' => 'grand_id',
            'child'
        ];
    }

    protected function search(Builder $builder, string $keyword): Builder
    {
        $builder->where(function ($query) use ($keyword) {
            $query->orwhereRaw('LOWER(JSON_EXTRACT(categories.name, "$.en")) like ?', ['%' . $keyword . '%'])
                ->orwhereRaw('LOWER(JSON_EXTRACT(categories.name, "$.ar")) like ?', ['%' . $keyword . '%']);
        });

        return $builder;
    }

    public function paginate(Builder|MorphToMany $builder, ?int $page, ?int $perPage): Builder|MorphToMany
    {
        if ($perPage && $perPage == -1 && $this instanceof ICanGetAll) {
            return $builder;
        }

        if (!$perPage || $perPage == -1) {
            $perPage = $builder->getModel()->getPerPage();
        }

        return $builder->skip($perPage * ($page - 1))->take($perPage);
    }

    public function childFilter(Builder $builder, string $column, $operation, mixed $value): Builder
    {
        if ($value) {
            $builder->where('grand_id', '!=', null)
                ->where('parent_id', '!=', null);
        }
        return $builder;
    }

    function defaultOrder(Builder $builder): Builder
    {
        return parent::addOrder($builder,'order');
    }

    protected function TableName(): string
    {
        return 'categories';
    }

}
