<?php

namespace App\Controller\Core;

class RequestCore
{

  private $aControllerAnnotation = null;
  private $sConstraintErrorMsg = null;
  private $dConstraintErrorCode = null;
  private $sRequestMethod = null;


  private $aFieldPost = [];
  private $aErrors = [];
  private $aErrorField = [];

  public function __construct() {

  }

  public function setConstraintErrorMsg($sConstraintErrorMsg) {
    $this->setError(array(
      'error' => $sConstraintErrorMsg
    ));
  }

  public function getErrorField() {
    return $this->aErrorField;
  }

  public function getFieldPost() {
    return $this->aFieldPost;
  }

  public function setConstraintErrorCode($dConstraintErrorCode) {
    $this->dConstraintErrorCode = $dConstraintErrorCode;
  }
  public function getConstraintErrorCode() {
    return $this->dConstraintErrorCode;
  }

  public function setControllerAnnotation($aControllerAnnotation) {
    $this->aControllerAnnotation = $aControllerAnnotation;
  }
  public function getControllerAnnotation() {
    return $this->aControllerAnnotation;
  }

  public function setRequestMethod($sRequestMethod) {
    $this->sRequestMethod = $sRequestMethod;
  }
  public function getRequestMethod() {
    return $this->sRequestMethod;
  }

  public function getErrors() {
    return $this->aErrors;
  }

  public function setError($aErr) {
    array_push($this->aErrors, $aErr);
  }

  public function getParamPost($sName) {
    return isset($this->aFieldPost[$sName]) ? $this->aFieldPost[$sName] : null;
  }

  public function getParamGet($sName) {

  }

  public function handlerPost() {
    return $this->getRequestMethod() == 'POST';
  }

  public function checkPost($sKey, $sType = null) {
    // --- .
    $sData = null;
    $sCode = null;
    // --- .
    if( !isset($_POST[$sKey]) && $sType != 'optional' ){
      $sCode = 'error.key_not_foud';
    } elseif( empty($_POST[$sKey]) && $sType != 'optional' ) {
      $sCode = 'error.empty_value';
    } elseif( $sType == 'optional' ) {
      $sData = !empty($_POST[$sKey]) ? $_POST[$sKey] : '';
    } else {
      $sData = $_POST[$sKey];
    }

    // --- .
    if( is_null($sCode) && !is_null($sType) ) {
      switch($sType) {
        case 'optional':
          $sCode = null;
        case 'string':
          $sCode = is_string($sData) ? null : 'error.no.string';
          break;
        case 'number':
          $sCode = is_numeric($sData) ? null : 'error.no.number';
          break;
        case 'null':
          $sCode = is_null($sData) ? null : 'error.no.null';
          break;
        case 'bool':
          $sCode = is_bool($sData) ? null : 'error.no.bool';
          break;
      }
    }
    $this->aFieldPost[$sKey] = $sData;
    // --- .
    return array(
      'data' => $sData,
      'key' => $sKey,
      'error' => is_null($sCode) ? null : $sCode
    );
  }

  public function checkRequestmethod() {
    $this->setRequestMethod($_SERVER['REQUEST_METHOD']);
    $aData = array_column(array_column($this->getControllerAnnotation(), 'Request'), 'method');
    if(empty($aData)) return true;
    else return in_array($this->getRequestMethod(), $aData);
  }

  public function checkRequestPostArguments() {
    $bError = false;
    $aData = array_column($this->getControllerAnnotation(), 'RequestPost');
    foreach ($aData as $dKey => $iData) {
      foreach ($iData as $iKey => $iType) {
        $aRes = $this->checkPost($iKey, $iType);
        if( !empty($aRes['error']) ) {
          $bError = true;
          $this->setError($aRes);
        }
      }
    }
    return $bError;
  }

  public function checkControllerConstraint() {
    // --- check request method.
    if( !$this->checkRequestmethod() ) {
      $this->setConstraintErrorMsg('error.request.method');
      $this->setConstraintErrorCode(405);
    }

    // --- check request post param.
    if( $this->getRequestMethod() == 'POST' && $this->checkRequestPostArguments() ) {
      $this->setConstraintErrorCode(400);
    }

    // --- do action on error.
    return is_null($this->getConstraintErrorCode());
  }

  public function pre($e) {
    echo '<hr><pre>';
    print_r($e);
    echo '</pre><hr>';
  }

  /**
   * #apiRequest
   * 
   * Make an api request.
   * 
   * @param $sUrl string - http url.
   * @return $aData array - array of content.
   */
  public function api($sPath, $aParam = []) {
    $sUrl =  "{$_SERVER['REQUEST_SCHEME']}://{$_SERVER['HTTP_HOST']}{$_SERVER['SCRIPT_NAME']}?sRoute={$sPath}";
    $authorization = "Authorization: Bearer 080042cad6356ad5dc0a720c18b53b8e53d4c274";
    $bbb = "PRIVATE-TOKEN: Private token KGFJFGDG0G0";

    $oCh = curl_init();
    curl_setopt($oCh, CURLOPT_URL, $sUrl);
    curl_setopt($oCh, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($oCh, CURLOPT_HTTPHEADER, array($authorization, $bbb));
    curl_setopt($oCh, CURLOPT_POST, TRUE);
    curl_setopt($oCh, CURLOPT_POSTFIELDS, $aParam);
    
    $aData = curl_exec($oCh); 
    $sCode = curl_getinfo($oCh, CURLINFO_HTTP_CODE); 
    curl_close($oCh); 
    return json_decode($aData, true);
  }



}