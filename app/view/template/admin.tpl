<!doctype html>
<html lang="en">
  <head>
    <title>website</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="stylesheet" href="./lib/bootstrap-4.0.0-beta.3-dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="./assets/css/site.css" />
  </head>
  <body>

    <ul class="nav justify-content-end" id="menuPokedex">
      <li class="nav-item">
        <a class="nav-link" href="./">Pokemon search bar</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="./?sRoute=admin/user_log_in">Admin</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" target="_blank" href="https://github.com/gnatty/mds-pokemon-pokedex">Source (github)</a>
      </li>
    </ul>

    <div class="container padContainer">
        <div class="row">
          <div class="col-3">

            <ul class="list-group">
              <li class="list-group-item disabled">Admin</li>
              <li class="list-group-item">
                <a href="./?sRoute=admin/user_log_out">Log out</a>
              </li>
              <li class="list-group-item disabled">Pokemon</li>
              <li class="list-group-item disabeld">Manage pokemon list</li>
              <li class="list-group-item disabled">Create new pokémon</li>
              <li class="list-group-item disabled">Pokemon scroller</li>
              <li class="list-group-item">
                <a href="./?sRoute=admin/pokemon_update_database">Update database</a>
              </li>
              <li class="list-group-item">
                <a href="./?sRoute=admin/pokemon_fetch_by_name">Scroll pokemon by name</a>
              </li>
              <li class="list-group-item">
                <a href="./?sRoute=admin/pokemon_clear_database">Clear database</a>
              </li>
            </ul>

          </div>
          <div class="col-9">
            <div class="card">
              <div class="card-body">
                {$oPageContent}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script
      src="https://code.jquery.com/jquery-3.2.1.min.js"
      integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
      crossorigin="anonymous"></script>
    <script src="./assets/js/site.js"></script>
  </body>
</html>