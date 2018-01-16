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
      {$oPageContent}
    </div>

    <script
      src="https://code.jquery.com/jquery-3.2.1.min.js"
      integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
      crossorigin="anonymous"></script>
    <script src="./assets/js/site.js"></script>
  </body>
</html>