<?php
/**
 * Created by PhpStorm.
 * User: Anatoliy
 * Date: 17.05.2016
 * Time: 15:45
 */
require_once dirname(dirname(__FILE__)) . '/classes/others/Settings.php';
require_once dirname(dirname(__FILE__)) . '/classes/bd/DB.php';
exit();
$db       = DB::getInstance();
$id = $_GET["id"];
$sql   = "DELETE FROM `Nation` WHERE id = '{$id}'";
$query = $db->query( $sql );
$response = array();












