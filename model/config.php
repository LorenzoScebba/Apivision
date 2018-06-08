<?php
/**
 * Created by PhpStorm.
 * User: l.scebba
 * Date: 01/06/2018
 * Time: 10:46
 */

session_start();
$ini = parse_ini_file("config.ini",false,INI_SCANNER_RAW);
$url = $ini["url"];