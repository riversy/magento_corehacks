<?php
class Riversy_Corehacks_Block_Catalog_Category_View extends Mage_Catalog_Block_Category_View
{
    protected function  _prepareLayout()
    {
        parent::_prepareLayout();

        $headBlock = $this->getLayout()->getBlock('head');

        if (($category = $this->getCurrentCategory()) && $this->getCurrentCategory()->getMetaTitle()){
            $headBlock->setData('title', $category->getMetaTitle());
        }        
    }
}