<?php
class Riversy_Corehacks_Model_Catalog_Layer_Filter_Price extends Mage_Catalog_Model_Layer_Filter_Price
{
    public function getPriceRange()
    {
        $range = $this->getData('price_range');
        if (is_null($range)) {
            $maxPrice = $this->getMaxPriceInt();
            $minPrice = $this->getMinPriceInt();
            $index = 1;
            do {
                $range = pow(10, (strlen(floor($maxPrice))-$index));
                $items = $this->getRangeItemCounts($range);
                $index++;
            }
            while($range>self::MIN_RANGE_POWER && count($items)<5);

            if((($range*5)>self::MIN_RANGE_POWER)&& (count($this->getRangeItemCounts($range*5))>5))
                $range = $range*5;
            if((($range*2)>self::MIN_RANGE_POWER)&& (count($this->getRangeItemCounts($range*2))>5))
                $range = $range*2;

            $this->setData('price_range', $range);
        }
        return $range;
    }
}