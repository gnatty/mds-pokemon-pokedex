<?php

namespace App\Model;

class AdminUserModel extends BaseModel
{

  private $sSecretKey = '23.42';

  public function encryptePassword($sPassword) {
    $sPassword = $this->sSecretKey.$sPassword;
    return SHA1($sPassword);
  }

  public function createToken($aData) {
    $sPass = implode('ok', $aData);
    return $this->encryptePassword($sPass);
  }

  public function getAll() {
    $sQuery = '
      SELECT
        *
      FROM
        admin_user
      ;
    ';
    return parent::select($sQuery);
  }

  public function selectByUsername($sUsername) {
    $sQuery = '
      SELECT
        aus_id,
        aus_username,
        aus_role
      FROM
        admin_user
      WHERE
        aus_username = :aus_username
      LIMIT 1
      ;
    ';
    $aParam = [
      'aus_username' => $sUsername
    ];
    return parent::select($sQuery, $aParam);
  }

  public function log_in($sUsername, $sPassword) {
    $sQuery = '
      SELECT
        *
      FROM
        admin_user
      WHERE
        aus_username = :aus_username
      AND
        aus_password = :aus_password
      LIMIT 1
      ;
    ';
    $aParam = [
      'aus_username' => $sUsername,
      'aus_password' => $this->encryptePassword($sPassword)
    ];
    $aRes = parent::select($sQuery, $aParam);
    if(!empty($aRes['data'])) {
      $aRes['data'][0]['aus_password'] = null;
      $aRes['token'] = $this->createToken($aRes['data'][0]);
    }
    return $aRes;
  }

  public function register($sUsername, $sPassword) {
    $aCheckUsername = $this->selectByUsername($sUsername);
    if($aCheckUsername['bIsError']) {
      return $aCheckUsername;
    } elseif( !empty($aCheckUsername['data']) ) {
      $aCheckUsername['errorField']['error_username'] = 'error_username_exist';
      return $aCheckUsername;
    } else {
      $sQuery = '
        INSERT INTO 
          admin_user
          (aus_username, aus_password)
        VALUES
          (:aus_username, :aus_password)
        ;
      ';
      $aParam = [
        'aus_username' => $sUsername,
        'aus_password' => $this->encryptePassword($sPassword)
      ];
      return parent::insert($sQuery, $aParam);
    }
  }

}