<?php
class Render implements SplSubject{

	public $layout = 'public_user';
	public $output= array();
	public $request=null;
	protected $observers=array();
	

	public function fetch($request){
		$this->request=$request;
		foreach ($this->output as $k=>$v){
			$name = ucfirst($k).'Render';
			$file = ROOT.DS.'render'.DS.$name.'.php';
			if (file_exists($file)){
				require_once $file;
			}
			$$name = new $name();
		}
		
		if (isset($ScreenRender)){
			$ScreenRender->update($this);
		}
	}

	public function addMedia($media){
		$this->output[$media]=null;
	}

	public function addPlugin($media, $plugin){
		$this->output[$media]['plugins']=$plugin;
	}

	public function assignVar($media, $param, $var){
		foreach ($var as $k=>$v){
			$this->output[$media][$param][$k]=$v;	
		}		
	}

	public function attach(SplObserver $observer){
		$this->observers[]=$observer;
	}

	public function detach(SplObserver $observer){
		if (is_int ($key = array_search($observer, $this->observers, true))) unset ($this->observers[$key]);
	}

	public function notify(){
		foreach ($this->observers as $k){
			$k->update($this);
		}
	}
}

?>