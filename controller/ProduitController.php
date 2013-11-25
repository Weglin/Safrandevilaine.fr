<?php
class ProduitController extends Controller{

	public function __construct($request){
		parent::__construct($request);
		$this->loadModel('Produit');
	}

	public function index(){
		
	}
}
?>