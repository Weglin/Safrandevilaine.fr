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
		$dataRuleEmail = array(
			'contact'=> array(
				'rule' => 'mail',
				'message'=> "L' e-mail de contact doit être au format user@domaine.com"),
		);
		$dataRuleGeneral = array(
			'shortURL'=> array(
				'rule'=> 'slug',
				'message'=>"Le raccourci choisi ne doit comporter que des caractères alphanumériques"));

		if(!empty($this->request->data)){
			//on simplifie le nom de la variable
			$data=$this->request->data;
			$name=$data->name;
			$dataRule='dataRule'.ucfirst($name);
			$this->Config->setCustomDataRule($$dataRule);
			$result=$this->Config->save($data);
			if($result===true){
				Session::setInfos ('Les paramètres ont bien été modifiés', 'success');
			}else{
				foreach ($result as $k=>$v){
					Session::setInfos ($v, 'info');
				}
				Session::setInfos ('Erreur : Les paramètres n\'ont pu être modifiés', 'error');
			}
			foreach ($data as $k => $v) {
				$this->render->assignVar('screen','tpl',array($name.ucfirst($k)=> $v));
			}
			
		}
		$config=$this->Config->find(array(
									'conditions'=>array('name'=>'email'),
									'fields'=>array('name','param','value')));
		$config=array_merge($config,$this->Config->find(array(
									'conditions'=>array('name'=>'general'),
									'fields'=>array('name','param','value'))));

		foreach ($config as $k =>$v) {
	    	$this->render->assignVar('screen','tpl',array($v->name.ucfirst($v->param) => $v->value));
	    }
		
	}

	public function admin_smtp(){
		//on initialise les variables
		$smtp= new stdClass;
		$smtp->active = 0;
		$smtp->host ='';
		$smtp->port ='';
		$smtp->username ='';
		$smtp->password ='';
		$smtp->secure = 'NON';

		$config=$this->Config->find(array(
									'conditions'=>array('name'=>'ConnSMTPType'),
									'fields'=>array('value','param')));

		foreach($config as $k=>$v){
			$combo_secure[$v->value]=$v->param;
		}
		$this->render->assignVar('screen','tpl',array('combo_secure'=> $combo_secure));

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
			debug($data);
			$this->Config->setCustomDataRule($dataRuleSMTP);
			$result=$this->Config->save($data);
			if($result===true){
				Session::setInfos ('Les paramètres ont bien été modifiés', 'success');
			}else{
				foreach ($result as $k=>$v){
					Session::setInfos ($v, 'info');
				}
				Session::setInfos ('Erreur : Les paramètres n\'ont pu être modifiés', 'error');
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