<?php

namespace App\Models\Base;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Wildside\Userstamps\Userstamps;

/**
 * @method static findOrFail(int $id)
 */
abstract class BaseModel extends Model
{
    use Userstamps, HasTranslations;

    protected array $translatable = [];
    protected $spatialFields;
    protected function newBaseQueryBuilder(): BaseQueryBuilder
    {
        $connection = $this->getConnection();

        return new BaseQueryBuilder(
            $connection, $connection->getQueryGrammar(), $connection->getPostProcessor()
        );
    }

    public static function usingSoftDeletes()
    {
        $usingSoftDeletes = null;

        if (is_null($usingSoftDeletes)) {
            return $usingSoftDeletes = in_array('Illuminate\Database\Eloquent\SoftDeletes', class_uses_recursive(get_called_class()));
        }

        return $usingSoftDeletes;
    }
}
