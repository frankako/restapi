<?php declare (strict_types = 1);

function get_single($readDB, string $all, string $table, string $where, string $and = null, int $post_id, int $user_id = NULL) {
	$query = $readDB->prepare("SELECT " . $all . " FROM " . $table . " WHERE " . $where . " " . $and . "");
	$query->bindParam(":post_id", $post_id, PDO::PARAM_INT);
	if (isset($user_id) || $user_id != NULL) {
		$query->bindParam(":user_id", $user_id, PDO::PARAM_INT);
	}
	$query->execute();
	return $query;
}
