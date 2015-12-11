<?php namespace App\Repositories;

use App\Attribute;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AttributeRepository extends EloquentRepository {

    /**
     * Find an attribute by id.
     *
     * @param int $id
     * @return Attribute
     * @throws ModelNotFoundException
     */
    public function findById($id)
    {
        return Attribute::findOrFail($id);
    }

    /**
     * Returns a paginated attribute index.
     *
     * @param null|string $q
     * @return Paginator
     */
    public function query($q = null)
    {
        return Attribute::where(function ($query) use ($q) {
                if ($q) {
                    $query->where('description', 'like', "%{$q}%");
                }
            })
            ->orderBy('description')
            ->paginate();
    }

    /**
     * Returns a collection with all attributes.
     *
     * @return Collection
     */
    public function all()
    {
        return Attribute::orderBy('description')->get();
    }

}
