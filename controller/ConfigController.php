<?php
class ConfigController extends Controller{

	public function __construct($request){
		parent::__construct($request);
		$this->loadModel('Config');
	}

	/**
	* Affichage des options générales
	**/
	public function admin_index() {
		$this->render->addMedia('screen');
		$this->infos();
	}

	public function admin_SMTP(){
		//on initialise les variables
		$smtp= new stdClass;
		$smtp->host ='';
		$smtp->port ='';
		$smtp->username ='';
		$smtp->password ='';

		if (!empty($this->request->data)){
			//on simplifie le nom de la variable
			$data=$this->request->data;
			$result=$this->Config->save($data);
			if($result===true){
				$this->setInfos ('Les paramètres ont bien été modifiés', 'success');
			}else{
				foreach ($result as $k=>$v){
					$this->setInfos ($v, 'info');
				}
				$this->setInfos ('Erreur : Les paramètres n\'ont pu être modifiés', 'error');
			}
			$this->render->assignVar('screen','tpl',array('smtp'=> $data));
		}else{
			$config=$this->Config->find(array(
									'conditions'=>array('name'=>'SMTP'),
									'fields'=>array('param', 'value')
									));
		
		   	foreach ($config as $k =>$v) {
	    		$param=$v->param;
	    		$smtp->$param=$v->value;
	    	}
	    	$this->render->assignVar('screen','tpl',array('smtp'=> $smtp));
		}
		$this->infos();
	}
}

?>