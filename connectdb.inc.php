<?php
require 'autoload.php';

$app_id = "vrY2wAA371jOKdZX9MYRKje1nIeRF1SuGVKbGjIa";
$rest_key = "xwO0YawmDSWRyi6wFDwSmDKXli4t5UKGAgzKoDTd";
$master_key = "EbxlPx5JtbgbQNPAXm4OekpZ7fNpmFpJhnJegafE";

use Parse\ParseClient;
use Parse\ParseException;
use Parse\ParseQuery;
use Parse\Exception;
use Parse\ParseObject;
use Parse\ParseUser;
ParseClient::initialize($app_id, $rest_key, $master_key);
ParseClient::setServerURL('https://parseapi.back4app.io','/');

