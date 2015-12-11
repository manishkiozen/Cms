<?php namespace App\Repositories;

use App\VatRate;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class VatRateRepository extends EloquentRepository {

    /**
     * Finds a VAT rate by id.
     *
     * @param int $id
     * @return VatRate
     * @throws ModelNotFoundException
     */
    public function findById($id)
    {
        return VatRate::findOrFail($id);
    }

    /**
     * Queries the VAT rate table.
     *
     * @param string $q
     * @return Paginator
     */
    public function query($q)
    {
        return VatRate::where('description', 'like', "%{$q}%")
            ->orderBy('description')->paginate();
    }

    /**
     * Returns a collection with all VAT rates.
     *
     * @return Collection
     */
    public function all()
    {
        return VatRate::orderBy('description')->get();
    }

}
