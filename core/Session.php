<?php
class Session{

	public function __construct(){
		if(!isset($_SESSION)){
			session_start();
		}
	}

	public static function setInfos($message, $type=null){
		if (!isset($_SESSION['infos'])){
			$_SESSION['infos']=null;
		}
		if ($type){
			$_SESSION['infos'] .= '<div class="alert alert-'.$type.'">'.$message.'</div>';	
		}
		else{
			$_SESSION['infos'] .= '<div class="alert alert-info">'.$message.'</div>';
		}
	}

	public static function getInfos(){
		if (isset($_SESSION['infos'])){
			$infos=$_SESSION['infos'];
			unset($_SESSION['infos']);
			return $infos;	
		}
		else return null;
	}

	public static function write($key, $value){
		$_SESSION[$key]=$value;
	}

	public static function read($key){
		if (isset($_SESSION[$key])){
			return $_SESSION[$key];
		}else{
			return false;
		}
	}

	public static function destruct($key){
		if (self::read($key)){
			unset($_SESSION[$key]);
			if (self::read($key)){
				return false;
			}else{
				return true;
			}	
		}else{
			return true;
		}

		

	}


}

?>