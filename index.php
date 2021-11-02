<?php
require_once 'TalkToAtlante.php';
require_once 'ResponseCodes.php';
$talk = new \TalkToAtlante();
$talk->setError(null, 'Hola', 500);
$talk->sendResponse();

