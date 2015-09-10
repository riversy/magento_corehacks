<?php
class Riversy_Corehacks_Block_Catalog_Product_View_Type_Bundle_Option extends Mage_Bundle_Block_Catalog_Product_View_Type_Bundle_Option
{
    public function getSelectionTitlePrice($_selection, $includeContainer = true)
    {
        return str_replace("+", "", parent::getSelectionTitlePrice($_selection, $includeContainer));
    }

    public function getSelectionQtyTitlePrice($_selection, $includeContainer = true)
    {
        return str_replace("+", "", parent::getSelectionQtyTitlePrice($_selection, $includeContainer));
    }
}
