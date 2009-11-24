<?PHP
/*
 * Lissa (http://github.com/cauld/lissa)
 * Copyright (c) 2009 Chad Auld (opensourcepenguin.net)
 * Licensed under the MIT license.
 */
 
require 'includes/js/yui/phploader/loader.php';
require 'includes/lissa/config.inc.php';

class Lissa extends YAHOO_util_Loader {
    
    protected $minifyBasePath = null;
    
    public function __construct ($yuiVersion, $cacheKey=null, $modules=null, $noYUI=false) {
    	parent::__construct($yuiVersion, null, $modules);     
        $this->base = "/includes/js/yui/lib/".$yuiVersion."/build/";
        $this->minifyBasePath = URL_TO_MIN . "/index.php?b=" . MINIFY_BASE . "&f=";
	}
	
	protected function buildComboUrl ($dependencyData, $type) {
	    $resource = '';
	    
	    if (!empty($dependencyData)) {
	        $comboUrl = '';
	        $comboUrl = $this->minifyBasePath;
	        
            foreach($dependencyData[$type] as $depData) {
                foreach($depData as $key=>$value) {
                    $comboUrl .= $key . ',';
                }
            }
            
            $comboUrl = substr($comboUrl, 0, strlen($comboUrl) - 1); //Trim the trailing comma
            
            $resource = '';
            if ($type == 'css') {
                $resource = '<link rel="stylesheet" type="text/css" href="' . $comboUrl . '" />';
            } else if ($type == 'js') {
                $resource = '<script type="text/javascript" src="' . $comboUrl . '"></script>';
            }
        }
        
        return $resource;
	}
	
	public function scripts() {
	    $jsNode  = $this->buildComboUrl($this->script_data(), 'js');
	    
	    return $jsNode;
	}
	
	public function css() {
	    $cssNode  = $this->buildComboUrl($this->css_data(), 'css');
	    
	    return $cssNode;
	}
	
	public function tags() {
	    $cssNode = $this->buildComboUrl($this->css_data(), 'css');
	    $jsNode  = $this->buildComboUrl($this->script_data(), 'js');
	    
	    return $cssNode . $jsNode;  
	}
    
}