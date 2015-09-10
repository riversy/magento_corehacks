<?php
class Riversy_Corehacks_Block_Adminhtml_Widget_Grid_Column_Renderer_Currency extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Currency
{
    /**
     * Renders grid column
     *
     * @param   Varien_Object $row
     * @return  string
     */
    public function render(Varien_Object $row)
    {
        if ($data = $row->getData($this->getColumn()->getIndex())) {
            $currency_code = $this->_getCurrencyCode($row);

            if (!$currency_code) {
                return $data;
            }

            $data = floatval($data) * $this->_getRate($row);
            $sign = (bool)(int)$this->getColumn()->getShowNumberSign() && ($data > 0) ? '+' : '';
            $data = sprintf("%f", $data);
            $data = Mage::app()->getLocale()->currency($currency_code)->toCurrency($data, array('precision'=>0));
            return $sign . $data;
        }
        return $this->getColumn()->getDefault();
    }
}