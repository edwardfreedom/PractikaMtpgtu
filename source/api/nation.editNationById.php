<?php
/**
 * Created by PhpStorm.
 * User: Anatoliy
 * Date: 17.05.2016
 * Time: 13:49
 */
require_once dirname(dirname(__FILE__)) . '/classes/others/Settings.php';
require_once dirname(dirname(__FILE__)) . '/classes/bd/DB.php';
$db       = DB::getInstance();
$languageId = 1;
$moneyId    = 1;
$config     = $_POST["config"];

$json = json_decode( $config );
$json->residentsCount = str_replace(" ", "", $json->residentsCount);
$json->residentsCount = str_replace(".", "", $json->residentsCount);
$json->residentsCount = str_replace(",", "", $json->residentsCount);
$json->theArea = str_replace(" ", "", $json->theArea);
$json->theArea = str_replace(".", "", $json->theArea);
$json->theArea = str_replace(",", "", $json->theArea);
//print_r($json);

exit();


$sqlUpdateNation = "UPDATE `Nation` SET `id`='{$json->id}',`name`='{$json->nation}',`capital`='{$json->capital}',`idLanguage`='{$json->language}',`residentsCount`='{$json->residentsCount}',`theArea`='{$json->theArea}',`idMonetaryUnit`='{$json->money}',`logo`='{$json->logo}',`president`='{$json->president}' WHERE id = '{$json->id}'";
$query           = $db->query( $sqlUpdateNation );















