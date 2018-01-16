<?php

namespace App\Controller\Page;

use \App\Model\AdminUserModel;

class ApiAdminUserPage
{


  /**
   * @Request(method="POST")
   * @RequestPost(sUsername="string", sPassword="string")
   */
  public static function log_in($oRequest, $oResponse) {

    $oAdminUserModel = new AdminUserModel();
    $aRes = $oAdminUserModel->log_in(
      $oRequest->getParamPost('sUsername'),
      $oRequest->getParamPost('sPassword')
    );

    return $oResponse->renderJsonApi(
      'success',
      $aRes, 
      200
    );
  }

  /**
   * @Request(method="POST")
   * @RequestPost(sUsername="string", sPassword="string")
   */
  public static function register($oRequest, $oResponse) {
  
    $oAdminUserModel = new AdminUserModel();
    $aRes = $oAdminUserModel->register(
      $oRequest->getParamPost('sUsername'),
      $oRequest->getParamPost('sPassword')
    );

    return $oResponse->renderJsonApi(
      'success',
      $aRes, 
      200
    );
  }

}