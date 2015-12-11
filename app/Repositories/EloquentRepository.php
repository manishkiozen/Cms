<?php namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class EloquentRepository {

    /**
     * Saves an Eloquent model.
     *
     * @param Model $model
     * @return bool
     */
    public function save(Model $model)
    {
        return $model->save();
    }

    /**
     * Deletes an Eloquent model.
     *
     * @param Model $model
     * @return bool|null
     * @throws \Exception
     */
    public function destroy(Model $model)
    {
        return $model->delete();
    }

}
