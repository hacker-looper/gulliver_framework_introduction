<?php

/**
 * headerPublisher
 * @author  Looper <looper@edautomate.com>
 * @since   2014-02-18
 **/
class headPublisher {
  private static $instance = NULL;
  var $scriptFiles = array ();
  var $cssFiles = array ();

  private function __construct() {
      $this->loadGlobalCSS();
      $this->loadGlobalJS();
    }

    public function loadGlobalCSS(){

      $this->addCssFile("/assets/m/global/plugins/font-awesome/css/font-awesome.min.css");
      $this->addCssFile("/assets/m/global/plugins/simple-line-icons/simple-line-icons.min.css");
      $this->addCssFile("/assets/m/global/plugins/bootstrap/css/bootstrap.min.css");
      $this->addCssFile("/assets/m/global/plugins/uniform/css/uniform.default.css");
      $this->addCssFile("/assets/m/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css");
      $this->addCssFile("/assets/m/global/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css");
      
      $this->addCssFile("/assets/m/global/plugins/bootstrap-select/css/bootstrap-select.min.css");

      $this->addCssFile("/assets/m/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css");
      $this->addCssFile("/assets/m/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css");
      $this->addCssFile("/assets/m/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css");
      $this->addCssFile("/assets/m/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css");
      $this->addCssFile("/assets/m/global/plugins/clockface/css/clockface.css");
      
      $this->addCssFile("/assets/m/global/plugins/datatables/datatables.css");
      $this->addCssFile("/assets/m/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css");
    
      $this->addCssFile("/assets/m/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css");
      $this->addCssFile("/assets/m/global/css/components-rounded.min.css");
      $this->addCssFile("/assets/m/global/css/plugins-md.css");
      $this->addCssFile("/assets/m/global/css/plugins.min.css");

      $this->addCssFile("/assets/m/pages/css/profile.min.css");
      $this->addCssFile("/assets/m/layouts/layout/css/layout.css");
      $this->addCssFile("/assets/m/layouts/layout/css/themes/light.min.css");
      $this->addCssFile("/assets/m/layouts/layout/css/style.css");

      $this->addCssFile("/assets/m/global/plugins/select2/css/select2.min.css");
      $this->addCssFile("/assets/m/global/plugins/jstree/dist/themes/default/style.min.css");

      $this->addCssFile("/assets/css/system.css");
    }

    public function loadGlobalJS(){

      $this->addScriptFile("/assets/m/global/plugins/jquery.min.js");
      $this->addScriptFile("/assets/m/global/plugins/bootstrap/js/bootstrap.min.js");
      $this->addScriptFile("/assets/m/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js");
      
      $this->addScriptFile("/assets/m/global/plugins/js.cookie.min.js");
      $this->addScriptFile("/assets/m/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js");
      $this->addScriptFile("/assets/m/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js");
      $this->addScriptFile("/assets/m/global/plugins/jquery.blockui.min.js");
      $this->addScriptFile("/assets/m/global/plugins/uniform/jquery.uniform.min.js");
      $this->addScriptFile("/assets/m/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js");
      $this->addScriptFile("/assets/m/global/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js");
      $this->addScriptFile("/assets/m/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js");

      $this->addScriptFile("/assets/m/global/plugins/bootstrap-select/js/bootstrap-select.min.js");

      $this->addScriptFile("/assets/m/global/plugins/moment.min.js");
      $this->addScriptFile("/assets/m/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js");
      $this->addScriptFile("/assets/m/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js");
      $this->addScriptFile("/assets/m/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js");
      $this->addScriptFile("/assets/m/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js");
      $this->addScriptFile("/assets/m/global/plugins/clockface/js/clockface.js"); 
      $this->addScriptFile("/assets/m/global/scripts/app.min.js");    
      $this->addScriptFile("/assets/m/pages/scripts/components-date-time-pickers.min.js");
      

      $this->addScriptFile("/assets/m/global/scripts/app.js");
      $this->addScriptFile("/assets/m/layouts/layout/scripts/layout.js");
      // $this->addScriptFile("/assets/m/layouts/global/scripts/quick-sidebar.min.js");

      $this->addScriptFile("/assets/m/global/plugins/jquery-validation/js/jquery.validate.min.js");
      $this->addScriptFile("/assets/m/global/plugins/select2/js/select2.min.js");

      $this->addScriptFile("/assets/m/global/scripts/datatable.js");
      $this->addScriptFile("/assets/m/global/plugins/datatables/datatables.min.js");
      $this->addScriptFile("/assets/m/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js");

      $this->addScriptFile("/assets/m/global/plugins/jstree/dist/jstree.min.js");
      $this->addScriptFile("/assets/m/global/plugins/bootbox/bootbox.min.js");
      $this->addScriptFile("/assets/js/jquery.form.js"); // form.ajaxsubmit

      $this->addScriptFile("/assets/m/global/plugins/ckeditor/ckeditor.js");
    
    }

    static function &getSingleton() {
      if (self::$instance == NULL) {
        self::$instance = new headPublisher ( );
      }

      return self::$instance;
    }

    /**
     * [minifyJS description]
     *
     * @author Looper
     * @since  2014-03-07T14:41:56+0800
     * @param  [type]                   $file [physic file path of javascript]
     * @return [type]                         [complied string with javascript]
     */
    public function minifyJS($file){
      if(! file_exists($file)) {
        throw new Exception('couldnt minify js file by path:'.$file);
      }

      require_once PATH_LIBRARY . 'minify/JSMin.php';
      return JSMin::minify($file);
    }


    /**
     * @deprecated
     * 
     * 获得jquery&plugin最后的修改时间作为版本号
     * @return [type] [description]
     */
    public function getLastVersionOfJquerys(){
      require_once PATH_LIBRARY . 'minify/JSMin.php';
      $aJqueryFiles = array(
        PATH_SYSTEM . "assets/js/jquery.js",
        PATH_SYSTEM . "assets/js/jquery.slimscroll.min.js",
        PATH_SYSTEM . "assets/js/jquery.bootstrap.wizard.min.js",
        PATH_SYSTEM . "assets/js/jquery.validate.min.js",
        PATH_SYSTEM . "assets/js/jquery.flot.js",
        PATH_SYSTEM . "assets/js/jquery.form.js",
        PATH_SYSTEM . "assets/js/jquery.flot.resize.js",
        PATH_SYSTEM . "assets/js/jquery.dataTables.min.js",
        PATH_SYSTEM . "assets/js/jquery.placeholder.js",
        PATH_SYSTEM . "assets/js/jquery.crisisgoTable.js",
        PATH_SYSTEM . "assets/js/jquery.loadMask.js",
      );

      $maxfilemtime = 0;
      foreach ($aJqueryFiles as $key => $file) {
        if(! file_exists($file)) {
            throw new Exception("Error finding javascript file from:" . $file, 1);
        }

        if(filemtime($file) > $maxfilemtime) $maxfilemtime = filemtime($file);
      }

      $cachefile = PATH_SHARED . 'jquery-all-' . $maxfilemtime . '.js'; // print "$cachefile"; die;
      if(! file_exists($cachefile)){
        $sMinConent = '';
        foreach ($aJqueryFiles as $key => $file) {
          $sMinConent .= JSMin::minify(file_get_contents($file));
        }

        file_put_contents($cachefile, $sMinConent);
      }

      return $maxfilemtime;
    }

    /**
     * @deprecated
     * 
     * 获得jquery&plugin最后的修改时间作为版本号
     * @return [type] [description]
     */
    public function getLastVersionOfBootstraps(){
      require_once PATH_LIBRARY . 'minify/JSMin.php';
      $aBootstrapJs = array(
      PATH_SYSTEM . "assets/js/bootstrap.js",
      PATH_SYSTEM . 'assets/js/bootstrap-tooltip.js',
      PATH_SYSTEM . 'assets/js/bootstrap-tab.js',
      PATH_SYSTEM . 'assets/js/bootstrap-modal.js',
      PATH_SYSTEM . 'assets/js/bootstrap-modalmanager.js',
      PATH_SYSTEM . 'assets/js/modal.manager.plugin1.0.js',
      PATH_SYSTEM . 'assets/js/jshow.utils.js',
      PATH_SYSTEM . "assets/js/bootstrap-fileupload.js",
      PATH_SYSTEM . "assets/js/bootstrap-paginator.js",
      );

      $maxfilemtime = 0;
      foreach ($aBootstrapJs as $key => $file) {
        if(! file_exists($file)) {
            throw new Exception("Error finding javascript file from:" . $file, 1);
        }

        if(filemtime($file) > $maxfilemtime) $maxfilemtime = filemtime($file);
      }

      $cachefile = PATH_SHARED . 'bootstrap-all-' . $maxfilemtime . '.js'; // print "$cachefile"; die;
      if(! file_exists($cachefile)){
        $sMinConent = '';
        foreach ($aBootstrapJs as $key => $file) {
          $sMinConent .= JSMin::minify(file_get_contents($file));
        }

        file_put_contents($cachefile, $sMinConent);
      }

      return $maxfilemtime;
    }

    public function printJSHeader() {
      global $GLOBAL_SETTING;
      
      $html = '';
      foreach ($this->scriptFiles as $link) {
        if(! strpos($link, '?'))
          $html .= "<script src=\"" . $link . "?v=" . $GLOBAL_SETTING['VERSION'] . "\"></script>\n";
        else
          $html .= "<script src=\"" . $link . "&v=" . $GLOBAL_SETTING['VERSION'] . "\"></script>\n";
      }

      return $html;
    }

    public function printCSSHeader() {
      global $GLOBAL_SETTING;
    
      $html = '';
      foreach ($this->cssFiles as $link) {
      	// 添加css中media='print'样式属性（google日历中用到） 
      	if(substr($link ,25) === 'print.css'){
      		$html .= "<link href=\"" . $link . "?v=" . $GLOBAL_SETTING['VERSION'] . "\" rel=\"stylesheet\" media='print' >\n";
      	}else{
  	    	if(! strpos($link, '?'))
  	        $html .= "<link href=\"" . $link . "?v=" . $GLOBAL_SETTING['VERSION'] . "\" rel=\"stylesheet\" >\n";
  	      else
  	        $html .= "<link href=\"" . $link . "&v=" . $GLOBAL_SETTING['VERSION'] . "\" rel=\"stylesheet\" >\n";
  	    }
	   }
    return $html;
  }

  function addScriptFile($url) {
    $this->scriptFiles[$url] = $url;
  }

  function addCssFile($url) {
    $this->cssFiles[$url] = $url;
  }
}