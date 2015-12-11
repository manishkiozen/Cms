<?php namespace App\Repositories;

use App\ProductType;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProductTypeRepository extends EloquentRepository {

    /**
     * Finds a product type by id.
     *
     * @param int $id
     * @param bool $with_attributes
     * @return ProductType
     * @throws ModelNotFoundException
     */
    public function findById($id, $with_attributes = false)
    {
        return $with_attributes
            ? ProductType::with('attributes')->findOrFail($id)
            : ProductType::findOrFail($id);
    }

    /**
     * Queries the product types.
     *
     * @param string $q
     * @return Collection
     */
    public function query($q = null)
    {
        return ProductType::where(function ($query) use ($q) {
                $query->where('description', 'like', "%{$q}%");
            })
            ->orderBy('description')
            ->get();
    }

    /**
     * Returns a collection with all product types.
     *
     * @return Collection
     */
    public function all()
    {
        return ProductType::orderBy('description')->get();
    }

}
