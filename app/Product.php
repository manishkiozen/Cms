<?php namespace App;

use App\Presentation\ProductPresenter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use McCool\LaravelAutoPresenter\HasPresenter;

class Product extends Model implements HasPresenter {

    use SoftDeletes;

	protected $table = 'products';

    protected $fillable = [
        'product_type_id',
        'product_number', 'ean',
        'description', 'detailed_description',
        'can_be_purchased', 'supplier_id', 'delivery_time', 'purchase_price',
        'can_be_sold', 'vat_rate_id', 'selling_price', 'recommended_retail_price',
    ];

    /**
     * Returns the assigned attributes.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function attributes()
    {
        return $this->belongsToMany(Attribute::class, 'attribute_product')->withPivot('value');
    }

    /**
     * Returns the product type.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function productType()
    {
        return $this->belongsTo(ProductType::class, 'product_type_id');
    }

    /**
     * Returns the assigned VAT rate.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vatRate()
    {
        return $this->belongsTo(VatRate::class, 'vat_rate_id');
    }

    /**
     * Registers a new product.
     *
     * @param string $product_number
     * @param string $description
     * @param int $product_type_id
     * @return static
     */
    public static function register($product_number, $description, $product_type_id)
    {
        return new static(compact('product_number', 'description', 'product_type_id'));
    }

    /**
     * Get the presenter class.
     *
     * @return string
     */
    public function getPresenterClass()
    {
        return ProductPresenter::class;
    }

}
