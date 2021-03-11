

<h1>Guzzle & TMDB API test lab</h1>
<?php

require_once 'vendor/autoload.php';

// On définit une constante pour stocker la clé de l'API
define('API_KEY', '76504e519407b7a8839cbac701e1d6c6');

// On définit une autres constante pour stocker la langue du jeu de résultat
define('LANGUAGE', 'fr');

define('API_URL', 'https://api.themoviedb.org/3/');

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

echo '<pre>';
print_r($body_response->results);
echo '</pre>';

// https://www.themoviedb.org/talk/53c11d4ec3a3684cf4006400?language=fr-FR
// echo '<img src="https://image.tmdb.org/t/p/original/'. $body->backdrop_path.' " >';

?>
<?php foreach ($body_response->results as $index => $film) {
   echo '<img src="https://image.tmdb.org/t/p/w342/'. $film->poster_path.' " >';
   echo $film->title.'<br>';
   echo $film->overview.'<br>';
}
?>
