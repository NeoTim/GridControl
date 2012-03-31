<?php

class Hackathon_GridControl_Model_Config extends Varien_Object
{
    protected $_config = null;
    protected $_gridList = array();
    protected $_loadAttributes = array();

    protected function _loadConfig()
    {
        $gridcontrolConfig = new Varien_Simplexml_Config;
        $gridcontrolConfig->loadString('<?xml version="1.0"?><gridcontrol></gridcontrol>');
        $gridcontrolConfig = Mage::getConfig()->loadModulesConfiguration('gridcontrol.xml');
        $this->_config = $gridcontrolConfig;

        foreach ($this->_config->getNode('grids')->children() as $grid) {
            $this->_gridList[] = $grid->getName();
        }
    }

    public function getConfig()
    {
        if (is_null($this->_config)) {
            $this->_loadConfig();
        }

        return $this->_config;
    }

    public function getGridList()
    {
        if (is_null($this->_config)) {
            $this->_loadConfig();
        }

        return $this->_gridList;
    }

    public function addLoadAttribute($attribute)
    {
        if (!in_array($attribute, $this->_loadAttributes)) {
            $this->_loadAttributes[] = $attribute;
        }

        return $this;
    }

    public function getLoadAttributes()
    {
        return $this->_loadAttributes;
    }
}