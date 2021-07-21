<?php

namespace Magepow\ProductTags\Helper;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    /**
     * @var array
     */
    protected $configModule;
    protected $_urlMedia;
    public $_storeManager;

    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Magento\Store\Model\StoreManagerInterface $storeManager
    )
    {
        parent::__construct($context);
        $this->configModule = $this->getConfig(strtolower($this->_getModuleName()));
        $this->_storeManager = $storeManager;
    }

    public function getConfig($cfg='')
    {
        if($cfg) return $this->scopeConfig->getValue( $cfg, \Magento\Store\Model\ScopeInterface::SCOPE_STORE );
        return $this->scopeConfig;
    }

    public function getConfigModule($cfg='', $value=null)
    {
        $values = $this->configModule;
        if( !$cfg ) return $values;
        $config  = explode('/', $cfg);
        $end     = count($config) - 1;
        foreach ($config as $key => $vl) {
            if( isset($values[$vl]) ){
                if( $key == $end ) {
                    $value = $values[$vl];
                }else {
                    $values = $values[$vl];
                }
            } 

        }
        return $value;
    }
     public function getMediaUrl($file="")
    {   
        $route = $this->getConfigModule("general/route");
        $route = $route ?? 'producttags';
        $url = $route."/".$file;
        if(!$this->_urlMedia) $this->_urlMedia = $this->_storeManager->getStore()->getBaseUrl();
        return $this->_urlMedia . $url;
    }
}