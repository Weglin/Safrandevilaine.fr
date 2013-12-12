<?php
class ArticleController extends Controller{

	public function __construct($request){
		parent::__construct($request);
		$this->loadModel('Article');
	}

	public function index(){
		$articles=$this->Article->find(array(
							'fields'=>array('id','id_typeArt','nom','TTC','photo')));
		$this->render->assignVar('screen','tpl',array('articles'=> $articles));
	}

	public function view($id){

	}

	public function admin_index(){
		$articles=$this->Article->find(array(
							'fields'=>array('id','id_typeArt','nom','TTC','created')));
		$this->render->assignVar('screen','tpl',array('articles'=> $articles));
	}

	public function admin_add(){

	}

	public function admin_edit($id=null){
		if($id || $this->request->data){
			$titre='Édition de l\'article :';
			$created='disabled';
			if($this->request->data){
				$article=$this->request->data;

				//demande de sauvegarde des nouvelles données
				$result= $this->Article->save($article);

				//Gestion des messages de validation /invalidation
				if ($result===true){
					if ($id){
						Session::setInfos ('L\'article "'.$article->nom.'" a bien été modifié', 'success');
					}else{
						Session::setInfos ('L\'article "'.$article->nom.'" a bien été créé', 'success');
						$id=$this->Article->lastEntryId();
					}
					
				}else{
					foreach ($result as $k=>$v){
						Session::setInfos ($v, 'info');
					}
					if ($id){
						Session::setInfos ('Erreur : L\'article "'.$article->nom.'" n\'a pas été modifié', 'error');
					}else{
						Session::setInfos ('Erreur : L\'article "'.$article->nom.'" n\'a pas été créé', 'error');
					}
				}
			}
			//Remplissage auto des champs si des données sont disponibles (BDD ou data page précédente)
			if ($id){
				$article= $this->Article->findFirst(array('fields'=>array('id','id_typeArt','nom','TTC','photo','created'),
													'conditions'=> array('id'=>$id)));
			}else{
				$article=$this->request->data;
				$article->id=null;
			}			
		}else{
			$titre='Ajouter un article';

			$article=new stdClass();
			$article->id=null;
			$article->id_typeArt=null;
			$article->nom=null;
			$article->TTC=null;
			$article->photo=null;
			$article->created= date('Y-m-d H:i:s');	
		}
		$this->render->assignVar('screen','tpl',array('titre'=>$titre ,'article'=> $article));
	}

	public function admin_delete($id=null){
		if ($id){
			$article=$this->Article->findFirst(array('fields'=>array('id_typeArt','nom'),
													'conditions'=>array('id'=>$id)));
			if($article){
				if ($this->Article->delete($id)){
					Session::setInfos('L\'article "'.$article->id_typeArt.' '.$article->nom.'" a bien été supprimée de la base de donnée', 'success');			
				}
				else {
					Session::setInfos('Erreur : L\'article "'.$article->id_typeArt.' '.$article->nom.'" n\'a pas été supprimée', 'error');
				}
			}
		}
		$this->redirect('admin/article/index');
	}
}
?>