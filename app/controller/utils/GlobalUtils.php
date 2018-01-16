<?php

namespace App\Controller\Utils;

class GlobalUtils {
  public static function pre($arr) {
    echo '<hr><pre>';
    print_r($arr);
    echo '</pre><hr>';
  }
  public static function jum($val) {
    echo $val.'<br />';
  }
  public static function jume($val) {
    echo '[ERREUR] --- ' . $val . '<br />';
  }
  public static function serverUri() {
    $base = $_SERVER['REQUEST_SCHEME']=='http' ? 'http://' : 'https://';
    return $base . $_SERVER['HTTP_HOST'] . str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);
  }
  public static function getPageContent($sUrl) {
    global $sUserAgent;
    $oContext     = stream_context_create(
      array(
        'http' => array(
          'user_agent' => $sUserAgent
        )
      )
    );
    $sContent     = file_get_contents($sUrl, false, $oContext);
    return $sContent;
  }
  public static function checkVal($val, $type = null) {
    if( empty($val) ) {
      return null;
    }
    if( !empty($type) ) {
      switch ( $type ) {
        case 'string':
          $val = addslashes($val);
          break;
        case 'int':
          $val = intval($val);
          break;
        case 'float':
          $val = floatval($val);
          $val = empty($val) ? null : $val;
      }
    }
    return $val;
  }
  public static function createPokemonJsonFile($fileName, $data) {
    $pa = __DIR__ . '/../../pokemon_db/';
    $op = fopen($pa.$fileName, 'w+');
    $wr = fwrite($op, $data);
    $cl = fclose($op);
    return ($op && $wr && $cl);
  }
  public static function dbResult($action, $data = null, $code = null) {
    return array(
      'action'    => $action,
      'code'      => $code,
      'data'      => $data
    );
  }
}