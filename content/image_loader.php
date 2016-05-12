<?php
require '../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Response;

$image = isset($_GET['image']) ? $_GET['image'] : false;

// Check if our params are set
if (!$image) {
	return (new Response(null, 404))->send();
}

// Set the location of the image
$imagePath = 'images/' . $image . '.jpg';

// Check if our image exists at this location and return an image, else return 404
if (file_exists($imagePath)) {
	$fp = fopen($imagePath, 'r');
	$stream = stream_get_contents($fp);

	return (new Response($stream, 200, [
		'Content-Type' => 'image/jpg',
		'Content-Length' => filesize($imagePath)
		]))->send();
} else {
	return (new Response(null, 404))->send();
}
