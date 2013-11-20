<?php 
/**
* 
*/
class Model {

	static $connections = array();
	
	public $conf = 'default';
	public $table = false;
	public $db;
	public $primaryKey = 'id';


	public $dataRule = array();
	public $errors = array();

	function __construct(){
		// J'initialise des variables
		if($this->table === false){
			$this->table = strtolower(get_class($this)).'s';			
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

	public function find($req=null){

		$sql = 'SELECT ';
		// sélection des champs
		if (isset($req['fields'])){
			if(is_array($req['fields'])){
				$sql .= implode(', ',$req['fields']);
			}
			else{
				$sql .= $req['fields'];
			}
		}
		else {
			$sql .='*';
		}
		$sql .=' FROM '.$this->table.' as '.get_class($this).'';

		// Construction de la condition
		if (isset($req['conditions'])){
			$sql .= ' WHERE ';
			if (!is_array($req['conditions'])) {
				$sql .= $req['conditions'];
			}
			else {
				$cond = array();
				foreach ($req['conditions'] as $k => $v) {
					if (!is_numeric($v)){
						$v = '"'.mysql_real_escape_string($v).'"';	
					}
					$cond[]= "$k = $v";
				}
				$sql .= implode(' AND ',$cond);
			}
		}

		if(isset($req['limit'])){
			$sql .= ' LIMIT '.$req['limit'];
		}
		$pre = $this->db->prepare($sql);
		$pre->execute();
		return $pre->fetchAll(PDO::FETCH_OBJ);
	}

	public function findFirst($req){
		return current($this->find($req));

	}

	public function findCount($conditions){
		$res=$this->findFirst(array(
			'fields' => 'COUNT('.$this->primaryKey.') as count',
			'conditions' => $conditions['conditions']));
		return $res->count;
	}

	public function lastEntryId(){
		return $this->db->lastInsertId();
	}

	public function delete($id){
		$sql = 'DELETE FROM '.$this->table.' WHERE '.$this->primaryKey.'='.$id.'';
		return $this->db->query($sql);

	}

	public function save($data){
		//initialisation des variables
		$key = $this->primaryKey;
		$fields= array();
		$this->errors=array();

		//demande de validation des données
		if ($this->validates($data)){
			//Suppression des champs indésirables
			if (isset($data->pwd2)){
				unset ($data->pwd2);
			}

			//enregistrement des données
			if(isset($data->$key) && !empty ($data->$key)){
				foreach($data as $k=>$v){
					if ($k<>"created"){
						$fields[] = "$k=:$k";
						$d[":$k"] = $v;
					}
				}
				$sql= 'UPDATE '.$this->table.' SET '.implode(',',$fields).' WHERE '.$key.'=:'.$key;
			}else{
				foreach($data as $k=>$v){
					$fields[] = "$k=:$k";
					$d[":$k"] = $v;
				}
				$sql= 'INSERT INTO '.$this->table.' SET '.implode(',',$fields);
			}
			debug($sql,'sql');
			debug($d,'valeurs');
			die();
			$pre = $this->db->prepare($sql);
			return $pre->execute($d);
		}
		else {
			return $this->errors;
		}
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
					default :
						$this->errors[$k]="La règle d'enregistrement n'est pas définie pour le champ ".$k;	
				} 
			}

		}
		if (empty($this->errors)){
			return true;
		}
		return false;
	}
}
?>