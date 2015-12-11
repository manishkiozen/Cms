<?php namespace App\Repositories;

use App\Country;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CountryRepository extends EloquentRepository {

    /**
     * Find a country by id.
     *
     * @param int $id
     * @return Country
     * @throws ModelNotFoundException
     */
    public function findById($id)
    {
        return Country::findOrFail($id);
    }

    /**
     * Finds a country by ISO 3361-1 alpha-2 code.
     *
     * @param string $iso_code_2
     * @return Country
     * @throws ModelNotFoundException
     */
    public function findByIsoCode2($iso_code_2)
    {
        return Country::where('iso_code_2', '=', $iso_code_2)->firstOrFail();
    }

    /**
     * Returns a paginated country index.
     *
     * @param null|string $q
     * @return Paginator
     */
    public function query($q = null)
    {
        return Country::where(function ($query) use ($q) {
            if (strlen($q) == 2) {
                $query->orWhere('iso_code_2', '=', $q);
            } elseif ($q) {
                $query->where('name', 'like', "%{$q}%");
            }
        })->orderBy('name')
        ->paginate();
    }

    /**
     * Returns a collection with all countries.
     *
     * @return Collection
     */
    public function all()
    {
        return Country::orderBy('name')->get();
    }

}
