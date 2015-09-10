<?php

/**
 * WP Hacks Data Helper
 */
class Riversy_Corehacks_Helper_Data extends Mage_Core_Helper_Data
{
    /**
     * Database Helper
     *
     * @return Magpleasure_Common_Helper_Database
     */
    public function getDatabase()
    {
        return Mage::helper('magpleasure/database');
    }

    public function getValueFromDatabase($sql)
    {
        $readConnection = $this->getDatabase()->getReadConnection();
        return $readConnection->fetchOne($sql);
    }

    public function getArrayFromDatabase($sql)
    {
        $readConnection = $this->getDatabase()->getReadConnection();
        return $readConnection->fetchAll($sql);
    }

    public function getAssocFromDatabase($sql)
    {
        $readConnection = $this->getDatabase()->getReadConnection();
        return $readConnection->fetchAssoc($sql);
    }
}