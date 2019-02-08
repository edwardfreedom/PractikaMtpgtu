<?php

/**
 * Created by PhpStorm.
 * User: Anatoliy
 * Date: 17.08.2016
 * Time: 20:20
 */

require_once __DIR__ . '/../others/Settings.php';
require_once('MysqliDb.php');
class DB {
	private static $instance = null;

	// The constructor is private
	// to prevent initiation with outer code.
	private function __construct() {
		// The expensive process (e.g.,db connection) goes here.
	}

	// The object is created from within the class itself
	// only if the class has no instance.
	public static function getInstance() {
		if ( self::$instance == null ) {
			self::$instance = new MysqliDb( Settings::$configDb['server'], Settings::$configDb['user'], Settings::$configDb['pass'], Settings::$configDb['base'] );
            self::$instance = MysqliDb::getInstance();
		}

		return self::$instance;
	}
}