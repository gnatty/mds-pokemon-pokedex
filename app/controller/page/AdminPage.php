<?php

namespace App\Controller\Page;

class AdminPage
{

  public static $sPublicKey = '24.32';
  public static function encryptePassword($sPassword) {
    $sPassword = AdminPage::$sPublicKey.$sPassword;
    return SHA1($sPassword);
  }

  public static function dashboard($oRequest, $oResponse) {
    $oResponse->setTemplateAdmin();
    // ---

    // ---
    return $oResponse->render('page/admin/dashboard.tpl', null);
  }

  public static function user_log_out($oRequest, $oResponse) {
    unset($_SESSION['user']);
    unset($_SESSION['user_token']);
    header('location: ?sRoute=admin/user_log_in');
  }

  /**
   * @Request(method="GET")
   * @Request(method="POST")
   * @RequestPost(frmLogInUsername="optional", frmLogInPassword="optional")
   */
  public static function user_log_in($oRequest, $oResponse) {
    if(!empty($_SESSION['user_token'])) {
      header('location: ?sRoute=admin/dashboard');
    }
    
    $oResponse->setLogInTemplate();
    // ----

    // --- Handler post
    if($oRequest->handlerPost()) {
      $aErr = [];
      if(empty($oRequest->getParamPost('frmLogInUsername'))) $aErr['username'] = true;
      if(empty($oRequest->getParamPost('frmLogInUsername'))) $aErr['password'] = true;
      if(!empty($aErr)) {
        return $oResponse->render('page/admin/user-log-in.tpl', $aErr);
      }
      // -- Api request.
      $aRes = $oRequest->api('api_admin_user/log_in', array(
        'sUsername' => $oRequest->getParamPost('frmLogInUsername'),
        'sPassword' => AdminPage::encryptePassword($oRequest->getParamPost('frmLogInUsername')),
      ));
      if( !empty($aRes['success']) ) {
        // -- worng username or password.
        if( empty($aRes['success']['data']['data']) ) {
          return $oResponse->render('page/admin/user-log-in.tpl', array(
            'username' => true,
            'password' => true
          ));
        } else {
          // -- logged.
          $_SESSION['user'] = $aRes['success']['data']['data'][0];
          $_SESSION['user_token'] = $aRes['success']['data']['token'];
          header('location: ?sRoute=admin/dashboard');
        }
      }
    }
    // --- .\ Handler post
    // ---
    return $oResponse->render('page/admin/user-log-in.tpl', null);
  }

  /**
   * @Request(method="GET")
   * @Request(method="POST")
   * @RequestPost(frmLogInUsername="optional", frmLogInPassword="optional")
   */
  public static function user_register($oRequest, $oResponse) {
    if(!empty($_SESSION['user_token'])) {
      header('location: ?sRoute=admin/dashboard');
    }
    $oResponse->setLogInTemplate();
    // ---

    // --- Handler post
    if($oRequest->handlerPost()) {
      // -- Api request.
      $aRes = $oRequest->api('api_admin_user/register', array(
        'sUsername' => $oRequest->getParamPost('frmLogInUsername'),
        'sPassword' => AdminPage::encryptePassword($oRequest->getParamPost('frmLogInUsername')),
      ));
      if( !empty($aRes['error']) ) {
        // -- on error.
      } else {
        // -- on success.
        if( !empty($aRes['success']['data']['errorField']) ) {
          return $oResponse->render('page/admin/user-register.tpl', $aRes['success']['data']['errorField']);
        } else {
          $_SESSION['user'] = $aRes['success']['data']['data'][0];
          $_SESSION['user_token'] = $aRes['success']['data']['token'];
          header('location: ?sRoute=admin/dashboard');
        }
      }
    }
    // --- .\ Handler post
    // ---
    return $oResponse->render('page/admin/user-register.tpl');
  }


}