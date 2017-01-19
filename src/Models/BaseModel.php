<?php

namespace SkyMaxLab\Models;

use Illuminate\Database\Eloquent\Model;
use SkyMaxLab\Traits\HasEnums;
use Yadakhov\InsertOnDuplicateKey;

/**
 * Class BaseModel.
 */
class BaseModel extends Model
{
    use InsertOnDuplicateKey;
    use HasEnums;

    protected $guarded = [];

    /**
     * Get an instance of the model.
     *
     * @return Model
     */
    public static function getInstance()
    {
        $class = get_called_class();

        return new $class();
    }

    /**
     * Get map of two columns.
     *
     * @param $column1
     * @param $column2
     *
     * @return array
     */
    public static function getMap($column1, $column2)
    {
        $model = get_called_class();

        $rows = $model::distinct()->select($column1, $column2)->get();

        $out = [];

        foreach ($rows as $row) {
            $out[$row->{$column1}] = $row->{$column2};
        }

        return $out;
    }
}
