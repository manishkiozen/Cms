<?php namespace App\Presentation;

use Illuminate\Contracts\Config\Repository;

class Money {

    /**
     * @var Repository
     */
    protected $config;

    /**
     * @var Number
     */
    protected $number;

    /**
     * Create a money presentation instance.
     *
     * @param Repository $config
     * @param Number $number
     */
    public function __construct(Repository $config, Number $number)
    {
        $this->config = $config;
        $this->number = $number;
    }

    /**
     * Formats an amount according to the configured parameters.
     *
     * @param float $amount
     * @return string
     */
    public function format($amount)
    {
        return $this->currencySymbol() . $this->trailingSpace() . $this->number->format($amount, $this->precision());
    }

    /**
     * Returns the configured currency sign.
     *
     * @return string
     */
    public function currencySymbol()
    {
        return $this->config->get('webshop.currency.symbol');
    }

    /**
     * Returns a non-breaking space if required by configuration.
     *
     * @return string
     */
    public function trailingSpace()
    {
        return $this->config->get('webshop.currency.trailing_space') ? '&nbsp;' : '';
    }

    /**
     * Returns configured the number of decimals used in amounts.
     *
     * @return int
     */
    public function precision()
    {
        return $this->config->get('webshop.currency.precision', 0);
    }

}
