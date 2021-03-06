<?php
class ContactController extends Controller{
	public $mail= null;

	public function __construct($request){
		parent::__construct($request);
		$this->loadModel('Contact');
	}

	public function view(){
		//on initialise quelques variables
		$data= new stdClass();

		if(!empty($this->request->data)){
			$data=$this->request->data;
			
			//on vérifie les données
			$validated=$this->Contact->validates($data);
			if($validated===true){
				//on envoie l'entête du mail
				$this->render->assignVar('mail','header', array(
														'email'=>$data->email,
														'name'=>$data->name,
														'subject'=>$data->subject,
														'to'=>Params::GetEmailContact()));
				//on envoie les infos du mail
				$this->render->assignVar('mail','tpl', array('data'=>$data));

			}else{
				foreach ($validated as $k=>$v){
					Session::setInfos ($v, 'info');
				}
				Session::setInfos('Erreur : Les infos saisies ne semblent pas correctes, merci de vérifier','error');
			}
		}else{
			$data->name="";
			$data->email="";
			$data->content="";
		}
		//on renvoie les données du formulaire en cas d'échec
		$this->render->assignVar('screen','tpl',array('data'=> $data));
	}
}
?>