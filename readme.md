
# MDS POKEDEX PROJECT

## How to install ?
* Import the database file ```mds_pokemon.sql```
* Edit the mysql login settings

```
# public_html/index.php
# L: 55
$aMysqlCredentials = array(
  'host'      => 'your host',
  'port'      => 'your port',
  'username'  => 'your username',
  'password'  => 'your password',
  'database'  => 'your database name'
);

```

Then access the app though the next uri 
```
http://localhost/{dirname}/public_html/
```

By default the database is empty you need create a new admin account via the admin log-in page.
Then you can log-in with your new username and password combination.


# Admin
- Update the database
- Clear the database
- Scroll pokemon database by name from "pokemondb"
