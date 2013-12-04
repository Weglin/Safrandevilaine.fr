<?php 
/**
* 
*/
class Model {

	static $connections = array();
	
	public $conf = 'default';
	public $requete = false;
	public $db;
	public $primaryKey = 'id';
	public $valeurs = array();
	public $table = null;


	public $dataRule = array();
	public $errors = array();

	function __construct(){
		// J'initialise des variables
		if($this->requete === false){
			$this->table=strtolower(get_class($this));
			$this->requete = new Requete(array(	'nom'=>$this->table.'s',
												'alias'=>$this->table,
												'primary_key'=>$this->primaryKey));			
		}
		//connection à la base de donnée
		$conf = Conf::$databases[$this->conf];
		if(!isset(Model::$connections[$this->conf])){
			try {
				$pdo = new PDO ('mysql:host='.$conf['host'].';dbname='.$conf['database'].';',
					$conf['login'],
					$conf['password'],
					array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

				$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);

				Model::$connections[$this->conf] = $pdo;
				$this->db= $pdo;
			} catch(PDOException $e) {
				if(Conf::$debug >= 1){
					die ($e->getMessage());
				}else {
					die ('Impossible de se connecter à la base de données');
				}
			}
		}
		else {
			$this->db = Model::$connections[$this->conf];
			return true;
		}		
	}

	public function find($req=array()){
		if (isset($req['fields'])){

			$this->requete->fields($req['fields']);
		}else{
			$this->requete->fields();
		}

		if (isset($req['conditions'])){
			foreach ($req['conditions'] as $k=>$v) {
				$this->requete->where($k, $v);	
			}			
		}

		if(isset($req['limit'])){
			$this->requete->limit($req['limit']);
		}

		/*
		if(isset($req['limit'])){
			$sql .= ' LIMIT '.$req['limit'];
		}*/
		$pre = $this->db->prepare($this->requete->select());

		$pre->execute();
		return $pre->fetchAll(PDO::FETCH_OBJ);
	}

	public function findFirst($req){
		return current($this->find($req));

	}

	public function findCount($req){
		$res=$this->findFirst(array(
			'fields' => 'COUNT('.$this->table.'.'.$this->primaryKey.') as count',
			'conditions' => $req['conditions']));
		return $res->count;
	}

	public function lastEntryId(){
		return $this->db->lastInsertId();
	}

	public function delete($id){
		//$sql = 'DELETE FROM '.$this->table.' WHERE '.$this->primaryKey.'='.$id.'';
		$sql=$this->requete->delete($id);
		return $this->db->query($this->requete->delete($id));

	}

	public function save($data){
		//initialisation des variables
		$this->errors=array();
		$key=$this->primaryKey;

		//demande de validation des données
		if ($this->validates($data)===true){
			$data = $this->cleaning($data,"pwd2");

			//enregistrement des données
			if(isset($data->$key) && !empty ($data->$key)){
				$sql = $this->update($data);
			}else{
				$sql = $this->create($data);
			}
			$pre = $this->db->prepare($sql);
			return $pre->execute($this->valeurs);
		}else{
			return $this->errors;
		}
	}

	public function create($data){
		foreach($data as $k=>$v){
			$fields[] = "$k=:$k";
			$this->valeurs[":$k"] = $v;
		}
		return $this->requete->add($fields);
	}

	public function update($data){
		$data = $this->cleaning($data,'created');
		foreach($data as $k=>$v){
			$fields[] = "$k=:$k";
			$this->valeurs[":$k"] = $v;
		}		
		return $this->requete->update($fields,$data->id);
	}

	public function cleaning($data,$var){
		if (isset($data->$var)){
			unset($data->$var);
		}
		return $data;
	}

	/**
	*
	*/
	public function validates($data){
		foreach ($this->dataRule as $k=>$v){
			if (!isset($data->$k)){
				$this->errors[$k]= "Le champ ".$k." n'existe pas alors qu'une règle lui a été définie";
			}else{
				switch ($v['rule']) {
					case 'notEmpty' :
						if (empty($data->$k)){
							$this->errors[$k]=$v['message'];		
						}
						break;

					case 'slug' :
						if (!preg_match('/^([[:alnum:]\-]+)$/', $data->$k)){
							$this->errors[$k]=$v['message'];
						}
						break;

					case 'cPostal' :
						if (isset($data->pays)){
							switch ($data->pays) {
								case 'France' :
									if (!preg_match('/^((0[1-9])|([1-8][0-9])|(9[0-8])|(2A)|(2B))[0-9]{3}$/', $data->$k)){
										$this->errors[$k]=$v['message'];
									}
									break;
								case 'United Kingdom' :
									if (!preg_match('/^((GIR 0AA)|((([^QVX][0-9][0-9]?)|(([^QVX][^IJZ][0-9][0-9]?)|(([^QVX][0-9][A-HJKSTUW])|([^QVX][^IJZ][0-9][ABEHMNPRVWXY])))) [0-9][^CIKMOV]{2}))$/', $data->$k)){
										$this->errors[$k]=$v['message'];
									}
							}	
						}
						break;

					case 'mail' :
						if (!preg_match('/^[[:alnum:]]([-_.]?[[:alnum:]])+_?@[[:alnum:]]([-.]?[[:alnum:]])+\.[[:alpha:]]{2,6}$/', $data->$k)) {
							$this->errors[$k]=$v['message'];
						}
						break;

					case 'password' :
						$k2= $k.'2';
						if (strlen($data->$k)<8){
							$this->errors[$k]=$v['message']['inf'];
						}
						if ($data->$k<>$data->$k2) {
							$this->errors[$k2]=$v['message']['idem'];
						}
						break;

					case 'entier' :
						if(!StringIsInt($data->$k)){
							$this->errors[$k]=$v['message'];
						}
						break;

					default :
						$this->errors[$k]="La règle d'enregistrement n'est pas définie pour le champ ".$k;	
				} 
			}

		}
		if (!empty($this->errors)){
			return $this->errors;
		}
		return true;
	}

	public function setCustomDataRule($dataRule){
		$this->dataRule=$dataRule;
	}
}
?>