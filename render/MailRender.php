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
		if($this->assignVar($render->output['mail'])){
			//changer contact.tpl par une valeur de conf suivant le type de mail envoyé
			$this->mail->Body = $this->tpl->fetch(_TPL_.DS.'mail'.DS.'contact.tpl');
			if ($this->sendMail()===true){
				$render->assignVar('screen','tpl',array('file'=> './send.tpl'));
				$this->setInfos('Votre demande de contact a bien été envoyée','success');
			}else{
				$this->setInfos('Erreur : une erreur s\'est produite lors de l\'envoie, merci de rééssayer ultérieurement','error');
			}
		}else{
			$this->setInfos('Erreur : une erreur s\'est produite lors de l\'envoie, merci de rééssayer ultérieurement','error');
		}
	}

	public function assignVar($configMail){
		if (isset($configMail['header']) && !empty($configMail['header'])){
			$this->mail->From 		= $configMail['header']['email'];
		    $this->mail->FromName 	= $configMail['header']['name'];
		    $this->mail->Subject 	= $configMail['header']['subject'];
		    $this->mail->AddAddress($configMail['header']['to']);		    
		}else{
			return false;
		}

		if (isset($configMail['tpl']) && !empty($configMail['tpl'])){
			foreach ($configMail['tpl'] as $k=>$v){
				$this->tpl->assign($k,$v);
			}
		}else{
			return false;
		}

		if (isset($configMail['smtp']) && !empty($configMail['smtp'])){
			if ($configMail['smtp']['active']==true){
				//Activation SMTP
	    		$this->mail->IsSMTP();
				$this->mail->Host 		= $configMail['smtp']['host']; 		//"mail.safrandevilaine.fr"
			    $this->mail->Port 		= $configMail['smtp']['port']; 		//25
			    $this->mail->Username 	= $configMail['smtp']['username'];	//"contact@safrandevilaine.fr"
			    $this->mail->Password 	= $configMail['smtp']['password'];	//"GH19FXC4A"
			    if ($configMail['smtp']['secure']!='non'){
			    	$this->mail->SMTPAuth = true;
			    	$this->mail->SMTPSecure = $configMail['smtp']['secure']; //ssl ou tls
			    }	    
			}
		}else{
			return false;
		}

		return true;
	}

	public function sendMail(){
	    $this->mail->IsHTML(true);
	    $this->mail->CharSet = 'UTF-8';

	    if(!$this->mail->Send()) {
	    	$this->mail->ClearAddresses();
	    	return FALSE; 
	    }
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