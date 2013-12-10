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

	public static function setUser($name, $value=null){
		if (is_object($name)){
			$_SESSION['user']=$name;
		}else{
			if (!isset($_SESSION['user'])){
				$_SESSION['user']=new stdClass;	
			}			
			$_SESSION['user']->$name=$value;	
		}
	}

	public static function getUser(){
		if (isset($_SESSION['user'])){
			return $_SESSION['user'];
		}else{
			return false;
		}		
	}

	public static function setUserInfos($value){
		$_SESSION['userInfos']=$value;
	}

	public static function getUserInfos(){
		if (isset($_SESSION['userInfos'])){
			return $_SESSION['userInfos'];
		}
		return false;
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

	public static function destruct($key, $propertie=null){
		if (self::read($key)){
			if ($propertie) {
				if (is_object($_SESSION[$key]) && isset($_SESSION[$key]->$propertie)){
					unset($_SESSION[$key]->$propertie);
					return true;
				}
			}else{
				unset($_SESSION[$key]);
				return true;
			}			
		}else{
			return false;
		}
	}	
}

?>