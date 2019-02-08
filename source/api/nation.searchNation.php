<?php
/**
 * Created by PhpStorm.
 * User: Anatoliy
 * Date: 18.05.2016
 * Time: 21:40
 */
require_once dirname(dirname(__FILE__)) . '/classes/others/Settings.php';
require_once dirname(dirname(__FILE__)) . '/classes/bd/DB.php';
$db       = DB::getInstance();
$searchName = $_GET["name"];

//if ( !is_numeric( $searchName ) ) {
	$sql = "SELECT DISTINCT n.id,	 n.*
							FROM Nation as n
							WHERE  (n.name LIKE '%{$searchName}%' || n.capital LIKE '%{$searchName}%'
							|| n.president LIKE '%{$searchName}%')";
//} else {
//	$sql = "SELECT DISTINCT n.id,	 n.*, l.name as \"languageName\", m.name as \"moneyName\"
//							FROM Nation as n, Language as l, Money as m
//							WHERE (n.idLanguage = l.id and n.idMonetaryUnit = m.id)
//							AND (n.residentsCount > '{$searchName}' || n.theArea > '{$searchName}')";
//}

$query = $db->rawQuery( $sql );
$response = array();

foreach ( $query as $item_id => $item ) {
    $allGroups .= $item["url"] . ',';
    $response[] = [
        'id'             => $item["id"],
        'name'           => $item["name"],
        'capital'        => $item["capital"],
        'residentsCount' => $item["residentsCount"],
        'theArea'        => $item["theArea"],
        'languageName'   => $item["idLanguage"],
        'logo'           => $item["logo"],
        'money'          => $item["idMonetaryUnit"],
        'president'      => $item["president"]

    ];
}
$results = [
		'response' => [
				'count' => count($response),
				'items' => $response
		]
];
print_r( json_encode( $results ) );





















