<?php
/**
 * Created by PhpStorm.
 * User: Anatoliy
 * Date: 17.05.2016
 * Time: 12:33
 */
require_once dirname(dirname(__FILE__)) . '/classes/others/Settings.php';
require_once dirname(dirname(__FILE__)) . '/classes/bd/DB.php';
$db       = DB::getInstance();

$id = $_GET["id"];
$db->query( "SET NAMES utf8" );
$sql   = "SELECT n.*
							FROM Nation as n WHERE n.id = {$id} limit 1";



$results = [
		'response' => [
				'item' => $db->query($sql)[0]
		]
];
print_r( json_encode( $results ) );



