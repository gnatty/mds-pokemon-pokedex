<?php

namespace App\Controller\Core;

/**
 * #ResponseCore
 * 
 * Class
 */
class ResponseCore
{

  /**
   * @var $oSmarty [null/Smarty]
   * Smarty object.
   */
  private $oSmarty = null;

  /**
   * @var $sSamrtyTemplate string
   * Current location Smarty template.
   */
  private $sSamrtyTemplate = 'template/public.tpl';

  /**
   * #constructor
   * 
   * Constructor.
   * 
   * @param $bSmarty boolean - enable or disabled Smarty.
   */
  public function __construct($bSmarty = true) {
    if( $bSmarty ) {
      $this->initSmarty();
    }
  }

  /**
   * #initSmarty
   * 
   * Initialize Smarty.
   */
  public function initSmarty() {
    $o = new \Smarty();
    $o->template_dir = './../app/view/';
    $this->oSmarty = $o;
  }

  /**
   * #setTemplateAdmin
   * 
   * Switch the default template view.
   */
  public function setTemplateAdmin() {
    $this->sSamrtyTemplate = 'template/admin.tpl';
  }


  /**
   * #setLogInTemplate
   * 
   * Switch the default template view.
   */
  public function setLogInTemplate() {
    $this->sSamrtyTemplate = 'template/login.tpl';
  }

  /**
   * #setTemplatePublic
   * 
   * Switch the default template view.
   */
  public function setTemplatePublic() {
    $this->sSamrtyTemplate = 'template/public.tpl';
  }

  /**
   * #render
   * 
   * Render a Smarty template view.
   * 
   * @param $sPageName string - Smarty template full location.
   * @param $aArgs array - Smarty assign array 'key=>value' pair.
   * @return Template view.
   */
  public function render($sPageName, $aArgs = []) {
    if( is_null($this->oSmarty) ) return null;
    if( !empty($aArgs) ) {
      foreach ($aArgs as $sArgName => $iArg) {
        $this->oSmarty->assign( $sArgName, $iArg);
      }
    }

    $oPageContent = $this->oSmarty->fetch($sPageName);
    $this->oSmarty->assign( 'oPageContent', $oPageContent);
    return $this->oSmarty->display($this->sSamrtyTemplate);
  }

  /**
   * #renderJson
   * 
   * Render a Smarty template view.
   * 
   * @param $aData array - Array of data.
   * @param $dCode integer - Http reponse code.
   */
  public function renderJson($aData, $dCode) {
    header('Content-type: application/json');
    http_response_code($dCode);
    echo json_encode(array(
      'code' => $dCode,
      'data' => $aData
    ));
  }

  /**
   * #renderJson
   * 
   * Render a Smarty template view.
   * 
   * @param $sType string - success / error
   * @param $aData array - Array of data.
   * @param $dCode integer - Http reponse code.
   */
  public function renderJsonApi($sType, $aData, $dCode) {
    header('Content-type: application/json');
    http_response_code($dCode);
    echo json_encode(array(
      $sType => array(
        'code' => $dCode,
        'data' => $aData
      )
    ));
  }

}