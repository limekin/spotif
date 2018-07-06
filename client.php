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

$response = $api->search('shape of you', 'track');
$tracks = $response->tracks;
$items = $tracks->items;

?>

<?php foreach($items as $item): ?>
    <?php if(! $item->preview_url) continue; ?>

    <?php $image = null; ?>
    <?php if($item->album->images) {
        $image = $item->album->images[0];
    }?>
    
    <?php if($image): ?>
        <img style='height: 200px; width: auto' src='<?php echo $image->url; ?>'/>
    <?php endif; ?>
    <h4><?php echo $item->name; ?></h4>
    <audio controls>
    <source src="<?php echo $item->preview_url; ?>" type="audio/mpeg">
    Your browser does not support the audio element.
    </audio>
    <br/>
<?php endforeach; ?>
