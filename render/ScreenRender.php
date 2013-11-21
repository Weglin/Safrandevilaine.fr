<?php
class ScreenRender implements SplObserver {

	var $tpl;

	function __construct(){
		header("Cache-Control: no-cache, must-revalidate");
		
		// Initialisation Smarty
		$this->tpl = new Smarty();
		$this->tpl->assign('BASE_URL',BASE_URL);
		$this->tpl->assign('CSS', _CSS_);
	}

	public function update(SplSubject $render){



		//debug('on est dans le screenRender');
		//debug($render->output);
		if (isset($render->output['screen']['plugins']) && $render->output['screen']['plugins']=="tinyMCE") $this->addTinyMCE();

		if ($render->request->prefix=='admin'){
			$action='admin_'.$render->request->action;
		}else{
			$action=$render->request->action;
		}

		$view = _TPL_.DS.$render->request->controller.DS.$action.'.tpl';

		if (isset($render->output['screen']['tpl']) && !empty($render->output['screen']['tpl'])){
			foreach ($render->output['screen']['tpl'] as $k=>$v){
				$this->tpl->assign($k,$v);
			}
		}

		$this->tpl->assign('body',$this->tpl->fetch($view));

		//choix du layout
		if (isset($render->request) && $render->request->prefix==true){
			if ($render->request->controller=='media' && strpos($render->request->action, 'J')===0){
				$render->layout='modal';
			} else {
				$render->layout='admin';
			}
		}
		if (Conf::$debug>2){
			$render->layout='test_css';
		}
		$this->tpl->display(_TPL_.DS.'layout'.DS.$render->layout.'.tpl');
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