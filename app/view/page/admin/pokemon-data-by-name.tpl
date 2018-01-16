<form method="POST" action="">
 <div class="form-group">
  <label for="frmPokemonName">Pokemon name</label>
  <input
    name="frmPokemonName"
    value="{$smarty.post.frmPokemonName|default:''}"
    type="text" 
    class="form-control {if !empty($frmPokemonName)}is-invalid{/if}" 
    id="frmPokemonName" 
    placeholder="Pokemon name" />
  </div>

  <button 
    name="frmSubmit"
    type="submit" 
    class="btn btn-primary">Search</button>
 </form>