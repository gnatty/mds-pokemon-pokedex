<div class="formHandler">
  <div class="card">
    <div class="card-body">

      <h5 class="card-title">Register</h5>

      <form method="POST" action="">

        <div class="form-group">
          <label for="frmLogInUsername">Username</label>
          <input
            name="frmLogInUsername"
            value="{$smarty.post.frmLogInUsername|default:''}"
            type="text" 
            class="form-control {if isset($error_username)}is-invalid{/if}" 
            id="frmLogInUsername" 
            placeholder="Username">
          {if isset($error_username)}
          <div class="invalid-feedback">
            The username you have chosen is already taken.
          </div>
          {/if}
        </div>

        <div class="form-group">
          <label for="frmLogInPassword">Password</label>
          <input 
            name="frmLogInPassword"
            type="password" 
            class="form-control" 
            id="frmLogInPassword" 
            placeholder="Password">
        </div>
        
        <button 
          name="frmLogInSubmit"
          type="submit" 
          class="btn btn-primary">Create an account</button>

      </form>
    </div>
  </div>
</div>