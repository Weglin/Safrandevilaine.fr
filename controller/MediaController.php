<?php
class MediaController extends Controller{
	public $rep_defaut=0;
	public $dossiers= null;
	
	public function __construct($request){
		parent::__construct($request);
		$this->loadModel('Media');
		$this->loadModel('Dossier');
	}

	function admin_Jindex($type="img"){
		//initialisation variables local
		$images=null;
		$dirNow='defaut';

		//Assignation des valeurs du select "dossier"
		$this->dossiers[$dirNow]='TOUS';
		$this->dir('medias');
		$this->render->assignVar('screen','tpl',array('directories'=> $this->dossiers));

		if($this->request->data && $this->request->data->replist!='defaut'){
			$dirNow=$this->request->data->replist;
			$images=$this->Media->find(array(	'fields'=>array('media.id AS id','media.name AS titre','dos.name AS dir','media.file AS fileName'),
												'conditions'=>array('dos.type'=> 'medias',
																	'id_dossier'=> $dirNow)));
		}else{
			$images=$this->Media->find(array(	'fields'=>array('media.id AS id','media.name AS titre','dos.name AS dir','media.file AS fileName'),
												'conditions'=>array('dos.type'=>'medias')));
		}
		$this->render->assignVar('screen','tpl',array('dirNow'=> $dirNow,'images'=> $images));
	}

	function admin_Jadd($type='img'){
		$this->dir('medias');
		$dirNow=0;
		// Si des médias sont ajoutés
		if ($this->request->data && !empty($_FILES['file']['name'])){
			if (empty($this->request->data->rep)&& !is_numeric($this->request->data->replist)){
				$this->setInfos('Aucun répertoire n\'a été indiqué pour le stockage de votre fichier, merci d\en indiquer un ou de le créer', 'error');
			}else{
				// simplifions quelques variables
				$fileName=$_FILES['file']['name'];
				
				//si le fichier n'a pas de titre
				$name = empty($this->request->data->name) ? $fileName : $this->request->data->name;
				
				// sélection du répertoire de destination
				if (empty($this->request->data->rep)){
					// le champ txt est vide, on prend le répertoire indiqué dans la liste 
					$id_dossier=$this->request->data->replist;
					$rep= $this->dossiers[$id_dossier];				
				}else{
					$rep=strtolower($this->request->data->rep);
					// on test si le champ txt se réfère à un répertoire préexistant
					$_dossier=$this->repExist($rep);
					if ($_dossier){
						// si le répertoire existe déjà
						$id_dossier=$_dossier->id;
						$rep= $this->dossiers[$id_dossier];
					}else{
						//le répertoire n'existe pas, enregistrement dans la BDD
						$this->Dossier->save(array("name"=>$rep,"type"=>'medias'));
						$id_dossier=$this->Dossier->lastEntryId();
					}					
				}
				$dirNow=$id_dossier;

				// construction du chemin des médias
				$dir=WEBROOT.DS.'medias'.DS;


				//traitement du fichier (upload et enregistrement en BDD)
				if(strpos($_FILES['file']['type'], 'image') !== false){
					
					//construction du chemin du média
					$dir.=$type.DS.$rep;
					$dirFileName=$dir.DS.$fileName;

					if (!file_exists($dir)){
						mkdir($dir,0777);
					}
					if (!file_exists($dirFileName)) {
						move_uploaded_file($_FILES['file']['tmp_name'], $dirFileName);
						$this->Media->save(array(
							'name'=> $name,
							'id_dossier'=>$id_dossier,
							'file'=> $fileName,
							'type'=>$type));
						$this->setInfos ('Le fichier <b>" '.$fileName.' "</b> a bien été ajouté au répertoire <b>" '.$rep.' "</b>', 'success');
					}else{
						$this->setInfos ('Erreur : Le fichier <b>" '.$fileName.' "</b> existe déjà', 'error');
					}				
				}else{
					$this->setInfos ('Erreur : Le fichier <b>" '.$fileName.' "</b> n\'est pas une image', 'error');
				}
			}
		}
		$this->dir('medias');
		$this->render->assignVar('screen','tpl',array('dirNow'=> $dirNow,'directories'=> $this->dossiers));
	}

	public function admin_index(){
		$this->admin_Jindex();
	}

	public function admin_add(){
		$this->admin_Jadd();
	}

	/**
	*	Suppression d'une image de la base de médias
	*
	**/
	public function admin_delete($id,$type='img'){
		$media=$this->Media->findFirst(array(	'fields'=>array('media.id AS id, media.name AS name, media.id_dossier AS id_rep, dos.name AS rep, media.file as filename'),
												'conditions'=>array('media.id'=>$id)));
		if (!empty($media)){
			/*On définie le répertoire de travail*/
			$dir=WEBROOT.DS.'medias'.DS.$type.DS.$media->rep;

			/*on efface le fichier dans le répertoire*/
			if (unlink($dir.DS.$media->filename)){
				/*on efface le fichier dans la BDD*/
				if($this->Media->delete($media->id)){
					/*on vérifie que le répertoire contient au moins un fichier*/
					if($this->Media->findCount(array('conditions'=>array('id_dossier'=>$media->id_rep)))==0){
						/*on ferme le répertoire*/
						closedir($dir);
						/*on efface le répertoire*/
						if (rmdir($dir)){
							if($this->Dossier->delete($media->id_rep)){
								$this->setInfos("Info : Le répertoire <b>\"".$media->rep."\"</b> étant vide, il a été effacé",'infos');
							}else{
								$this->setInfos("Erreur : Le répertoire <b>\"".$media->rep."\"</b> aurait du être effacé de la BDD, mais une erreur est survenu, merci d'en avertir l'administrateur", 'error');
							}	
						}else{
							$this->setInfos("Le répertoire <b>\"".$media->rep."\"</b> aurait du être effacé, mais une erreur est survenu, merci d'en avertir l'administrateur", 'error');
						}						
					}				
					$this->setInfos('Le media <b>"'.$media->name.'"</b> ('.$media->rep.'/'.$media->filename.') a bien été supprimé de la BDD et effacé du serveur','success');
				}else{
					$this->setInfos("Erreur : Le fichier n'a pas pu être effacé de la BDD, merci de contacter l'administrateur",'error');
				}
			}else{
				$this->setInfos("Erreur : Le média n'a pas pu être effacé sur le serveur, merci de contacter l'administrateur", 'error');
			}
		}else{
			$this->setInfos("Erreur : Le média n'a pas pu être trouvé pour sa suppression, merci de contacter l'administrateur", 'error');
		}		
		$this->redirect('admin/media/index');
	}

	/**
	*	Recherche des dossiers associés au type de média
	*
	**/

	public function dir($type){
		$directories=$this->Dossier->find(array(
										'fields' => array('id', 'name'),
										'conditions' => array('type'=>$type)));
		if (!empty($directories)){
			foreach($directories as $k){
				$this->dossiers[$k->id]=$k->name;
			}
		}
	}

	public function repExist($rep){
		//recherche si le répertoire demandé par le champ texte existe déjà dans les répertoires référencés
		return $this->Dossier->findFirst(array('fields'=> array('id'),
									'conditions'=> array('name'=>$rep)));
	}
}
?>