<?php 

class Conf {

	static $debug= 2;
	static $layout= 'public_user';

	static $databases= array(
			'default'=>array(
				'host' => 'localhost',
				'database' =>'safrandevilaine',
				'login'=> 'root',
				'password'=>''
			)
		);
	

	function __construct(){
		// Pages on charge le préfix d'administration
		$prefix=Params::getPrefix();
		Router::prefix($prefix,'admin');

		/****************************************************
		*	Routes pour la partie site
		*****************************************************/
		// Page par défaut => page accueil
		Router::connect('/','page/view/id:1/slug:accueil');
		
		//Pages statiques
		//Ces liens devront être générés à la volé depuis la bdd dans une table menu (titre, lien, id, slug) alimenté par l'administration.
		Router::connect('accueil', 'page/view/id:1/slug:accueil');
		Router::connect('safraniere', 'page/view/id:14/slug:safraniere');
		Router::connect('safran', 'page/view/id:16/slug:safran');
		Router::connect('preparations', 'page/view/id:19/slug:preparations');
		Router::connect('labelbio', 'page/view/id:20/slug:labelbio');
		Router::connect('lavilaine', 'page/view/id:21/slug:vallee-vilaine');


		//Pages dynamiques ou modules
		//Liens à générer comme au dessus
		Router::connect('produits', 'produit/index');		
		Router::connect('degustation', 'commerce/index/slug:degustation');
		Router::connect('commerces', 'commerce/index/slug:vente');
		Router::connect('contact', 'contact/view');
		// Cas particulié - Actualité
		Router::connect('actualite/:slug-:id', 'actualite/view/id:([0-9]+)/slug:([a-z0-9\-]+)');
		Router::connect('actualite', 'actualite/index');

		//page de test
		//Router::connect('test','page/view/id:18/slug:testimg');

		//Connection - Déconnection
		Router::connect('login', 'user/login');
		Router::connect('logout', 'user/logout');

		/****************************************************
		*	Routes pour la partie administration
		*****************************************************/
		// Page par défaut => config général
		Router::connect('/','config/index', 'admin');
		// Les autres liens sont générés à la volé avec les controlleur et les actions visibles



		//A garder ?
		//Router::connect(':slug-:id','page/view/id:([0-9]+)/slug:([a-z0-9\-]+)');
	}
}


?>