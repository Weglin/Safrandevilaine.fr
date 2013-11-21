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
		if(!isset($_SESSION)){session_start();}

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
	}

	/**
	* Permet de stocker des messages à affcher
	**/
	public function setInfos($message, $type=null){
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

	/**
	* Permet l'affichage de messages
	**/
	public function infos(){
		if (isset($_SESSION['infos'])){
			$infos=$_SESSION['infos'];
			$this->render->assignVar('screen','tpl',array('infos'=> $infos));
			unset($_SESSION['infos']);	
		}
	}

	/**
	*	Envoie de mail
	**/
	public function sendMail($mail){
		$this->loadModel('Config');

		$config=$this->Config->find(array(
									'conditions'=>array('name'=>'SMTP'),
									'fields'=>array('param', 'value')
									));
		$smtp= new stdClass;
	    foreach ($config as $k =>$v) {
	    	$param=$v->param;
	    	$smtp->$param=$v->value;
	    }

	    $mail->IsHTML(true);
	    $mail->CharSet = 'UTF-8';
    
	    //SMTP
	    $mail->IsSMTP();
	    $mail->SMTPAuth = true;
	    $mail->Host = $smtp->host; //"mail.safrandevilaine.fr"
	    $mail->Port = $smtp->port; //25
	    $mail->Username = $smtp->username; //"contact@safrandevilaine.fr"
	    $mail->Password = $smtp->password; //"GH19FXC4A"



	    /*
	    if(!$mail->Send()) {
	    	return FALSE; 
	    }else{
	    	return TRUE;
	    }*/
	    $mail->ClearAddresses();
	    return true;		
	}
}

?>