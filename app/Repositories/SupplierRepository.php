<?php namespace App\Repositories;

use App\Supplier;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;

class SupplierRepository extends EloquentRepository {

    /**
     * Finds a supplier by id.
     *
     * @param int $id
     * @return Supplier
     */
    public function findById($id)
    {
        return Supplier::findorFail($id);
    }

    /**
     * Returns a collection with all suppliers.
     *
     * @return Collection
     */
    public function all()
    {
        return Supplier::orderBy('name')->get();
    }

    /**
     * Returns a paginated supplier index.
     *
     * @param string $q
     * @return Paginator
     */
    public function query($q)
    {
        return Supplier::where(function ($query) use ($q) {
                if ($q) {
                    $query->where('name', 'like', "%{$q}%");
                }
            })
            ->orderBy('name')
            ->paginate();
    }

}
