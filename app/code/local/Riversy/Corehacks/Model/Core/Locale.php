<?php

class Riversy_Corehacks_Model_Core_Locale extends Mage_Core_Model_Locale
{
    /**
     * Functions returns array with price formatting info for js function
     * formatCurrency in js/varien/js.js
     *
     * @return array
     */
    public function getJsPriceFormat()
    {
        $result = parent::getJsPriceFormat();

        $result['precision'] = 0;
        $result['requiredPrecision'] = 0;

        return $result;
    }
}

