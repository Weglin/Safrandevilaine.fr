<?php
class Dispatcher {
	
	var $request;

	function __construct(){
		$this->request = new Request();
		Router::parse($this->request->url,$this->request);
		//debug($this->request);
		$controller = $this->loadController();
		if(!$controller){
			$this->error('La page demandée n\'est pas disponible !<br /> Si ce problème persiste, merci d\'avertir l\'administrateur du site');
		}
		$action= $this->request->action;
		if($this->request->prefix){
			$action=$this->request->prefix.'_'.$action;
		}
		if(!in_array($action, array_diff(get_class_methods($controller), get_class_methods('Controller')))){
			$this->error('Le controller '.$this->request->controller.' n\'a pas de méthode '.$action);
		}
		
		// Dispatcher : exécuter la méthode(action) relative au "controller" ex: /pages/view/ l'action (ou méthode) "view" du controller "pages"
		//fonction de rappel (array(class, méthode de la class), tableau de paramètres) càd permet d'utiliser une $méthode d'une $class
		call_user_func_array(array($controller,$action),$this->request->params);

		//actualiser les sorties
		$controller->render->fetch();
	}

	function error($message){
		$controller=new Controller($this->request);
		$controller->e404($message);
	}

	function loadController (){
		$name = ucfirst($this->request->controller).'Controller';
		$file = ROOT.DS.'controller'.DS.$name.'.php';
		if (file_exists($file)){
			require $file;
			return new $name($this->request);
		}
		else {
			return false;
		}
	}

}



?>