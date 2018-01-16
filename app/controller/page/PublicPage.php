<?php

namespace App\Controller\Page;

class PublicPage
{

  /**
   * 
   * @Request(method="GET")
   */
  public static function home($oRequest, $oResponse) {

    $aArgs = array(
      'name' => 'sercan'
    );
    return $oResponse->render('page/public/home.tpl', $aArgs);
  }

  /**
   * 
   */
  public static function test($oRequest, $oResponse) {
    return $oResponse->renderjson(array(
      'name' => 'ok',
      'oui'  => 'non'
    ), 404);
  }

  /**
   * 
   * @Request(method="GET")
   * @Param(title="string", name="string")
   */
  public static function req_api($oRequest, $oResponse) {

    $sUrl = 'http://192.168.10.33/sercan/?bDebug&sRoute=api/log_in';
    $req = $oResponse->apiRequest($sUrl);

    echo '<pre>';
    print_r($req);
    echo '</pre>';
  }

}