<?php namespace App\Repositories;

use App\Carrier;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CarrierRepository extends EloquentRepository {

    /**
     * Finds a carrier by id.
     *
     * @param int $id
     * @return Carrier
     * @throws ModelNotFoundException
     */
    public function findById($id)
    {
        return Carrier::findOrFail($id);
    }

    /**
     * Finds the default carrier.
     *
     * @return Carrier
     * @throws ModelNotFoundException
     */
    public function findDefaultCarrier()
    {
        return Carrier::where('is_default_carrier', '=', 1)->firstOrFail();
    }

    /**
     * Queries the carrier table.
     *
     * @param string|null $q
     * @return Paginator
     */
    public function query($q = null)
    {
        return Carrier::where(function ($query) use ($q) {
                if ($q) {
                    $query->where('name', 'like', "%{$q}%");
                }
            })
            ->orderBy('name')
            ->paginate();
    }

    /**
     * Returns a collection with all carriers.
     *
     * @return Collection
     */
    public function all()
    {
        return Carrier::orderBy('name')->get();
    }

}
