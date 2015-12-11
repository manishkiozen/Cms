<?php namespace App\Repositories;

class ControlPanelLinkRepository {

    protected $items = [];

    public function __construct()
    {
        $this->items['attribute.index'] = trans('attributes.index');
        $this->items['carrier.index'] = trans('carriers.index');
        $this->items['country.index'] = trans('countries.index');
        $this->items['product-type.index'] = trans('product-types.index');
        $this->items['shipping-rule.index'] = trans('shipping-rules.index');
        $this->items['supplier.index'] = trans('suppliers.index');
        $this->items['vat-rate.index'] = trans('vat-rates.index');
    }

    /**
     * Returns an array with all control panel links.
     *
     * @return array
     */
    public function all()
    {
        return $this->items;
    }

    /**
     * Sorts the control panel links.
     *
     * @param string $what Possible values are [ description | route ]
     * @param int $direction
     * @return $this
     */
    public function sort($what, $direction = SORT_ASC)
    {
        switch ($what) {
            case 'description':
                asort($this->items, $direction);
                break;
            case 'route':
                ksort($this->items, $direction);
                break;
        }
        return $this;
    }

}
