<?php declare (strict_types = 1);

require __DIR__ . "/../Exception/PostException.php";

class Post {

	private $post_id;
	private $title;
	private $body;
	private $post_date;
	private $status;
	private $category_id;
	private $user_id;

	public function __construct($post_id, $category_id, $user_id, $title, $body, $status, $post_date) {
		$this->setPostId($post_id);
		$this->setCategoryId($category_id);
		$this->setUserId($user_id);
		$this->setTitle($title);
		$this->setBody($body);
		$this->setStatus($status);
		$this->setpost_date($post_date);
	}

	public function getTitle() {
		return $this->title;
	}

	public function getBody() {
		return $this->body;
	}

	public function getCategoryId() {
		return $this->category_id;
	}

	public function PostId() {
		return $this->post_id;
	}

	public function getUserId() {
		return $this->user_id;
	}

	public function getPostDate() {
		return $this->post_date;
	}

	public function getStatus() {
		return $this->status;
	}

	public function setPostId($post_id) {

		if ($post_id == NULL || !is_numeric($post_id) || $post_id <= 0 || $post_id > 9223372036854775807) {
			throw new PostException("Error: Invalid post id");
		} else { $this->post_id = $post_id;}
	}

	public function setUserId($user_id) {

		if ($user_id === null || !is_numeric($user_id) || $user_id <= 0 || $user_id > 9223372036854775807) {
			throw new PostException("Error: Invalid post owner id");
		} else { $this->user_id = $user_id;}
	}

	public function setCategoryId($category_id) {

		if ($category_id === null || !is_numeric($category_id) || $category_id <= 0 || $category_id > 9223372036854775807) {
			throw new PostException("Error: Invalid post category id");
		} else { $this->category_id = $category_id;}
	}

	public function setTitle($title) {

		if ($title === null || !is_string($title) || strlen($title) <= 0 || strlen($title) > 255) {
			throw new PostException("Error: Invalid post title");
		} else { $this->title = $title;}
	}

	public function setBody($body) {

		if ($body === null || !is_string($body) || strlen($body) <= 10 || strlen($body) > 4294967295255) {
			throw new postException("Error: Invalid post content");
		} else { $this->body = $body;}
	}

	public function setStatus($status) {

		if ($status === null || $status !== "ACTIVE" && $status !== "INACTIVE") {
			throw new PostException("Error: Invalid post status");
		} else { $this->status = $status;}
	}

	public function setPostDate($post_date) {

		if (($post_date !== null) && post_date_format(post_date_create_from_format('Y-m-d H:i', $post_date), 'Y-m-d H:i') != $post_date) {
			throw new PostException("Error: Invalid post post_date");
		} else { $this->post_date = $post_date;}
	}

	public function toArray() {
		$post = array();
		$post['post_id'] = $this->post_id;
		$post['category_id'] = $this->category_id;
		$post['user_id'] = $this->user_id;
		$post['title'] = $this->title;
		$post['body'] = $this->body;
		$post['status'] = $this->status;
		$post['post_date'] = $this->post_date;

		return $post;
	}
}