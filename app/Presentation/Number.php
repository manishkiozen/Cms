<?php namespace App\Presentation;

use Illuminate\Contracts\Config\Repository;

class Number {

    /**
     * @var Repository
     */
    protected $config;

    /**
     * Create a number formatting presenter instance.
     *
     * @param Repository $config
     */
    public function __construct(Repository $config)
    {
        $this->config = $config;
    }

    /**
     * Formats a number.
     *
     * @param float $number
     * @param int $precision
     * @return string
     */
    public function format($number, $precision = 0)
    {
        return number_format($number, $precision, $this->decimalPoint(), $this->thousandsSeparator());
    }

    /**
     * Returns the character configured as decimal point.
     *
     * @return string
     */
    public function decimalPoint()
    {
        return $this->config->get('webshop.numbers.decimal_point');
    }

    /**
     * Returns the character configured as thousands separator.
     *
     * @return string
     */
    public function thousandsSeparator()
    {
        return $this->config->get('webshop.numbers.thousands_separator');
    }

}
