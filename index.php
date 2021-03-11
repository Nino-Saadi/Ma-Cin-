
<?php

require_once 'vendor/autoload.php';
include 'config/config.php';

// Note : Faire une fonction de l'appel à Guzzle
// get_client();
$client = new GuzzleHttp\Client([
    // Base URI is used with relative requests
    'base_uri' => API_URL
]);


//https://docs.guzzlephp.org/en/stable/quickstart.html#using-responses

// Voir une meilleure construction avec $client->request('GET', $url = API_URL, $options = Array() );
// $options = [
//     'api_key' => API_KEY,
//     'language' => LANGUAGE,
//     'id' => 550
// ];
// Exemple de requête de film by ID (id = 550)
// $request = API_URL.'movie/550?api_key='.API_KEY.'&language='.LANGUAGE;

// Exemple de requête globale
// Films les plus populaires
$request = API_URL.'movie/popular?api_key='.API_KEY.'&sort_by=popularity.desc&language='.LANGUAGE;

// Appel à l'API TMDB via Guzzle
$response = $client->get($request);
// $client->request('GET', API_URL, $option );

// Entête de la réponse
// echo $response->getHeader('content-type')[0];

// Corps de réponse
$body_response = $response->getBody();

// Le corps de réponse est converti en string
$body_response = $body_response->getContents();

// Le json est converti en un objet PHP
// Pour accéder à une propriété de l'objet PHP, on écrit : $objet->propriete
$body_response = json_decode($body_response);

// Réponse obtenue

// echo '<pre>';
// print_r($body_response->results);
// echo '</pre>';

// https://www.themoviedb.org/talk/53c11d4ec3a3684cf4006400?language=fr-FR
// echo '<img src="https://image.tmdb.org/t/p/original/'. $body->backdrop_path.' " >';

?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/style.css">
    <title>Ma Ciné</title>
  </head>

  <body>

     <main>
       <h1 class="text-center">Films Populaires</h1>
        <div class="container">
          <div class="row">
            <?php foreach ($body_response->results as $index => $film) : ?>
              <div class="col">

                <!-- Cartes Présentation films  -->
                  <a class="card film-card" href="details.php" style="width: 13rem;">
                    <!-- Image -->
                    <img src="https://image.tmdb.org/t/p/w342/<?= $film->poster_path ?>" >
                    <!-- Note -->
                    <div class="card-header bg-dark text-white"><?= $film->vote_average ?></div>
                    <!-- Titre -->
                    <div class="card-body">
                      <h5 class="card-title"><?= $film->title ?></h5>
                    </div>
                 </a>
              </div>
             <?php endforeach ?>
          </div>

     </main>

  </body>
</html>
