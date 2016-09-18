<?php

require 'Slim/Slim.php';

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();

define("SPECIALCONSTANT", true);

require 'app/libs/connect.php';

require 'app/routes/User/Account.php';
require 'app/routes/User/FavoritePlace.php';

require 'app/routes/Cabbie/Account.php';

require 'app/routes/Functions.php';

require_once ("app/libs/Conekta.php");
Conekta::setApiKey("key_tQCYUfka2gsxiisnXCXpbQ");


$app->run();