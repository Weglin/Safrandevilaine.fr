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
		$dataRuleEmail = array (
			'contact'=> array (
				'rule' => 'mail',
				'message'=> "L' e-mail de contact doit être au format user@domaine.com"),
		);

		if(!empty($this->request->data)){
			//on simplifie le nom de la variable
			$data=$this->request->data;
			$name=$data->name;
			$dataRule='dataRule'.ucfirst($name);
			$this->Config->setCustomDataRule($$dataRule);
			$result=$this->Config->save($data);
			if($result===true){
				$this->setInfos ('Les paramètres ont bien été modifiés', 'success');
			}else{
				foreach ($result as $k=>$v){
					$this->setInfos ($v, 'info');
				}
				$this->setInfos ('Erreur : Les paramètres n\'ont pu être modifiés', 'error');
			}
			foreach ($data as $k => $v) {
				$this->render->assignVar('screen','tpl',array($name.ucfirst($k)=> $v));
			}
			
		}
		$configMail=$this->Config->find(array(
									'conditions'=>array('name'=>'email',
														'param'=>'contact'),
									'fields'=>array('name','param','value')));
		
		foreach ($configMail as $k =>$v) {
	    	$this->render->assignVar('screen','tpl',array($v->name.ucfirst($v->param) => $v->value));
	    }
		
	}

	public function admin_SMTP(){
		//on initialise les variables
		$smtp= new stdClass;
		$smtp->host ='';
		$smtp->port ='';
		$smtp->username ='';
		$smtp->password ='';

		$dataRuleSMTP = array(
			'host' => array(
				'rule' => 'notEmpty',
				'message' => "Vous devez renseigner un nom d'hôte"),
			'port'=> array(
				'rule' => 'entier',
				'message' => "Le Port doit être un nombre entier"),
			'username'=> array(
				'rule' => 'mail',
				'message'=> "L'identifiant doit être au format user@domaine.com"),
			'password'=> array(
				'rule' => 'notEmpty',
				'message'=> "Le mot de passe n'a pas été renseigné"));		

		if (!empty($this->request->data)){
			//on simplifie le nom de la variable
			$data=$this->request->data;
			$this->Config->setCustomDataRule($dataRuleSMTP);
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
	}
}

?>