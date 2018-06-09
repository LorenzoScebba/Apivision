<?php
/**
 * Created by PhpStorm.
 * User: l.scebba
 * Date: 01/06/2018
 * Time: 10:46
 */

session_start();
$ini = parse_ini_file($_SERVER["DOCUMENT_ROOT"]."/../cgi-bin/config.ini",false,INI_SCANNER_RAW);
$url = $ini["url"];