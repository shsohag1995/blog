<?php


class Format {
	public function formatDate($date) {
		return date('j F , Y , g:i a',strtotime($date));
	}

	public function textShorten($text,$limit = 200) {
		if(strlen($text) < $limit) {
			return $text;
		}
		$text .= $text." ";
		$text = substr($text,0,$limit);
		$text = substr($text,0,strrpos($text,' '));
		$text .= $text."...";
		return $text;
	} 
	public function validation($data) {
		$data = trim($data);
		$data = stripcslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	public function title() {
		$title = basename($_SERVER['SCRIPT_FILENAME'],".php");
		if( $title == "index") {
			return "Home";
		}
		return ucwords($title);
	}
	public function evdo($id) {
		if( Session::get("userId") == $id || Session::get("userRole") == '0') {
			return true;
		}
	}
}