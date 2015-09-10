<?php
class Riversy_Corehacks_Model_Directory_Currency extends Mage_Directory_Model_Currency
{

    /**
     * Format price to currency format
     *
     * @param   double $price
     * @param   bool $includeContainer
     * @return  string
     */
    public function format($price, $options=array(), $includeContainer = true, $addBrackets = false)
    {
        return $this->formatPrecision($price, 0, $options, $includeContainer, $addBrackets);
    }
}