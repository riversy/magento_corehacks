<?php
class Riversy_Corehacks_Block_Account_Navigation extends Mage_Customer_Block_Account_Navigation
{
    protected $_deprecated = array('billing_agreements', 'recurring_profiles');

    public function addLink($name, $path, $label, $urlParams=array())
    {
        if (in_array($name, $this->_deprecated)){
            return ;
        }
        parent::addLink($name, $path, $label, $urlParams);
    }

}