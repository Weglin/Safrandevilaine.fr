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
		//debug('on est dans le screenRender');
		//debug($render->output);

		header("Cache-Control: no-cache, must-revalidate");
		if (isset($render->output['screen']['plugins'])){
			if (is_int ($key = array_search('tinyMCE', $render->output['screen']['plugins'], true))) $this->addTinyMCE();
		} 

		if ($render->request->prefix=='admin'){
			$action='admin_'.$render->request->action;
		}else{
			$action=$render->request->action;
		}
		Session::write('lastPage',substr($render->request->url,1));

		$view = _TPL_.DS.$render->request->controller.DS.$action.'.tpl';
		
		// assignation du bandeau login (et du nom de l'utilisateur, si il existe)
		if ($user=Session::read('user')){
			$this->tpl->assign('tplLogFile','./logout.tpl');
			$this->tpl->assign('user', 'Bienvenue '.$user->prenom.' '.$user->nom);	
		}else{
			$this->tpl->assign('tplLogFile','./login.tpl');
		}

		// assignation des messages d'information utilisateur
		$this->tpl->assign('infos', Session::GetInfos());
		
		// assignation des variables de page
		$this->assignVar($render->output);

		// préparation de la page
		$this->tpl->assign('body',$this->tpl->fetch($view));
		// rendu de la page dans le layout
		$this->tpl->display(_TPL_.DS.'layout'.DS.$this->layout($render->request).'.tpl');
	}

	public function e404(SplSubject $render){
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
			if ($request->controller=='media' && strpos($request->action, 'J')===0){
				$layout='modal';
			} else {
				$layout='admin';
			}
		}else{
			$layout=Conf::$layout;
		}
		if (Conf::$debug>2){
			$layout='test_css';
		}
		return $layout;	
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