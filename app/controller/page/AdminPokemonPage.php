<?php

namespace App\Controller\Page;

class AdminPokemonPage
{

  /**
   * @Request(method="GET")
   */
  public static function fetchByName($oRequest, $oResponse) {
    if(empty($_SESSION['user_token'])) {
      header('location: ?sRoute=admin/user_log_in');
    }
    $oResponse->setTemplateAdmin();
    return $oResponse->render('page/admin/pokemon-fetch-by-name.tpl');
  }

  /**
   * @Request(method="GET")
   * @Request(method="POST")
   * @RequestPost(frmPokemonName="optional")
   */
  public static function dataByName($oRequest, $oResponse) {
    if(empty($_SESSION['user_token'])) {
      header('location: ?sRoute=admin/user_log_in');
    }
    $oResponse->setTemplateAdmin();

    // --- Handler post
    if($oRequest->handlerPost()) {

      $aErr = [];
      if(empty($oRequest->getParamPost('frmPokemonName'))) $aErr['frmPokemonName'] = true;
      if(!empty($aErr)) {
        return $oResponse->render('page/admin/pokemon-data-by-name.tpl', $aErr);
      }
      // -- Api request.
      $aRes = $oRequest->api('api_pokemon/dataByName', array(
        'pokemonName' => $oRequest->getParamPost('frmPokemonName')
      ));

      echo '<pre>';
      print_r($aRes);
      exit();
    }

    return $oResponse->render('page/admin/pokemon-data-by-name.tpl');
  }


  /**
   * @Request(method="POST")
   * @RequestPost(pokemonName="optional")
   */
  public static function okok($oRequest, $oResponse) {
    if(empty($_SESSION['user_token'])) {
      header('location: ?sRoute=admin/user_log_in');
    }
    $oResponse->setTemplateAdmin();
    return $oResponse->render('page/admin/user-log-in.tpl', null);
  }

  /**
   * @Request(method="GET")
   */
  public static function clearDatabase($oRequest, $oResponse) {
    if(empty($_SESSION['user_token'])) {
      header('location: ?sRoute=admin/user_log_in');
    }
    $oResponse->setTemplateAdmin();
    return $oResponse->render('page/admin/pokemon-clear-database.tpl', null);
  }

  /**
   * @Request(method="GET")
   */
  public static function updateDatabase($oRequest, $oResponse) {
    if(empty($_SESSION['user_token'])) {
      header('location: ?sRoute=admin/user_log_in');
    }
    $oResponse->setTemplateAdmin();
    return $oResponse->render('page/admin/pokemon-update-database.tpl', null);
  }


}