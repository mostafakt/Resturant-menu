<?php

namespace App\Models\Base;

use Illuminate\Database\Query\Builder;

class BaseQueryBuilder extends Builder
{
    public function join($table, $first, $operator = null, $second = null, $type = 'inner', $where = false)
    {
        if ($this->isJoinExists($table)) {
            return $this;
        }

        return parent::join($table, $first, $operator, $second, $type, $where);
    }

    public function isJoinExists($table): bool
    {
        $joins = collect($this->joins);
        return $joins->pluck('table')->contains($table);
    }
}
