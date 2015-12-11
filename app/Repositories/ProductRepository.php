<?php namespace App\Repositories;

use App\Product;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProductRepository extends EloquentRepository {

    /**
     * Finds a product by it's id.
     * @param int $id
     * @return Product
     * @throws ModelNotFoundException
     */
    public function findById($id)
    {
        return Product::findOrFail($id);
    }

    /**
     * Finds a product by product number.
     *
     * @param string $product_number
     * @return Product
     * @throws ModelNotFoundException
     */
    public function findByProductNumber($product_number)
    {
        return Product::where('product_number', '=', $product_number)->firstOrFail();
    }

    /**
     * Returns a paginated product index.
     *
     * @param string $q
     * @return Paginator
     */
    public function query($q = null)
    {
        return Product::where(function ($query) use ($q) {
            foreach (explode(' ', $q) as $keyword) {
                $query->where('product_number', '=', $q)
                    ->orWhere('description', 'like', "%{$keyword}%");
            }
        })->paginate();
    }

}
