<?php
class Router {

	static $routes=array();
	static $prefixes= array();

	/**
	* permet d'associer une url à un prefix afin de créer une liste de préfixes
	* @param 	$url 					Url 
	*			$prefix 				prefix
	* @return 	le nom du préfix 
	**/
	static function prefix($url, $prefix){
		self::$prefixes[$url]=$prefix;
	}

	/**
	* permet de parser une url au format /controller/action/param1/param2...
	* @param 	$url 					Url à parser
	*			$request 				objet request à implémenter
	* @return 	$request->controller 	nom du controller
	*			$request->action 		nom de la méthode a exécuter (action)
	*			$request->params 		tableau contenant les paramètres
	**/
	static function parse ($url,$request){
		$url =trim($url,'/');
		$url= $url ? $url : '/';
		foreach(Router::$routes as $v){
			if(preg_match($v['catcher'],$url,$match)){
				$request->controller=$v['controller'];
				$request->action=isset($match['action']) ? $match['action'] : $v['action'];
				$request->params =array();
				foreach ($v['params'] as $k => $w) {
					if (isset($match[$k])){
						$request->params[$k]=$match[$k];	
					}
					else{
						$request->params[$k]=$w;	
					}
				}

				if(!empty($match['args'])){
					$request->params += explode('/',trim($match['args'],'/'));
				}
				return $request;
			}
		}

		$params = explode('/',$url);

		if(in_array($params[0],array_keys(self::$prefixes))){
			$request->prefix = self::$prefixes[$params[0]];
			array_shift($params);
			//Page pas défaut de l'administration
			$request->controller = isset($params[0]) ? $params[0] : 'config';
			$request->action = isset($params[1]) ? $params[1] : 'index';
			$request->params = array_slice($params, 2);
			return true;
		}

		self::error('La page demandée n\'est pas disponible !<br /> Si ce problème persiste, merci d\'avertir l\'administrateur du site');
	}

	/**
	* fonction connect
	* @param 	$redir 					Url de redirection
	*			$url 					Url original
	* @return 	
	**/
	static function connect($redir,$url){
		$r=array();

		$r['params'] = array();
		$r['url'] = $url;
		$r['redir'] = $redir;

		$r['origin'] = str_replace(':action','?P<action>([a-z0-9\-]+)',$url);
		$r['origin'] = preg_replace('/([a-z0-9]+):([^\/]+)/','${1}:(?P<${1}>${2})',$r['origin']);
		$r['origin'] = '/^'.str_replace('/','\/', $r['origin']).'(?P<args>\/?.*)$/';
		$params = explode('/',$url);
		foreach($params as $k=>$v){
			if(strpos($v,':')){
				$p = explode(':',$v);
				$r['params'][$p[0]]=$p[1];
			}
			else{
				if($k==0){
					$r['controller']=$v;
				}
				elseif($k==1){
					$r['action']= $v;
				}
			}
		}

		$r['catcher'] = $redir;
		foreach($r['params'] as $k=>$v){
			$r['catcher'] = str_replace(":$k","(?P<$k>$v)", $r['catcher']);
		}
		$r['catcher'] = '/^'.str_replace('/','\/',$r['catcher']).'(?P<args>\/?.*)$/';
		self::$routes[] = $r;

	}

	/**
	* permet d'afficher l'url
	* @param 	$url 					
	*					
	* @return 	
	**/
	static function url($url){
		foreach (self::$routes as $v) {
			if(preg_match($v['origin'],$url,$match)){
				foreach($match as $k=>$w){
					if(!is_numeric($k)){
						$v['redir'] =str_replace(":$k",$w,$v['redir']);
					}
				}
				return BASE_URL.str_replace('//','/','/'.$v['redir']).$match['args'];
			}
		}		
		foreach (self::$prefixes as $k=>$v){
			if(strpos($url,$v) === 0){
				$url = str_replace($v,$k,$url);
			}	
		}
		return BASE_URL.'/'.$url;
	}

	static function error($message){
		$controller=new Controller;
		$controller->e404($message);
	}

	static function webroot($url){
		trim($url,'/');
		return BASE_URL.'/webroot/'.$url;
	}

}

?>
