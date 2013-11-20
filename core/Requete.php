<?php
class Requete {
	public $table  = null;
	public $fields = null;
	public $joins  = array();
	public $wheres = array();
	public $limit  = null;
	public $orders = array();
	public $group  = null;

	/**
	*	Constructeur, initialisation de la table principale
	*	@param 	$table 					array('nom' => 'nom_table',
	*										'alias' => 'alias_table',
	*										'primary_key' => 'cle primaire')
	**/
	public function __construct($table){
		$this->table=$table;
	}

	public function fields($fields=null){
		if (!empty($fields)){
			if(is_array($fields)){
				$this->fields= implode(', ',$fields);
			}
			else{
				$this->fields= $fields;
			}
		}
		else {
			$this->fields="* ";
		}
	}

	/**
	*	Ajouter une jointure
	*	@param 	$join 					array(
	*										'type'=>'type de jointure',
	*										'nom' =>'nom table',
	*										'alias'=>'alias table',
	*										'primary_key' => 'cle primaire')
	**/
	public function join(array $join){
		$this->joins[] = $join;
	}

	/**
	*	Ajouter un sélecteur
	*	@param 	$where 					array()
	**/
	public function where($leftCond, $rightCond, $comp='=', $select="AND"){
		if (!is_numeric($rightCond)){
			$rightCond = '"'.mysql_real_escape_string($rightCond).'"';	
		}
		$this->wheres[]=array('condition'=>$leftCond.$comp.$rightCond,
							'select'=> $select);
	}

	public function limit($limit){
		$this->limit=$limit;
	}

	/**
	*	Ordonner le résultat par colonne
	*	@param 	$order 					array(
	*										'field'=>'nom du champ',
	*										'order'=>'ASC DESC')
	**/
	public function order_by(array $order){
		$this->orders[]=$order;
	}

	/**
	*	Grouper sur un champ
	**/
	public function group_by($group){
		$this->group=$group;
	}




	/**
	*	Créer une requête SELECT
	**/
	public function select(){
		return $this->make('SELECT', 'FROM');
	}

	/**
	*	Créer une requête INSERT INTO
	**/
	public function add($fields){
		$this->fields($fields);
		return $this->make('INSERT INTO', 'SET');

	}

	/**
	*	Créer une requête UPDATE
	**/
	public function update(array $fields, $id){
		$this->fields($fields);
		$this->where($this->table['primary_key'], $id,"=");
		return $this->make('UPDATE', 'SET');
	}

	/**
	*	Créer une requête DELETE
	**/
	public function delete($id){
		$this->where($this->table['primary_key'], $id, "=");
		return $this->make('DELETE', 'FROM');
	}

	/**
	* Création de la requête
	**/
	public function make($type_req, $opt_req=null){
		$sql=$type_req." ";
		if ($opt_req=='FROM'){
			if ($type_req!="DELETE"){
				if (!empty($this->fields)){
					$sql.=$this->fields." ";
				}else {
					$sql.="* ";
				}	
			}
			$sql.=$opt_req." ";
		}
		
		//affectation de la table principale
		if (!empty($this->table)){
			$sql.= $this->table['nom']." ";
			if ($type_req=="SELECT"){
				$sql.="AS ".$this->table['alias']." ";
			}
		}else{
			$this->reset();
			return false;
		}
		
		if ($opt_req=='SET'){
			$sql.='SET '.$this->fields." ";
		}
		
		//jointure
		if (!empty($this->joins)){
			foreach ($this->joins as $k){
				$sql.=$k['type']." JOIN ".$k['nom']." AS ".$k['alias']." ON ".
				$this->table['alias'].'.id_'.substr($k['nom'],0,-1).'='.$k['alias'].".".$k['primary_key']." ";
			}		
		}

		//set
		if (!empty($this->set)){
			$sql.="SET ".implode(',',$this->set);
			$sql.= " ";
		}

		//where
		if (!empty($this->wheres)){
			$sql.="WHERE ";
			$sql.=$this->wheres[0]['condition']." ";
			for ($i=1; $i < count($this->wheres); $i++) { 
				$sql.=$this->wheres[$i]['select']." ".$this->wheres[$i]['condition']." ";
			}
		}

		//limites
		if (!empty($this->limit)){
			$sql .= "LIMIT ".$this->limit." ";
		}

		//order by
		if (!empty($this->orders)){
			$sql.="ORDER BY ";
			reset($this->orders);
			$order=each($this->orders);
			while ($order['key']< count($this->orders)) {
				$sql.=$order['value']['field']." ";
				if(!empty($order['value']['order'])){
					$sql.=$order['value']['order'];
				}
				$sql.=", ";
				$order=each($this->orders);
			}
			$sql.=$order['value']['field']." ";
			if(!empty($order['value']['order'])){
				$sql.=$order['value']['order']." ";
			}			
		}
		$this->reset();
		return $sql;
	}

	public function reset(){
		$this->fields = null;
		$this->joins = array();
		$this->wheres = array();
		$this->limit = null;
		$this->orders = array();
		$this->group = null;
	}


}
?>