<?php

namespace App\Traits;

trait CheckOwnership
{
    public function checkOwner($modelName, $id, $column_name = 'user_id'): bool
    {
        $model = new $modelName;
        if ($model::find($id)->$column_name == auth()->user()->id) {
           return true;
        }
        return false;
    }
}
