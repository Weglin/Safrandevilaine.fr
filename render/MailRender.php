<?php
class MailRender implements SplObserver {
	
	var $tpl;

	function __construct(){
		// Initialisation Smarty
		$this->tpl = new Smarty();
		$this->tpl->assign('BASE_URL',BASE_URL);
		$this->tpl->assign('CSS', _CSS_);

		//initialisation de PHPmailer
		require_once ROOT.DS.'plugins'.DS.'phpmailer'.DS.'PHPMailerAutoload.php';
		$this->mail= new phpmailer();
	}

	public function update(SplSubject $render){
		if($this->assignVar($render->output)){
			//changer contact.tpl par une valeur de conf suivant le type de mail envoyé
			$this->mail->Body = $this->tpl->fetch(_TPL_.DS.'mail'.DS.'contact.tpl');
			if ($this->sendMail()){
				$this->setInfos('Votre demande de contact à bien été envoyé','success');
				$render->assignVar('screen','tpl',array('file'=> './send.tpl'));
			}else{
				$this->setInfos('Erreur : une erreur s\'est produite lors de l\'envoie, merci de rééssayer ultérieurement','error');
			}
		}else{
			$this->setInfos('Erreur : une erreur s\'est produite lors de l\'envoie, merci de rééssayer ultérieurement','error');
		}
	}

	public function assignVar($output){
		if (isset($output['mail']['header']) && !empty($output['mail']['header'])){
			$this->mail->From 		= $output['mail']['header']['email']; 
		    $this->mail->FromName 	= $output['mail']['header']['name'];
		    $this->mail->Subject 	= $output['mail']['header']['subject'];
		    $this->mail->AddAddress($output['mail']['header']['to']);		    
		}else{
			return false;
		}

		if (isset($output['mail']['tpl']) && !empty($output['mail']['tpl'])){
			foreach ($output['mail']['tpl'] as $k=>$v){
				$this->tpl->assign($k,$v);
			}
		}else{
			return false;
		}

		if (isset($output['mail']['smtp']) && !empty($output['mail']['smtp'])){
			$this->mail->Host 		= $output['mail']['smtp']['host']; 		//"mail.safrandevilaine.fr"
		    $this->mail->Port 		= $output['mail']['smtp']['port']; 		//25
		    $this->mail->Username 	= $output['mail']['smtp']['username'];	//"contact@safrandevilaine.fr"
		    $this->mail->password 	= $output['mail']['smtp']['password'];	//"GH19FXC4A"		    
		}else{
			return false;
		}

		return true;
	}

	public function sendMail(){
	    $this->mail->IsHTML(true);
	    $this->mail->CharSet = 'UTF-8';
	    //Activation SMTP
	    $this->mail->IsSMTP();
	    $this->mail->SMTPAuth = true;

	    /*
	    if(!$mail->Send()) {
	    	return FALSE; 
	    }*/
	    $this->mail->ClearAddresses();
	    return true;		
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

}


?>