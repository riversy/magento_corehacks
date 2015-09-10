<?php
class Riversy_Corehacks_Block_Catalog_Navigation extends Mage_Catalog_Block_Navigation
{
    protected  function _getCategoryAttribute($categoryId, $attrCode)
    {
        $collection = Mage::getModel('catalog/category')->getCollection();

        $collection->addAttributeToSelect($attrCode)
                ->setStoreId(Mage::app()->getStore()->getId())
                ->addIdFilter(array($categoryId))
                ->load()
                ;

        new Mage_Catalog_Model_Resource_Eav_Mysql4_Category_Collection();

        return $collection->getSelect()->__toString();
    }




    protected function _renderCategoryMenuItemHtml($category, $level = 0, $isLast = false, $isFirst = false,
        $isOutermost = false, $outermostItemClass = '', $childrenWrapClass = '', $noEventAttributes = false)
    {        
        if (!$category->getIsActive()) {
            return '';
        }
        $html = array();

        // get all children
        if (Mage::helper('catalog/category_flat')->isEnabled()) {
            $children = (array)$category->getChildrenNodes();
            $childrenCount = count($children);
        } else {
            $children = $category->getChildren();
            $childrenCount = $children->count();
        }
        $hasChildren = ($children && $childrenCount);

        // select active children
        $activeChildren = array();
        foreach ($children as $child) {
            if ($child->getIsActive()) {
                $activeChildren[] = $child;
            }
        }
        $activeChildrenCount = count($activeChildren);
        $hasActiveChildren = ($activeChildrenCount > 0);

        // prepare list item html classes
        $classes = array();
        $classes[] = 'level' . $level;
        $classes[] = 'nav-' . $this->_getItemPosition($level);
        $linkClass = '';
        if ($isOutermost && $outermostItemClass) {
            $classes[] = $outermostItemClass;
            $linkClass = ' class="'.$outermostItemClass.'"';
        }
        if ($this->isCategoryActive($category)) {
            $classes[] = 'active';
        }
        if ($isFirst) {
            $classes[] = 'first';
        }
        if ($isLast) {
            $classes[] = 'last';
        }
        if ($hasActiveChildren) {
            $classes[] = 'parent';
        }

        // prepare list item attributes
        $attributes = array();
        if (count($classes) > 0) {
            $attributes['class'] = implode(' ', $classes);
        }
        if ($hasActiveChildren && !$noEventAttributes) {
             $attributes['onmouseover'] = 'toggleMenu(this,1)';
             $attributes['onmouseout'] = 'toggleMenu(this,0)';
        }

        // assemble list item with attributes
        $htmlLi = '<li';
        foreach ($attributes as $attrName => $attrValue) {
            $htmlLi .= ' ' . $attrName . '="' . str_replace('"', '\"', $attrValue) . '"';
        }
        $htmlLi .= '>';
        $html[] = $htmlLi;

if ($this->escapeHtml($category->getName())=="Еще...")
{
$html[] = '<noindex>';
}

        $html[] = '<a href="'.$this->getCategoryUrl($category).'"'.$linkClass.'>';
        $html[] = '<span>' . $this->escapeHtml($category->getName()) . '</span>';
        $html[] = '</a>';

if ($this->escapeHtml($category->getName())=="Еще...")
{
$html[] = '</noindex>';
}

        // render children
        $htmlChildren = '';
        $j = 0;

        $categoryObj = Mage::getModel('catalog/category')->load($category->getId());

        if (!$categoryObj->getStopFoldering()){
            foreach ($activeChildren as $child) {

                $htmlChildren .= $this->_renderCategoryMenuItemHtml(
                    $child,
                    ($level + 1),
                    ($j == $activeChildrenCount - 1),
                    ($j == 0),
                    false,
                    $outermostItemClass,
                    $childrenWrapClass,
                    $noEventAttributes
                );
                $j++;
            }
        }



        if (!empty($htmlChildren)) {
            if ($childrenWrapClass) {
                $html[] = '<div class="' . $childrenWrapClass . '">';
            }
            $html[] = '<ul class="level' . $level . '">';
            $html[] = $htmlChildren;
            $html[] = '</ul>';
            if ($childrenWrapClass) {
                $html[] = '</div>';
            }
        }

        $html[] = '</li>';

        $html = implode("\n", $html);
        return $html;

    }

}