<?php namespace App\Repositories;

use App\AttributeValue;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AttributeValueRepository extends EloquentRepository {

    /**
     * Find an attribute by id.
     *
     * @param int $id
     * @return AttributeValue
     * @throws ModelNotFoundException
     */
    public function findById($id)
    {
        return AttributeValue::findOrFail($id);
    }

}
