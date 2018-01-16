$(document).ready(function() {


  /**
  *
  * HANDLER SEARCH BAR
  */
  var sCurrentSearch = '';
  var dMinSearch = 3;

  $('input[name="pokemonSearch"]').on('keyup', function(e) {
    sCurrentSearch = $(this).val();
    if(sCurrentSearch.length >= dMinSearch) {
      $.ajax({
        'type': 'POST',
        'url' : '?sRoute=api_pokemon/searchPokemon',
        'data': {
          'pokemonName' : sCurrentSearch
        },
        'success': function(data) {
          $('.resultContent').empty();
          var pokemonData = data.data.data;
          console.log(pokemonData);
          var pokemonDataLength = pokemonData.length;
          if(pokemonDataLength == 0) {
            $('.resultContent').text('No data found.');
          } else {
            for(var i = 0; i < pokemonDataLength; i++) {
              var curPokemon  = pokemonData[i];
              var template    = $('#pokemonCard').clone();

              template.removeAttr('style');
              template.find('#pokImg').attr("src", curPokemon.pok_img);
              template.find('#pokName').text(curPokemon.pok_name);
              template.find('#pokDesc').html(
                "ID : " + curPokemon.pok_num + "<br>" +
                "BASE EXP : " + curPokemon.pok_base_exp + "<br>" +
                "BASE HAPP : " + curPokemon.pok_base_happ + "<br>" +
                "CATCH RATE : " + curPokemon.pok_catch_rate + "<br>" +
                "EGG CYCLES : " + curPokemon.pok_egg_cycles + "<br>" +
                "EV YIELD : " + curPokemon.pok_ev_yield + "<br>" +
                "GENDER FEMALE : " + curPokemon.pok_gender_female + "<br>" +
                "GENDER MALE : " + curPokemon.pok_gender_male + "<br>" +
                "GROWTH RATE : " + curPokemon.pok_growth_rate + "<br>" +
                "HEIGHT : " + curPokemon.pok_height + "<br>" +
                "WEIGTH : " + curPokemon.pok_weight + "<br>"
              );
              $('.resultContent').append(template);
            }
          }
        },
        'error': function(data) {
          console.log('err');
        }
      });
    } else {
      $('.resultContent').empty().text('No data found.');
    }
  });

  /**
  *
  * HANDLE CLEAR DATABASE
  *
  */
  $('#btnClearDatabase').on('click', function() {
    $(this).addClass('hideDiv');
    $('.loadingComponent').removeClass('hideDiv');

    $.ajax({
      'type': 'POST',
      'url' : '?sRoute=api_pokemon/clearDatabase',
      'success': function(data) {
          console.log('success');
          $('#btnClearDatabase').removeClass('hideDiv');
          $('.loadingComponent').addClass('hideDiv');
          $('#msgConfirm').empty().text('pokemon database has been truncated');
      },
      'error': function(data) {
          console.log('error');
          $('#btnClearDatabase').removeClass('hideDiv');
          $('.loadingComponent').addClass('hideDiv');
          $('#msgConfirm').empty().text('Something went wrong...');
      }
    });
  });

  /**
  *
  * HANDLE UPDATE DATABASE
  *
  */
  $('#btnUpdateDatabase').on('click', function() {
    $(this).addClass('hideDiv');
    $('.loadingComponent').removeClass('hideDiv');

    $.ajax({
      'type': 'POST',
      'url' : '?sRoute=api_pokemon/pokemonNameList',
      'success': function(data) {
          console.log('success');
          $('#btnUpdateDatabase').removeClass('hideDiv');
          $('.loadingComponent').addClass('hideDiv');
          $('#msgConfirm').empty().text('pokemon database has been updated with new item');
      },
      'error': function(data) {
          console.log('error');
          $('#btnUpdateDatabase').removeClass('hideDiv');
          $('.loadingComponent').addClass('hideDiv');
          $('#msgConfirm').empty().text('Something went wrong...');
      }
    });
  });

  /**
  *
  * HANDLE SCROLL FROM POKEMONDB WEB SITE
  *
  */
  $('#scrollBtnSubmit').on('click', function() {
    var pokemonName = $('#scrollPokemonName').val();
    if(pokemonName.length < 1) {
      console.log('nop');
    } else {
      $('#scrollPokemon').addClass('hideDiv');
      $('.loadingComponent').removeClass('hideDiv');
      $.ajax({
        'type': 'POST',
        'url' : '?sRoute=api_pokemon/scrollPokemonData',
        'data': {
          'pokemonName': pokemonName
        },
        'success': function(data) {
            console.log('success');
            $('#scrollPokemon').removeClass('hideDiv');
            $('.loadingComponent').addClass('hideDiv');
            $('#msgConfirm').empty().text('New pokemon added !');
            console.log(data);
        },
        'error': function(data) {
            console.log('error');
            $('#scrollPokemon').removeClass('hideDiv');
            $('.loadingComponent').addClass('hideDiv');
            $('#msgConfirm').empty().text('Something went wrong... maybe the pokemon name is wrong ?');
        }
      });

    }

  });

});
