<?php
class Render implements SplSubject{

	public $output= array();
	public $request;
	protected $observers=array();

	function __construct($request){
		$this->request=$request;
	}
	

	public function fetch(){
		$this->loadRenders();
		if (isset($this->ScreenRender)){
			$this->ScreenRender->update($this);
		}
	}

	public function e404(){
		$file= ROOT.DS.'render'.DS.'ScreenRender.php';
		if (file_exists($file))	require_once $file;
		$ScreenRender= new ScreenRender();
		$ScreenRender->e404($this);
	}

	public function addMedia($media){
		$this->output[$media]=null;
	}

	public function addPlugin($media, $plugin){
		$this->output[$media]['plugins'][]=$plugin;
		//$this->output[$media]['plugins'][]='plugintest';
		//debug($this->output[$media]);
	}

	public function removePlugin($media, $plugin){

		if (is_int ($key = array_search($plugin, $this->output[$media]['plugins'], true))) unset($this->output[$media]['plugins'][$key]);
	}

	public function assignVar($media, $param, $var){
		foreach ($var as $k=>$v){
			$this->output[$media][$param][$k]=$v;	
		}		
	}

	public function loadRenders(){
		foreach ($this->output as $k=>$v){
			$name = ucfirst($k).'Render';
			$file = ROOT.DS.'render'.DS.$name.'.php';
			if (file_exists($file)){
				require_once $file;
			}
			$this->$name = new $name();
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