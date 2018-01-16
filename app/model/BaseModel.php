<?php

namespace App\Model;

use \App\Model\Database\MysqlPdoDatabase;

class BaseModel
{

  private $oMysqlPdoDatabase = null;

  public function __construct() {
    $this->init();
  }

  private function init() {
    global $aMysqlCredentials;
    $this->oMysqlPdoDatabase = new MysqlPdoDatabase($aMysqlCredentials);
  }

  public function select($sQuery, $aParam = []) {
    $oPrep = $this->oMysqlPdoDatabase->ob()->prepare($sQuery);
    $oPrep->execute($aParam);
    $aResult = $oPrep->fetchAll(\PDO::FETCH_ASSOC);
    $aResult = array(
      'data'        => $aResult,
      'errorInfo'   =>  $oPrep->errorInfo(),
      'errorField'  => []
    );
    return $this->returnResult($aResult);
  }

  public function insert($sQuery, $aParam = []) {
    $oPrep = $this->oMysqlPdoDatabase->ob()->prepare($sQuery);
    $oPrep->execute($aParam);
    $aResult =  array(
      'data'        => null,
      'errorInfo'   =>  $oPrep->errorInfo(),
      'errorField'  => []
    );
    return $this->returnResult($aResult);
  }

  public function returnResult($aResult) {
    $bIsError = empty($aResult['errorInfo'][1]) ? false : true;
    $aResult['bIsError'] = $bIsError;
    return $aResult;
  }

}