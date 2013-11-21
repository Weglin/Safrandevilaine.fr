<?php
class CommerceController extends Controller{

	public function __construct($request){
		parent::__construct($request);
		$this->loadModel('Commerce');
	}

	/** 
	*	Afficher les commerçants des points de vente ou des points de dégustation
	**/
	public function index($slug=null){
		$titre='';
		if ($slug=='degustation' || $slug='vente') {
			$conditions = array('conditions'=>array($slug=>'1',
							'online'=>1								 
							));
			$commerces = $this->Commerce->find($conditions);
			if (empty($commerces)){
				$slug= 'point de '.$slug;
				$this->e404('Aucun <em>'.$slug.'</em> n\'est référencé actuellement.');
 			}
 			if ($slug=='degustation'){$titre="Sites de dégustation";}else{$titre="Points de vente";}
 			$this->render->assignVar('screen','tpl',array('titre'=> $titre,'commerces'=> $commerces));
		}
 		else $this->e404('Erreur : Page introuvable ');
	}

	/**
	* Fonction permettant l'affichage des commerces en vue de leur gestion
	**/
	public function admin_index() {
		$commerces = $this->Commerce->find();
		if (empty($commerces)){
			$this->setInfos('Aucun commerce en base de données','info');
		}
		$this->infos();
		$this->render->assignVar('screen','tpl',array('commerces'=> $commerces));
	}

	/**
	*	Permet de prévisualiser un commerce avant sa publication
	**/
	public function admin_view($id=NULL){
		if (isset($id)) {
			$conditions = is_numeric($id) ? array('conditions'=>array('id'=>$id)) : array('conditions'=>array('slug'=>$id));
			$commerce = $this->Commerce->findFirst($conditions);
			if (empty($commerce)){
 				$this->e404('Erreur : Le commerce <em>'.$id.'</em> introuvable');
 			}
 			$this->render->assignVar('screen','tpl',array('commerce'=> $commerce));
		}
 		else $this->e404('Erreur : Commerce introuvable (id null)');

	}

	/**
	*	Permet d'ajouter un nouveau commerce
	**/
	public function admin_add(){
		$commerce = new stdClass();
		$commerce->created= date('Y-m-d H:i:s');
		$this->render->assignVar('screen','tpl',array('commerce'=> $commerce));
	}

	/**
	*	Permet d'éditer un commerce
	**/

	public function admin_edit($id=null){
		if($this->request->data){
			//demande de sauvegarde des nouvelles données
			$result = $this->Commerce->save($this->request->data);
			if ($result===true){
				if ($id){
					$this->setInfos ('Le commerce "'.$this->request->data->nom.'" a bien été modifié', 'success');
				}else{
					$this->setInfos ('Le commerce "'.$this->request->data->nom.'" a bien été créé', 'success');
					$id=$this->Commerce->lastEntryId();
				}
				
			} else {
				foreach ($result as $k=>$v){
					$this->setInfos ($v, 'info');
				}
				if ($id){
					$this->setInfos ('Erreur : Le commerce "'.$this->request->data->nom.'" n\'a pas été modifié', 'error');
				}else{
					$this->setInfos ('Erreur : Le commerce "'.$this->request->data->nom.'" n\'a pas été créé', 'error');
				}
			}
		}

		//Remplissage auto des champs si des données sont disponibles (BDD ou data page précédente)
		if ($id){
			$commerce= $this->Commerce->findFirst(array('conditions'=> array('id'=>$id)));
		} else {
			$commerce=$this->request->data;
			$commerce->id=null;
		}

		$this->infos();
		$this->render->assignVar('screen','tpl',array('commerce'=> $commerce));
	}

	/**
	*	Permet la suppression d'un commerce
	**/

	public function admin_delete($id,$slug){
		if ($this->Commerce->delete($id)){
			$this->setInfos('Le commerce "'.$slug.'" a bien été supprimée de la base de donnée', 'success');			
		}
		else {
			$this->setInfos('Erreur : Le commerce "'.$slug.'" n\'a pas été supprimée', 'error');
		}
		$this->redirect('admin/commerce/index');
	}
}

?>