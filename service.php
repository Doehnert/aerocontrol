<?php

require_once('classes/CMySQL.php'); // including service class to work with database

require_once('classes/CServices.php'); // including service class to work with database

$oServices = new CServices();

// set method

$oServices->setMethod($_REQUEST['type']);

// set possible limit

if (isset($_GET['limit']) && (int)$_GET['limit']) {

    $oServices->setLimit((int)$_GET['limit']);

}

// process actions

switch ($_REQUEST['action']) {

    case 'last_rwy':

        $oServices->getLastVideos();

        break;

    case 'top_videos':

        $oServices->setOrder('top');

        $oServices->getLastVideos();

        break;

    case 'add_video':

        $oServices->addVideo($_POST['title']);

        break;

}
?>