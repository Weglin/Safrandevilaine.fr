<?php
class ScreenRender implements SplObserver {

	var $tpl;

	function __construct(){
		// Initialisation Smarty
		$this->tpl = new Smarty();
		$this->tpl->assign('BASE_URL',BASE_URL);
		$this->tpl->assign('CSS', _CSS_);
	}

	public function update(SplSubject $render){
		header("Cache-Control: no-cache, must-revalidate");
		if (isset($render->output['screen']['plugins'])){
			if (is_int ($key = array_search('tinyMCE', $render->output['screen']['plugins'], true))) $this->addTinyMCE();
		}
	
		if ($render->request->prefix==Params::getPrefix() && !Session::read('isAdmin')){
				$controller='user';
				$action='login';
		}else{
			$action=$render->request->action;
			$controller=$render->request->controller;
		}
		$lastPage=trim($render->request->url,'/');
		if (!in_array($lastPage,Conf::$excludePages)){
			Session::write('lastPage',$lastPage);
		}
		unset($lastPage);		

		$view = _TPL_.DS.$controller.DS.$action.'.tpl';
		// assignation des variables du bandeau login
		$this->assignUserInfos();


		// assignation des messages d'information utilisateur (header)
		$this->tpl->assign('infos', Session::GetInfos());
		
		// assignation des variables de page (content)
		$this->assignVar($render->output);

		// préparation de la page
		$this->tpl->assign('body',$this->tpl->fetch($view));
		// rendu de la page dans le layout
		$this->tpl->display(_TPL_.DS.'layout'.DS.$this->layout($render->request).'.tpl');
	}

	public function e404(SplSubject $render){
		// assignation des variables du bandeau login
		$this->assignUserInfos();

		header("HTTP/1.0 404 Not Found");
		$this->assignVar($render->output);

		$this->tpl->assign('body',$this->tpl->fetch(_TPL_.DS.'errors'.DS.'404.tpl'));
		$this->tpl->display(_TPL_.DS.'layout'.DS.$this->layout($render->request).'.tpl');
	}

	public function assignVar($output){
		if (isset($output['screen']['tpl']) && !empty($output['screen']['tpl'])){
			foreach ($output['screen']['tpl'] as $k=>$v){
				$this->tpl->assign($k,$v);
			}
		}
	}

	public function layout($request){
		if (isset($request) && $request->prefix==true){
			if (Session::read('isAdmin')){
				if ($request->controller=='media' && strpos(str_replace('admin_','',$request->action), 'J')===0){
					$layout='modal';
				} else {
					$layout='admin';
				}	
			}else{
				$layout='reservedZone';
			}

		}else{
			$layout=Conf::$layout;
		}
		if (Conf::$debug>2){
			$layout='test_css';
		}
		return $layout;	
	}

	public function assignUserInfos(){
		$user=Session::getUser();
		$userInfos=Session::getUserInfos();
		if (isset($user->id)){
			$this->tpl->assign('tplLogFile','./logout.tpl');
			if (!empty($userInfos)){
				$this->tpl->assign('userInfos', $userInfos);
			}else{
				$this->tpl->assign('userInfos', 'Bienvenue '.$user->prenom.' '.$user->nom);		
			}
			
		}else{
			$this->tpl->assign('tplLogFile','./login.tpl');
			if (!empty($userInfos)){
				$this->tpl->assign('userInfos', $userInfos);
				Session::destruct('userInfos');		
			}
			if (isset($user->email)){
				$this->tpl->assign('userEmail', Session::getUser()->email);
			}
		}	
	}

	/**
	* Intégration du JS TinyMCE
	**/
	public function addTinyMCE(){
		$tinyMCE='<script type="text/javascript" src="'.Router::webroot('js/tinymce/tinymce.min.js').'"></script>';
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


}

?>