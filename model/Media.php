<?php
class Media extends Model{
	public function __construct(){
		parent::__construct();

	}

	public function find($req=array()){
		$this->requete->join(array(	'type'=>'INNER',
									'nom'=>'dossiers',
									'alias'=>'dos',
									'primary_key'=>'id'));
		return parent::find($req);		
	}
}