<?php

function debug($var, $varName="Variable"){
	if(Conf::$debug>0){
		$debug = debug_backtrace();
		echo '<script type="text/javascript" src="'.BASE_URL.'/webroot/js/jquery-1.10.2.js"></script>';
		echo '<br /><div style="background-color:white;"><p><a href="#" onclick="$(this).parent().next(\'ol\').slideToggle(); return false;"><strong>'.$debug[0]['file'].'</strong> l.'.$debug[0]['line'].'</a></p>';
		echo '<ol  style="display:none;">';
		foreach ($debug as $k => $v) { 
			if($k>0){
				if (isset($v['file'])){
					echo '<li><strong>'. $v['file'].'</strong> l.'.$v['line'].'</li>';
				}
			}
		}
		echo '</ol>';
		echo '<pre>'. $varName .' =<br />';
		print_r($var);
		echo '</pre>';
		echo '</div>';
	}
}

function insert_DynamicUrl ($vars){
	if(is_array($vars)){
		if ($vars['type']='actu'){
			return (Router::url('actualite/view/id:'.$vars['id'].'/slug:'.$vars['slug']));	
		}		
	}else{
		return ('/');
	}
}

function StringIsInt($string) {
   return(is_numeric($string) ? intval(0+$string) == $string : false);
}

?>



