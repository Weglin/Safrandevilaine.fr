<?php
class ContactController extends Controller{
	public $mail= null;

	public function __construct($request){
		parent::__construct($request);
		$this->loadModel('Contact');
	}

	public function view(){
		//par défaut on affiche le formulaire de contact
		$this->render->assignVar('screen','tpl',array('file'=> './formulaire.tpl'));

		//on initialise quelques variables
		$data= new stdClass();

		if(!empty($this->request->data)){
			$data=$this->request->data;

			$this->loadModel('Config');
			$data->to=$this->Config->findFirst(array(
												'conditions'=>array('name'=>'email',
																	'param'=>'contact'),
												'fields'=>'value'))->value;
			//on vérifie les données
			$validated=$this->Contact->validates($data);
			if($validated===true){
				//on charge les paramètres SMTP
				$this->getSMTPparams();

				//on envoie l'entête du mail
				$this->render->assignVar('mail','header', array(
														'email'=>$data->email,
														'name'=>$data->name,
														'subject'=>$data->subject,
														'to'=>$data->to));
				//on envoie les infos du mail
				$this->render->assignVar('mail','tpl', array('data'=>$data));

			}else{
				foreach ($validated as $k=>$v){
					$this->setInfos ($v, 'info');
				}
				$this->setInfos('Erreur : Les infos saisies ne semblent pas correctes, merci de vérifier','error');
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