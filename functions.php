<?php

// Fonction pour se connecter à Guzzle
  function get_client(API_URL){
    $client = new GuzzleHttp\Client([
    // Base URI is used with relative requests
    'base_uri' => API_URL,
]);
  }

  function make_request(){
    $request = new Request('PUT', 'http://httpbin.org/put');
    $response = $client->send($request, ['timeout' => 2]);
  }

  function get_films(){
    get_client();
  }

  function get_film_by_id($id){
     get_client();
     $request = API_URL.'movie/'.$id.'?api_key='.API_KEY.'&language='.LANGUAGE;
  }

 ?>
