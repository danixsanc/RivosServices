<?php

require 'Slim/Slim.php';

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();

define("SPECIALCONSTANT", true);

//Connection Database Lib Require
require 'app/libs/connect.php';

//User Lib Require
require 'app/routes/User/Account.php';
require 'app/routes/User/FavoritePlace.php';
//Cabbie Lib Require
require 'app/routes/Cabbie/Account.php';
require 'app/routes/Cabbie/Coordinates.php';
require 'app/routes/Cabbie/FunctionsCabbie.php';
require 'app/routes/Cabbie/Request.php';
//Admin Lib Require

//Global Lib Require
require 'app/routes/Global/Functions.php';

//Conekta Lib Require And Configuration Api Key
require_once ("app/libs/Conekta.php");
Conekta::setApiKey("key_tQCYUfka2gsxiisnXCXpbQ");


$app->run();