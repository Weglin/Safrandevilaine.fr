<?php
class Controller {

	public $request;
	private $vars     = array();
	public $layout    = 'public_user';
	private $rendered = false;
	public $tpl;
	public $infos;
	public $render;
	
	function __construct($request=null){
		//on initialise la session
		//if(!isset($_SESSION)){session_start();}

		// On stock la request dans l'instance
		if ($request) {
			$this->request = $request;
		}
		$this->render= new Render($this->request);
	}

	public function set($key,$value=null){
		if (is_array($key)) {
			$this->vars += $key;
		}
		else{
			$this->vars[$key]=$value;	
		}
	}

	/*
	* Permet d'appeler un controller
	*
	*/
	function request($controller,$action){
		$controller .= 'Controller';
		require_once ROOT.DS.'controller'.DS.$controller.'.php';
		$c = new $controller();
		return $c->$action();
	}

	/**
	 * Permet de charger un model
	 */
	public function loadModel ($name){
		if (!isset($this->$name)){
			$file = ROOT.DS.'model'.DS.$name.'.php';
			require_once($file);
			$this->$name = new $name();
		}
	}

	/**
	 * Permet l'affichage d'un message d'erreur 404
	 */
	public function e404 ($message){
		$this->render->assignVar('screen','tpl',array('message'=> $message));
		$this->render->e404();
		die();
	}

	/**
	* Premet de rediriger vers une page
	**/
	public function redirect($url, $code=null){
		if ($code == 30){
			header("HTTP/1.1 301 Moved Permanently");
		}
		header("Location: ".Router::url($url));
		exit;

	}
}

?>