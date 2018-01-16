<?php

namespace App\Model\Database;

class MysqlPdoDatabase
{

  private $host;
  private $port;
  private $username;
  private $password;
  private $database;
  private $_ob;


  /**
   * #__construct
   * 
   * @param $config array - mysql credentials.
   * 
   */
  public function __construct($config) {
    $configKeys   = array('host', 'port', 'username', 'password', 'database');
    $checkKeys    = array_keys($config);
    if( !empty( array_diff($configKeys, $checkKeys) ) ) {
      throw new \Exception('[error] wrong config');
    }
    $this->init($config);
  }

  /**
   * #init
   * 
   * @param $config array - mysql credentials.
   */
  private function init($config) {
    $this->host      =  $config['host'];
    $this->port      =  $config['port'];
    $this->username  =  $config['username'];
    $this->password  =  $config['password'];
    $this->database  =  $config['database'];
    try {
      $this->_ob =  new \PDO( 
        'mysql:host='. $this->host . ';port=' . $this->port . ';dbname=' . $this->database,
        $this->username, $this->password
      );
    } catch(\Exception $e) {
      $this->_ob = null;
      throw new MysqlPdoException('[error] #' . $e->getCode() . ' - ' . $e->getMessage() );
    }
  }

  /**
   * #ob
   * 
   */
  public function ob() {
    return $this->_ob;
  }

  /**
   * #exec
   * 
   * @param $sQuery string
   * @param $sParams array
   * @return array
   */
  public function exec($sQuery, $sParams = []) {
    $prep     = $this->ob()->prepare($query);
    $result   = $prep->execute();
    $this->throwExecError($prep->errorInfo());
    return $result;
  }

}