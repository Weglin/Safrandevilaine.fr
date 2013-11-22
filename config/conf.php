<?php 

class Conf {

	static $debug= 2;

	static $databases= array(
			'default'=>array(
				'host' => 'localhost',
				'database' =>'safrandevilaine',
				'login'=> 'root',
				'password'=>''
			)
		);
	static $layout= 'public_user';

	function __construct(){
		$this->loadModel('Config');

		// Page par défaut (accueil)
		Router::connect('/','page/view/id:1/slug:accueil');

		//Ces liens devront être générés à la volé depuis la bdd dans une table menu (titre, lien, id, slug) alimenté par l'administration.
		Router::connect('accueil','page/view/id:1/slug:accueil');
		//page de test
		//Router::connect('test','page/view/id:18/slug:testimg');


		//Nos produits
		Router::connect('safraniere','page/view/id:14/slug:safraniere');
		Router::connect('degustation','commerce/index/slug:degustation');
		Router::connect('commerces','commerce/index/slug:vente');
		//contact
		Router::connect('contact','contact/view');


		Router::connect('safran','page/view/id:16/slug:safran');
		Router::connect('preparations','page/view/id:19/slug:preparations');
		Router::connect('labelbio','page/view/id:20/slug:labelbio');
		Router::connect('lavilaine','page/view/id:21/slug:vallee-vilaine');

		//Router::connect(':slug-:id','page/view/id:([0-9]+)/slug:([a-z0-9\-]+)');

		// Pages dynamiques
		Router::connect('actualite/:slug-:id','actualite/view/id:([0-9]+)/slug:([a-z0-9\-]+)');
		Router::connect('actualite', 'actualite/index');

		// Pages d'administration
		$prefix=$this->Config->findFirst(array(
							'conditions'=>array('name'=>'general',
												'param'=>'shortURL'),
							'fields'=>array('value')))->value;

		Router::prefix($prefix,'admin');
	}

	/**
	 * Permet de charger un model
	 */
	public function loadModel ($name){
		if (!isset($this->$name)){
			$file = ROOT.DS.'model'.DS.$name.'.php';
			require_once($file);
			$this->$name = new $name();
		}
	}

}
?>