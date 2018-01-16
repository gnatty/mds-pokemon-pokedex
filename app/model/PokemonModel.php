<?php

namespace App\Model;

class PokemonModel extends BaseModel
{

  public function create($aData) {
    $sQuery = '
      INSERT INTO
        pokemon
        (
        pok_name, 
        pok_img,
        pok_num,
        pok_gender_male,
        pok_gender_female,
        pok_height,
        pok_weight,
        pok_ev_yield,
        pok_catch_rate,
        pok_base_happ,
        pok_base_exp,
        pok_growth_rate,
        pok_egg_cycles
        )
      VALUES
        (
        :pok_name, 
        :pok_img,
        :pok_num,
        :pok_gender_male,
        :pok_gender_female,
        :pok_height,
        :pok_weight,
        :pok_ev_yield,
        :pok_catch_rate,
        :pok_base_happ,
        :pok_base_exp,
        :pok_growth_rate,
        :pok_egg_cycles
        )
      ;
    ';
    return parent::insert($sQuery, $aData);
  }

  public function search($sVal) {
    $sQuery = '
      SELECT
        *
      FROM
        pokemon
      WHERE
        pok_name LIKE "%'.$sVal.'%"
      ;
    ';
    return parent::select($sQuery, []);
  }

  public function clearDatabase() {
    $sQuery = '
      TRUNCATE TABLE
        pokemon
      ;
    ';
    return parent::insert($sQuery, []);
  }
}