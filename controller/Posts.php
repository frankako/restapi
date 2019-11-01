<?php declare (strict_types = 1);

$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__) . $ds . "..") . $ds;
require_once "DB.php";
require_once "{$base_dir}model{$ds}Response.php";
require_once "{$base_dir}include{$ds}Responsetext.php";
require_once "{$base_dir}include{$ds}Single.php";

try {

	$writeDB = DB::writeDbConnection();
	$readDB = DB::readDbConnection();

} catch (PDOException $ex) {
	$response = new Response();
	responseText($response, 500, "false", ["Error processing request. Try again!"], []);
}

if (array_key_exists("post_id", $_GET) && array_key_exists("user_id", $_GET)) {
	//if array key exists, we can get single record, update or delete a record
	$post_id = $_GET['post_id'];
	$user_id = $_GET['user_id'];

	$select = 'post_id, ';
	$select .= 'category_id, ';
	$select .= 'user_id, ';
	$select .= 'title, ';
	$select .= 'body, ';
	$select .= 'status, ';
	$select .= 'DATE_FORMAT(post_date, "%Y-%m-%d %H:%i") AS post_date, ';
	$all = rtrim($select, ", ");

	$table = "posts";

	$where = "post_id = :post_id";
	$and = "AND user_id = :user_id";

	$query = get_single($readDB, $all, $table, $where, $and, (int) $post_id, (int) $user_id);
	echo json_encode($query->fetchAll(PDO::FETCH_OBJ));

} else {
	$response = new Response();
	$response->setCache(true);
	responseText($response, 500, "false", ["Error. Url not found!"], []);
}