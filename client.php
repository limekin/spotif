<?php

require 'vendor/autoload.php';

$session = new SpotifyWebAPI\Session(
    '626f17554aa54f2394826481c517e527',
    '693a444bbbc74e38ad3af0c8a39b1c36'
);

$session->requestCredentialsToken();
$accessToken = $session->getAccessToken();

$api = new SpotifyWebAPI\SpotifyWebAPI();
$api->setAccessToken($accessToken);

header('Content-type: application/json');
echo $accessToken;
echo json_encode(
    $api->search('roadhouse', 'track')
);
