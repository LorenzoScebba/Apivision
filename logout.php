<?php
/**
 * Created by PhpStorm.
 * User: l.scebba
 * Date: 01/06/2018
 * Time: 10:56
 */
include_once 'model/config.php';
session_start();
session_unset();
session_destroy();
header("Location: http://$url/index.php");