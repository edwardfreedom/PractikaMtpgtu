<?php
/**
 * Created by PhpStorm.
 * User: Anatoliy
 * Date: 16.05.2016
 * Time: 21:55
 */
require_once dirname(dirname(__FILE__)) . '/classes/others/Settings.php';
require_once dirname(dirname(__FILE__)) . '/classes/bd/DB.php';
$db       = DB::getInstance();
$sql   = "SELECT n.*	FROM Nation as n							";

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
//
//while ( $item = $db->rawQuery( $query ) ) {
//	$allGroups .= $item->url . ',';
//	$response[] = [
//			'id'             => $item->id,
//			'name'           => $item->name,
//			'capital'        => $item->capital,
//			'residentsCount' => $item->residentsCount,
//			'theArea'        => $item->theArea,
//			'languageName'   => $item->languageName,
//			'logo'           => $item->logo,
//			'money'          => $item->moneyName,
//			'president'      => $item->president
//
//	];
//}
$results = [
		'response' => [
				'count' => count($response),
				'items' => $response
		]
];
print_r( json_encode( $results ) );