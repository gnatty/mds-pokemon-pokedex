<div class="row">
  <div class="col-6 offset-3">
    <div class="jumbotron">
      <label for="basic-url">Pokedex</label>
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon3">Pokemon name</span>
        </div>
        <input type="text" class="form-control" name="pokemonSearch" aria-describedby="basic-addon3">
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-12">

    <div class="resultContent card-deck">
      No data found.
    </div>

  </div>
</div>

<div id="pokemonCard" class="card" style="display: none;">
  <img id="pokImg" class="card-img-top" alt="Card image cap">
  <div class="card-body">
    <h5 id="pokName" class="card-title"></h5>
    <p id="pokDesc" class="card-text"></p>
  </div>
</div>