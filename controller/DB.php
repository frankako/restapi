<?php declare (strict_types = 1);

class DB {

	private static $writeDB;
	private static $readDB;

	public static function writeDbConnection() {
		self::$writeDB = new PDO("mysql:host=localhost;dbname=boxit_db;UTF-8", "root", "");
		self::$writeDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		self::$writeDB->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);

		return self::$writeDB;
	}

	public static function readDbConnection() {
		self::$readDB = new PDO("mysql:host=localhost;dbname=boxit_db;UTF-8", "root", "");
		self::$readDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		self::$readDB->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);
		return self::$readDB;
	}
}