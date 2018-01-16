<?php

namespace App\Controller\Page;

class ApiPokemonPage
{

  /**
   * @Request(method="POST")
   * @RequestPost(pokemonName="string")
   */
  public static function scrollPokemonData($oRequest, $oResponse) {
    $sPokemonName = $oRequest->getParamPost('pokemonName');

    $sUrl   = 'api_pokemon_scroller/data_by_name&pokemon_name='.$sPokemonName;
    $aData  = $oRequest->api($sUrl, []);

    if( empty( $aData['success']['data'] ) ) {
      return $oResponse->renderjson('oui', 404);
    } else {
      $aPokemonData = $aData['success']['data']['pokemons'];
      foreach ($aPokemonData as $dKey => $iPokemon) {
        $v = array(
          'pok_name' => $iPokemon['name'],
          'pok_img' => $iPokemon['img'],
          'pok_num' => $iPokemon['stats']['pokedex']['num'],
          'pok_gender_male' => !empty($iPokemon['stats']['breeding']['gender']['male']) ? $iPokemon['stats']['breeding']['gender']['male'] : null,
          'pok_gender_female' => !empty($iPokemon['stats']['breeding']['gender']['female']) ? $iPokemon['stats']['breeding']['gender']['female'] : null,
          'pok_height' => $iPokemon['stats']['pokedex']['height'],
          'pok_weight' => $iPokemon['stats']['pokedex']['weight'],
          'pok_ev_yield' => $iPokemon['stats']['training'][0],
          'pok_catch_rate' => $iPokemon['stats']['training'][1],
          'pok_base_happ' => $iPokemon['stats']['training'][2],
          'pok_base_exp' => $iPokemon['stats']['training'][3],
          'pok_growth_rate' => $iPokemon['stats']['training'][4],
          'pok_egg_cycles' => $iPokemon['stats']['breeding']['egg-cycles']
        );

        $oPokemonModel = new \App\Model\PokemonModel();
        $oPokemonModel->create($v);
      }
      return $oResponse->renderjson('oui', 200);
    }
  
  }

  /**
   * @Request(method="POST")
   */
  public static function clearDatabase($oRequest, $oResponse) {
    $oPokemonModel = new \App\Model\PokemonModel();
    $oPokemonModel->clearDatabase();
    return $oResponse->renderjson(true, 200);
  }

  /**
   * @Request(method="POST")
   * @RequestPost(pokemonName="string")
   */
  public static function dataByName($oRequest, $oResponse) {
    $sPath = './../pokemon_db/'.$oRequest->getParamPost('pokemonName').'.json';
    if(file_exists($sPath)) {
      $sContent = json_decode(file_get_contents($sPath), true);
    }

    $aPokemonData = [];
    if(!empty($sContent)) {
      $aData = $sContent['pokemons'];
      foreach ($aData as $dKey => $iPokemon) {
        $v = array(
          'pok_name' => $iPokemon['name'],
          'pok_img' => $iPokemon['img'],
          'pok_num' => $iPokemon['stats']['pokedex']['num'],
          'pok_gender_male' => !empty($iPokemon['stats']['breeding']['gender']['male']) ? $iPokemon['stats']['breeding']['gender']['male'] : null,
          'pok_gender_female' => !empty($iPokemon['stats']['breeding']['gender']['female']) ? $iPokemon['stats']['breeding']['gender']['female'] : null,
          'pok_height' => $iPokemon['stats']['pokedex']['height'],
          'pok_weight' => $iPokemon['stats']['pokedex']['weight'],
          'pok_ev_yield' => $iPokemon['stats']['training'][0],
          'pok_catch_rate' => $iPokemon['stats']['training'][1],
          'pok_base_happ' => $iPokemon['stats']['training'][2],
          'pok_base_exp' => $iPokemon['stats']['training'][3],
          'pok_growth_rate' => $iPokemon['stats']['training'][4],
          'pok_egg_cycles' => $iPokemon['stats']['breeding']['egg-cycles']
        );

        $oPokemonModel = new \App\Model\PokemonModel();
        $oPokemonModel->create($v);

        array_push($aPokemonData, $v);
      }
      return $oResponse->renderjson($aPokemonData, 200);
    } else {
      return $oResponse->renderjson(null, 404);
    }

  }

  /**
   * @Request(method="POST")
   */
  public static function pokemonNameList($oRequest, $oResponse) {
    $aReadDir = glob('./../pokemon_db/*.json');
    foreach ($aReadDir as $key => $sPath) {
      $sContent = json_decode(file_get_contents($sPath), true);
      if(!empty($sContent)) {
        $aData = $sContent['pokemons'];
        foreach ($aData as $dKey => $iPokemon) {
          $v = array(
            'pok_name' => $iPokemon['name'],
            'pok_img' => $iPokemon['img'],
            'pok_num' => $iPokemon['stats']['pokedex']['num'],
            'pok_gender_male' => !empty($iPokemon['stats']['breeding']['gender']['male']) ? $iPokemon['stats']['breeding']['gender']['male'] : null,
            'pok_gender_female' => !empty($iPokemon['stats']['breeding']['gender']['female']) ? $iPokemon['stats']['breeding']['gender']['female'] : null,
            'pok_height' => $iPokemon['stats']['pokedex']['height'],
            'pok_weight' => $iPokemon['stats']['pokedex']['weight'],
            'pok_ev_yield' => $iPokemon['stats']['training'][0],
            'pok_catch_rate' => $iPokemon['stats']['training'][1],
            'pok_base_happ' => $iPokemon['stats']['training'][2],
            'pok_base_exp' => $iPokemon['stats']['training'][3],
            'pok_growth_rate' => $iPokemon['stats']['training'][4],
            'pok_egg_cycles' => $iPokemon['stats']['breeding']['egg-cycles']
          );

          $oPokemonModel = new \App\Model\PokemonModel();
          $oPokemonModel->create($v);
        }
      }
    }
    return $oResponse->renderjson(
      $aReadDir,
      200
    );
  }

  /**
   * @Request(method="POST")
   * @RequestPost(pokemonName="string")
   */
  public static function searchPokemon($oRequest, $oResponse) {
    $oPokemonModel = new \App\Model\PokemonModel();
    $aRes = $oPokemonModel->search($oRequest->getParamPost('pokemonName'));
    return $oResponse->renderjson(
      $aRes,
      200
    );
  }
}