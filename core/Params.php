<?php
class Params{

	/**
	* Permet de charger un model
	*/
	public static function loadModel ($name){
		$file = ROOT.DS.'model'.DS.$name.'.php';
		if (file_exists($file)){
			require_once($file);
			return new $name();	
		}else{
			return false;
		}		
	} 

	public static function getSMTP(){
		$Config= self::loadModel('Config');
		$configSMTP=$Config->find(array(
									'conditions'=>array('name'=>'SMTP'),
									'fields'=>array('param', 'value')
									));
		$ConfigSMTP=array();
		foreach ($configSMTP as $k =>$v) {
	    	$ConfigSMTP[$v->param]=$v->value;
	    }
		$ConfigSMTP['secure']=$Config->findFirst(array(
									'conditions'=>array('name'=>'ConnSMTPType',
														'value'=>$ConfigSMTP['secure']),
									'fields'=>'param'))->param;
    	return $ConfigSMTP;
	}

	public static function getEmailContact(){
		$Config= self::loadModel('Config');
		$EmailContact= $Config->findFirst(array('conditions'=>array('name'=>'email',
																	'param'=>'contact'),
												'fields'=>'value'))->value;
		return $EmailContact;
	}

	public static function getPrefix(){
		$Config= self::loadModel('Config');
		$prefix=$Config->findFirst(array(
							'conditions'=>array('name'=>'general',
												'param'=>'shortURL'),
							'fields'=>array('value')))->value;
		return $prefix;
	}


}

?>