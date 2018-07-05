<?php

require 'vendor/autoload.php';

$session = new SpotifyWebAPI\Session(
    '626f17554aa54f2394826481c517e527',
    '693a444bbbc74e38ad3af0c8a39b1c36',
    'http://localhost:8000/callback.php'
);

$api = new SpotifyWebAPI\SpotifyWebAPI();

if (isset($_GET['code'])) {
    $session->requestAccessToken($_GET['code']);
    $api->setAccessToken($session->getAccessToken());

    header('Content-type: application/json');
    print_r($api->getUserPlaylists('me'));
} else {
    $options = [
        'scope' => [
            'user-read-private',
            'playlist-read-private',
            'playlist-modify-public',
            'playlist-modify-private',
            'user-library-read',
            'user-library-modify',
            'user-follow-read',
            'user-follow-modify'
        ],
    ];

    header('Location: ' . $session->getAuthorizeUrl($options));
    die();
}