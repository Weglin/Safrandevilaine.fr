<?php
class ContactController extends Controller{
	public $mail= null;

	public function __construct($request){
		parent::__construct($request);
		require_once ROOT.DS.'plugins'.DS.'phpmailer'.DS.'PHPMailerAutoload.php';
		$this->loadModel('Contact');
		$this->mail= new phpmailer();
	}

	public function view(){
		//par défaut on affiche le formulaire de contact
		$this->tpl->assign('file','./formulaire.tpl');

		//on initialise quelques variables
		$data= new stdClass();

		if(!empty($this->request->data)){
			$data=$this->request->data;

			$validated=$this->Contact->validates($data);
			//on vérifie les données
			if($validated===true){
				//on crééer le contenu du mail
				$this->prepareMail($data);
				
				if ($this->sendMail($this->mail)){
					//affiche la confirmation de l'envoie
					$this->setInfos('Votre demande de contact à bien été envoyé','success');
					$this->tpl->assign('file','./send.tpl');	
				}else{
					//ou on notifie l'erreur d'envoie
					$this->setInfos('Erreur : une erreur s\'est produite lors de l\'envoie, merci de rééssayer','error');
					$this->tpl->assign('data',$data);
				}
			}elseif(is_array($validated)){
				foreach($validated as $k=>$v){
					$this->setInfos('Erreur : '.$v,'error');
					$data->$k=null;					
				}
				$this->tpl->assign('data',$data);
			}else{
				$this->setInfos('Erreur : une erreur s\'est produite lors de la vérification de vos données, merci de rééssayer','error');
				$this->tpl->assign('data',$data);
			}
		}else{
			$data->name="";
			$data->email="";
			$data->content="";
			$this->tpl->assign('data',$data);
		}

		//on envoie les messages d'erreur ou de succes
		$this->infos();
	}

	public function prepareMail($data){
		$this->loadModel('Config');
		$to=$this->Config->findFirst(array(
							'conditions'=>array('name'=>'contact',
												'param'=>'email'),
							'fields'=>'value'));

		$this->mail->From 		= $data->email; 
	    $this->mail->FromName 	= $data->name;
	    $this->mail->Subject 	= $data->subject; 
	    $this->mail->Body 		= $this->writeMail($data); 
	    $this->mail->AddAddress($to);
	} 

	public function writeMail($data){
		//on rédige le message
		$message ='<HTML><BODY>';
		$message.='<div style="height:20px;"></div>';
		$message.='<span style="font-size=14px;">Vous avez une demande de contact de la part de :</span><br/>';
		$message.='<bold style="margin-left:15px;"> Nom :</bold> '.$data->name.'<br />';
		$message.='<bold style="margin-left:15px;"> E-mail :</bold> '.$data->email.'<br />';
		$message.='<div style="height:20px;"></div>';
		$message.='<span style="font-size=14px;">Son message est le suivant :</span><br/>';
		$message.='<div style="margin-left:15px;">'.$data->content.'</div>';
		$message.='</BODY></HTML>';
	}

}
?>