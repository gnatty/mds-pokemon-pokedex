<?php

session_start();

/**
 * Enable php error info.
 * 
 * @param $_GET['bDebug'] null
 */

$_GET['bDebug'] = true;
if( isset($_GET['bDebug']) ) {
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
}


/**
 * #fPre
 * Beautifier debugger mode.
 * 
 * @param $e any - Some data.
 */
function fPre($e) {
  echo '<hr><pre>';
  print_r($e);
  echo '</pre><hr>';
}

/**
 * #fCallController
 * Call a class method with his arguments.
 * 
 * @param $sSelectedRoute string - Controller method full path controller::method.
 * @param $aArguments array - Method arguments.
 */
function fCallController($sSelectedRoute, $aArguments) {
  call_user_func_array(
    $sSelectedRoute,
    $aArguments
  );
  exit();
}

/**
 * Require vendor autoload.
 */
require __DIR__ . '/../vendor/autoload.php';

/**
 * Mysql
 * @var $aMysqlCredentials 
 */
$aMysqlCredentials = array(
  'host'      => 'localhost',
  'port'      => 3306,
  'username'  => 'root',
  'password'  => 'root',
  'database'  => 'mds_pokemon'
);

/**
 * Routes
 * An array of all available routes.
 * 
 * @var $aRoutes array
 */
$aRoutes = array(
  /**
   * 
   * PUBLIC ROUTE
   */
  'public' => array(
    'home' => '\App\Controller\Page\PublicPage::home',
    'test' => '\App\Controller\Page\PublicPage::test',
    'req_api' => '\App\Controller\Page\PublicPage::req_api'
  ),
  /**
   * 
   * ADMIN ROUTE
   */
  'admin' => array(
  
  ),
  /**
   * 
   * API ROUTE
   */
  'api' => array(
    'ping' => '\App\Controller\Page\ApiPage::ping',
    'log_in' => '\App\Controller\Page\ApiPage::log_in'
  ),

  'api_admin_user' => array(
    'log_in' => '\App\Controller\Page\ApiAdminUserPage::log_in',
    'register' => '\App\Controller\Page\ApiAdminUserPage::register'
  ),

  'api_pokemon' => array(
    'dataByName' => '\App\Controller\Page\ApiPokemonPage::dataByName',
    'pokemonNameList' => '\App\Controller\Page\ApiPokemonPage::pokemonNameList',
    'searchPokemon' => '\App\Controller\Page\ApiPokemonPage::searchPokemon',
    'clearDatabase' => '\App\Controller\Page\ApiPokemonPage::clearDatabase',
    'scrollPokemonData' => '\App\Controller\Page\ApiPokemonPage::scrollPokemonData'
  ),

  'api_pokemon_scroller' => array(
    'pokemon_list' => '\App\Controller\Page\PokemonScrollerPage::getPokemonList',
    'data_by_name' => '\App\Controller\Page\PokemonScrollerPage::getPokemonDataByName'
  ),
  /**
   * 
   * ADMIN ROUTE
   */
  'admin' => array(
    'user_log_in' => '\App\Controller\Page\AdminPage::user_log_in',
    'user_register' => '\App\Controller\Page\AdminPage::user_register',
    'user_log_out' => '\App\Controller\Page\AdminPage::user_log_out',
    'dashboard' => '\App\Controller\Page\AdminPage::dashboard',
    'pokemon_data_by_name' => '\App\Controller\Page\AdminPokemonPage::dataByName',
    'pokemon_clear_database' => '\App\Controller\Page\AdminPokemonPage::clearDatabase',
    'pokemon_update_database' => '\App\Controller\Page\AdminPokemonPage::updateDatabase',
    'pokemon_fetch_by_name' => '\App\Controller\Page\AdminPokemonPage::fetchByName'
  ),
);

$oRequest               = new \App\Controller\Core\RequestCore();
$oResponse              = new \App\Controller\Core\ResponseCore();

$sRoute                 = !empty($_GET['sRoute']) ? $_GET['sRoute'] : 'public/home';
$aRoute                 = explode('/', $sRoute);

if(count($aRoute) < 2) {
  $oResponse->renderJson('error.route.not.found', 400);
  exit();
}
if(empty($aRoutes[$aRoute[0]][$aRoute[1]])) {
  $oResponse->renderJson('error.route.not.found', 400);
  exit();
}
$sSelectedRoute         = $aRoutes[$aRoute[0]][$aRoute[1]];
$sClassName             = explode('::', $sSelectedRoute);
$sMethodName            = $sClassName[1];
$sClassName             = $sClassName[0];


// --- Check if route exist else throw an error.
if( empty($sSelectedRoute) ) {
  $oResponse->renderJson('error.route.not.found', 400);
  exit();
}

if( !class_exists($sClassName) ) {
  $oResponse->renderJson(array(
    'error' => 'error.class.not.found',
    'data'  => $sClassName
  ), 400);
  exit();
}

// --- Fetch class method annotation.
$oAnnotation            = new \App\Controller\Core\AnnotationParserCore($sClassName);
$aControllerAnnotation  = $oAnnotation->getCommentsMethod($sMethodName);
$oRequest->setControllerAnnotation($aControllerAnnotation);

// --- If no annotation.
if( empty($aControllerAnnotation) ) {
  fCallController(
    $sSelectedRoute,
    array(
      $oRequest,
      $oResponse
    )
  );
}

// --- If annotation run constraint middleware.
if( $oRequest->checkControllerConstraint() ) {
  // --- No error found we can throw the route.
  fCallController(
    $sSelectedRoute,
    array(
      $oRequest,
      $oResponse
    )
  );
} else {

  // --- Error found throw error.
  $oResponse->renderJson(
    array(
      'error_field' => $oRequest->getErrorField()
    ),
    $oRequest->getConstraintErrorCode()
  );
}



?>