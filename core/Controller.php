<?php
class Controller {

	public $request;
	private $vars     = array();
	public $layout    = 'public_user';
	private $rendered = false;
	public $tpl;
	public $infos;
	
	function __construct($request=null){
		//on initialise la session
		if(!isset($_SESSION)){session_start();}

		// On stock la request dans l'instance
		if ($request) { $this->request = $request; }
		
		header("Cache-Control: no-cache");
		// Initialisation Smarty
		$this->tpl = new Smarty();
		$this->tpl->assign('BASE_URL',BASE_URL);
		$this->tpl->assign('CSS', _CSS_);
	}

	public function render($action){
		if(strpos($action,'/')===0){
			$action = _TPL_.DS.$action.'.tpl';
		}
		else{
			$action = _TPL_.DS.$this->request->controller.DS.$action.'.tpl';
		}

		$this->tpl->assign('body',$this->tpl->fetch($action));

		//choix du layout
		if (isset($this->request)&&$this->request->prefix==true){
			if ($this->request->controller=='media' && strpos($this->request->action, 'J')===0){
				$this->layout='modal';
			} else {
				$this->layout='admin';
			}
		}
		if (Conf::$debug>2){
			$this->layout='test_css';
		}

		$this->tpl->display(_TPL_.DS.'layout'.DS.$this->layout.'.tpl');
		$this->rendered = true;
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
	* Permet d'appeler un controller depuis une vue
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
		header("HTTP/1.0 404 Not Found");
		$this->tpl->assign('message',$message);
		$this->render('/errors/404');
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
			$this->tpl->assign('infos', $infos);
			unset($_SESSION['infos']);	
		}
	}

	/**
	* Intégration du JS TinyMCE
	**/
	public function addTinyMCE(){
		$tinyMCE='<script type="text/javascript" src="'.Router::webroot('js/tinymce/tinymce.min.js').'"></script>"';
		$tinyMCE.="	<script type='text/javascript'>
						tinymce.init({
							selector: 'textarea',
							relative_urls : false,
							popup_css : false,
							plugins: [
								'advlist autolink lists link charmap print preview anchor',
								'searchreplace visualblocks code fullscreen',
								'insertdatetime media table contextmenu paste',
								'image'
							],
							image_advtab: true,
							toolbar: 'insertfile undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist | link unlink image',
							file_browser_callback: function (field_name, url, type, win){
								tinymce.activeEditor.windowManager.open(
									{
										title:'Gallerie',
										url:'".Router::url('admin/media/Jindex')."',
										width:'960',
										height:'800',
										resizable:'yes',
										inline:'yes',
										close_previous:'no'
									}, {
										oninsert: function(url) {
											win.document.getElementById(field_name).value = url;
											top.tinymce.activeEditor.windowManager.close();
										}
									});
									return false;
							}							
						});
					</script>";
		$this->tpl->assign('tinyMCE',$tinyMCE);
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