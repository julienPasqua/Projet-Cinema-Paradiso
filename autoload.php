<?php
spl_autoload_register(function($class){
//    require_once($_SERVER['DOCUMENT_ROOT'] . "/classes/$class.php");
    require_once("classes/$class.php");
});
date_default_timezone_set('Europe/Paris'); // Remplacez par votre fuseau horaire
