<?php 
	class Comment extends Db_object {
		protected static $db_table = "comments";
		protected static $db_table_fields = array('photo_id', 'user_id', 'author', 'body', 'time');
		public $id;
		public $photo_id;
		public $user_id;
		public $author;
		public $body;
		public $time;
		public static function create_comment($photo_id, $user_id, $author="", $body="") {
			if (!empty($photo_id) && !empty($user_id) && !empty($author) && !empty($body)) {
				$comment = new Comment();
				$date = new DateTime();
				$comment->photo_id = (int)$photo_id;
				$comment->user_id = (int)$user_id;
				$comment->author = $author;
				$comment->body = $body;
				$comment->time = $date->format('d-m-y H:i:s');
				return $comment;
			} else {
				return false;
			}
		}
		public static function find_the_comments($photo_id=0) {
			global $database; 
			$sql = "SELECT * FROM " . self::$db_table;
			$sql.= " WHERE photo_id = " . $database->escape_string($photo_id);
			$sql.= " ORDER BY photo_id ASC";
			return self::find_by_query($sql);
		}
	}
?>