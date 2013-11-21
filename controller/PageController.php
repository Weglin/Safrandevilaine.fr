<?php
class PageController extends Controller{

	public function __construct($request){
		parent::__construct($request);
		$this->loadModel('Page');
	}

	/** 
	*	fonction permettant de renvoyer la page demandée
	**/
	public function view($id, $slug=null){
		if (isset($id) && isset($slug)) {
			if (is_numeric($id)){
				if($id>0){
					$conditions = array('conditions'=>array('id'=>$id,
								 'slug'=>$slug,
								 'online'=>1								 
								 ));
					$page = $this->Page->findFirst($conditions);
					if (empty($page)){
 						$this->e404('Erreur : <em>'.$slug.'-'.$id.'</em> est une page introuvable');
 					}
 					$this->render->assignVar('screen','tpl',array('page'=> $page));	 				
				}
			}
		}
 		else $this->e404('Erreur : Page introuvable ');
	}

	/**
	* Fonction permettant l'affichage des pages statiques en vue de leur gestion
	**/
	public function admin_index() {
		$pages = $this->Page->find();
		if (empty($pages)){
			$this->setInfos('Aucune page en base de données','info');
		}
		$this->infos();
		$this->render->assignVar('screen','tpl',array('pages'=> $pages));
	}

	/**
	* Permet de voir la page traité
	**/
	public function admin_view($id=NULL){
		if (isset($id)) {
			$conditions = is_numeric($id) ? array('conditions'=>array('id'=>$id)) : array('conditions'=>array('slug'=>$id));
			$page = $this->Page->findFirst($conditions);
			if (empty($page)){
 				$this->e404('Erreur : Page <em>'.$id.'</em> introuvable');
 			}
 			$this->render->assignVar('screen','tpl',array('page'=> $page));
		}
 		else $this->e404('Erreur : Page introuvable (id null)');

	}

	public function admin_delete($id){
		if ($this->Page->delete($id)){
			$this->setInfos('la page '.$id.' à bien été supprimée de la base de donnée', 'success');			
		}
		else {
			$this->setInfos('Erreur : La page '.$id.' n\'a pas été supprimée', 'error');
		}
		$this->redirect('admin/page/index');

	}

	public function admin_edit($id=null){
		if($this->request->data){
			//demande de sauvegarde des nouvelles données
			$result = $this->Page->save($this->request->data);
			if ($result===true){
				if ($id){
					$this->setInfos ('La page "'.$this->request->data->name.'" a bien été modifiée', 'success');
				}else{
					$this->setInfos ('La page "'.$this->request->data->name.'" a bien été crée', 'success');
					$id=$this->Page->lastEntryId();
				}
				
			}else{
				foreach ($result as $k=>$v){
					$this->setInfos ($v, 'info');
				}
				if ($id){
					$this->setInfos ('Erreur : la page "'.$this->request->data->name.'" n\'a pas été modifiée', 'error');
				}else{
					$this->setInfos ('Erreur : la page "'.$this->request->data->name.'" n\'a pas pu être créée', 'error');
				}				
			}
		}
		
		//Remplissage auto des champs si des données sont disponibles (BDD ou data page précédente)
		if ($id){
			$page =$this->Page->findFirst(array('conditions'=> array('id'=>$id)));
		} else {
			$page=$this->request->data;
			$page->id=null;
		}
		
		$this->infos();
		$this->render->addPlugin('screen','tinyMCE');
		$this->render->assignVar('screen','tpl',array('page'=> $page));
	}

	public function admin_add(){
		$page = new stdClass();
		$page->created= date('Y-m-d H:i:s');
		$this->render->addPlugin('screen','tinyMCE');
		$this->render->assignVar('screen','tpl',array('page'=> $page));
	}

}

?>