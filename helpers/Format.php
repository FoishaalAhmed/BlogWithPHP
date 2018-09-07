<?php 
	/**
	* format class
	*/
	class Format
	{
		public function formatDate($date)
		{
			return date('F j, Y, g:i a', strtotime($date));
		}

		public function textShort($text, $limit = 400)
		{
			$text = $text." "; // for append
			$text = substr($text, 0, $limit);
			$text = substr($text, 0, strrpos($text, ' '));
			$text = $text.'....';
			return $text;
		}
		// admin login validation
		public function validation($data)
		{
			$data = trim($data);
			$data = stripcslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}
		// page title showing helpers for non-database pages
		public function title()
		{
			$path = $_SERVER['SCRIPT_FILENAME']; // for file path
			$title = basename($path, '.php');

			if ($title == 'index') {
			 	$title = 'home';
			 } elseif ($title == 'contact') {
			 	$title = 'contact';
			 }
			 return $title = ucfirst($title);
		}
	}
?>