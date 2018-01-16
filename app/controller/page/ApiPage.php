<?php

namespace App\Controller\Page;

class ApiPage
{

  /**
   * @Request(method="POST")
   */
  public static function ping($oRequest, $oResponse) {
    return $oResponse->renderjson(array($_POST['ok']), 200);
  }

  /**
   * 
   * @Request(method="POST")
   */
  public static function log_in($oRequest, $oResponse) {
    return $oResponse->renderjson(array($_SERVER), 200);
  }
}