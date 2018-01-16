<div class="formHandler">
  <div class="card">
    <div class="card-body">

      <h5 class="card-title">Log in</h5>

      <form method="POST" action="">

        <div class="form-group">
          <label for="frmLogInUsername">Username</label>
          <input
            name="frmLogInUsername"
            value="{$smarty.post.frmLogInUsername|default:''}"
            type="text" 
            class="form-control {if !empty($username)}is-invalid{/if}" 
            id="frmLogInUsername" 
            placeholder="Username">
          {if !empty($username)}
          <div class="invalid-feedback">
            Wrong username or password
          </div>
          {/if}
        </div>

        <div class="form-group">
          <label for="frmLogInPassword">Password</label>
          <input 
            name="frmLogInPassword"
            type="password" 
            class="form-control {if !empty($password)}is-invalid{/if}" 
            id="frmLogInPassword" 
            placeholder="Password">
          {if !empty($password)}
          <div class="invalid-feedback">
            Wrong username or password
          </div>
          {/if}
        </div>
        
        <button 
          name="frmLogInSubmit"
          type="submit" 
          class="btn btn-primary">Submit</button>

      </form>

      <hr>
      <a href="./?sRoute=admin/user_register">Or create a fresh admin account</a>
    </div>
  </div>
</div>
