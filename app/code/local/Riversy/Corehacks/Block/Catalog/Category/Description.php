<?php

class Riversy_Corehacks_Block_Catalog_Category_Description extends Mage_Core_Block_Template
{
    protected $_headerText = '';
    protected $_footerText = '';
    
    protected $_isFirst = null;

    /**
     * Retrives customer's session
     * @return Mage_Customer_Model_Session
     */
    protected function _customerSession()
    {
        return Mage::getSingleton('customer/session');
    }


    protected function _isFirstView()
    {
        $params = array(
            'p',
            'dd_brand',
            'price',
            'dd_brand',
            'dd_filling',
            'dd_material',
            'dd_plaid_type',
            'dd_warm2',
            'dd_set_size',
            'dd_set_pillowsize',
            'dd_colour',
            'dd_blanket_width',
            'dd_duvet_size',
            'dd_robe_type',
            'dd_robe_size',
            'dd_sheet_size',
            'dd_plaid_type',
            'dd_curtain_size',
            'dd_sheet_type',
            'dd_sheet_size',
            'dd_density',
            'dd_swim_size',
            'dd_swim_type',
            'cat',
          );
        if ($this->_isFirst === null){
            
            foreach ($params as $param_key){
                if ($this->getRequest()->getParam($param_key)){
                    return $this->_isFirst = false;
                }
            }
           
            return $this->_isFirst = true;
        }       
        return $this->_isFirst;

//      Old version
//        try {
//            $ref=@getenv("HTTP_REFERER");
//        } catch (Exception $e){
//            $ref = false;
//        }
//        if ($ref && ((strpos($ref, Mage::getStoreConfig('web/unsecure/base_url')) !== false) || (Mage::getStoreConfig('web/secure/base_url')) !== false)){
//            return false;
//        }
        
    }
    
    public function getCategory(){
        return Mage::registry('current_category');
    }
    
    /**
     * Retrives strlen
     * @param string $str
     * @return integer
     */
    protected function _ru_strlen($str)
    {
        
        
        
    }
    
    protected function  _prepareLayout() 
    {
        if ($this->_isFirstView() && ($category = $this->getCategory())){
            $description = $category->getDescription();
            
            $chset = 'utf8';
            $this->_headerText = '';
            $this->_footerText = '';
                        
            if (strlen($description) > 1100){

                if (strpos($description, '<p>') !== false){
                    $text = $description;

                    $pPos = strpos($text, '</p>', 1100);
                    $hText = substr($text, 0, $pPos + 4);
                    $fText = substr($text, $pPos + 5, strlen($description) - ($pPos + 5));

                    $this->_headerText = $hText;
                    $this->_footerText = $fText;

                } else {
                    $text = $description;
                    $ptext = substr($text, 0, 1100);
                    $rtext = strrev($ptext);
                    $i = 1100;
                    while ($rtext{0} !== ' '){
                        $i++;
                        $ptext = substr($text, 0, $i);
                        $rtext = strrev($ptext);
                    }
                    $ptext = substr($text, 0, $i - 1);
                    $text = $ptext;
                    $ftext = substr($description, $i, strlen($description) - $i);


                    $this->_headerText = $text.'...';
                    $this->_footerText = '...'.$ftext;
                }




            } else {
                $this->_headerText = $description;
            }
        }
            


        parent::_prepareLayout();                                
    }
    
    
    /**
     * Retrives headet text part
     * @return string
     */
    public function getHeaderText()
    {
        return $this->_render($this->_headerText);
    }
    
    /**
     * Retrives footer text part
     * @return string
     */
    public function getFooterText()
    {
        return $this->_render($this->_footerText);
    }
    
    protected function _render($text)
    {
        if ($this->_isFirstView()){
            return $text;
        }                
    }
    
    
}