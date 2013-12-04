<?php
class UserController extends Controller{

	public function __construct($request){
		parent::__construct($request);
		$this->loadModel('User');

		$this->render->assignVar('screen','tpl',array('combo_pays'=> array('France'=>'France',"United Kingdom"=>"United Kingdom",'Autre'=>'Autre')));
	}

	/**
	*	Permet la création d'un nouvel utilisateur par un invité
	**/
	public function add(){
		$user = new stdClass();
		$user->created= date('Y-m-d H:i:s');
		$this->render->assignVar('screen','tpl',array('user'=> $user));
	}


	/**
	* Fonction permettant l'affichage des actualités en vue de leur gestion
	**/
	function admin_index() {
		$users = $this->User->find(array('fields'=>array('user.id as id','nom','prenom','cp','ville','email','created')));
		if (empty($users)){
			Session::setInfos ('Aucun utilisateur en base de données', 'info');
		}
		$this->render->assignVar('screen','tpl',array('users'=> $users));
	}

	/**
	*	Permet d'ajouter un nouvel utilisateur
	**/
	public function admin_add(){
		if($this->request->data){
			$this->dataRule['pwd'] = array ('rule' => 'password',
											'message'=> array(
												'inf' => "Votre mot de passe doit comporter au moins 8 caractères pour être valide",
												'idem' => "Vous avez fait une erreur de frappe en indiquant votre mot de passe, les deux champs doivent être identiques"));

			debug($this->dataRule);
			$user=$this->request->data;

			//formatage des données
			$user->nom=strtoupper($user->nom);
			$user->prenom=ucfirst(strtolower($user->prenom));
			$user->adresse=ucfirst($user->adresse);
			$user->cp=strtoupper($user->cp);
			$user->ville=strtoupper($user->ville);
			$user->email=strtolower($user->email);
			
			//demande de sauvegarde des nouvelles données
			$result= $this->User->save($user);

			//Gestion des messages de validation /invalidation
			if ($result===true){
				Session::setInfos ('L\'utilisateur "'.$user->prenom.' '.$user->nom.'" a bien été créé', 'success');
				$id=$this->User->lastEntryId();
				die();
				$this->redirect('admin/user/edit');
			}else{
				foreach ($result as $k=>$v){
					Session::setInfos ($v, 'info');					
				}
				Session::setInfos ('Erreur : L\'utilisateur "'.$user->prenom.' '.$user->nom.'" n\'a pas été créé', 'error');
			}
		}else{
			$user = new stdClass();
			$user->created= date('Y-m-d H:i:s');	
		}
		$this->render->assignVar('screen','tpl',array('user'=> $user));
	}

	/**
	*	Permet d'éditer un utilisateur
	**/
	public function admin_edit($id=null){
		if($this->request->data){
			$user=$this->request->data;

			if (isset($user->pwd) && !empty($user->pwd)){
				$this->dataRule['pwd'] = array ('rule' => 'password',
												'message'=> array(
															'inf' => "Votre mot de passe doit comporter au moins 8 caractères pour être valide",
															'idem' => "Vous avez fait une erreur de frappe en indiquant votre mot de passe, les deux champs doivent être identiques"));	
			}

			//formatage des données
			$user->nom=strtoupper($user->nom);
			$user->prenom=ucfirst(strtolower($user->prenom));
			$user->adresse=ucfirst($user->adresse);
			$user->cp=strtoupper($user->cp);
			$user->ville=strtoupper($user->ville);
			$user->email=strtolower($user->email);
			
			//demande de sauvegarde des nouvelles données
			$result= $this->User->save($user);

			//Gestion des messages de validation /invalidation
			if ($result===true){
				if ($id){
					Session::setInfos ('L\'utilisateur "'.$user->prenom.' '.$user->nom.'" a bien été modifié', 'success');
				}else{
					Session::setInfos ('L\'utilisateur "'.$user->prenom.' '.$user->nom.'" a bien été créé', 'success');
					$id=$this->User->lastEntryId();
				}
				
			} else {
				foreach ($result as $k=>$v){
					Session::setInfos ($v, 'info');
				}
				if ($id){
					Session::setInfos ('Erreur : L\'utilisateur "'.$user->prenom.' '.$user->nom.'" n\'a pas été modifié', 'error');
				}else{
					Session::setInfos ('Erreur : L\'utilisateur "'.$user->prenom.' '.$user->nom.'" n\'a pas été créé', 'error');
				}
			}
		}

		//Remplissage auto des champs si des données sont disponibles (BDD ou data page précédente)
		if ($id){
			$user= $this->User->findFirst(array('fields'=>array('user.id as id','nom','prenom','adresse','cp','ville','pays','email','created'),
												'conditions'=> array('user.id'=>$id)));
		}else{
			$user=$this->request->data;
			$user->id=null;
		}
		$this->render->assignVar('screen','tpl',array('user'=> $user));
	}

	/**
	*	Permet la suppression d'un utilisateur
	**/
	public function admin_delete($id, $userName){
		if ($this->User->delete($id)){
			Session::setInfos('L\'utilisateur "'.$userName.'" a bien été supprimée de la base de donnée', 'success');			
		}
		else {
			Session::setInfos('Erreur : L\'utilisateur "'.$userName.'" n\'a pas été supprimée', 'error');
		}
		$this->redirect('admin/user/index');
	}

	/**
	* Login
	*
	**/
	public function login(){
		if($this->request->data){
			$data = $this->request->data;
			$data->pwd =sha1($data->pwd);
			$user = $this->User->findFirst(array('conditions'=>array('email'=>$data->email,
																	'pwd'=>$data->pwd),
												'fields'=>array('prenom','nom','grpuser')));
			if(!empty($user)){
				if ($user->grpuser>=100){
					Session::write('isAdmin', 1);
				}else{
					Session::write('isAdmin', 0);
				}
				unset($user->grpuser);
				Session::write('user',$user);				
			}else{
				Session::setInfos('Ces identifiants ne sont pas correct !', 'error');
			}
			$this->request->data->password='';
		}
		$this->redirect(Session::read('lastPage'));
	}

	/**
	* Logout
	*
	**/
	public function logout(){
		if(Session::destruct('user') && Session::destruct('isAdmin')){
			Session::setInfos('Vous êtes déconnecté du site', 'succes');
		}else{
			Session::setInfos('Un problème est aparu lors de la fermeture de votre session, merci de réessayer', 'error');
		}
		$this->redirect(Session::read('lastPage'));
	}
}

?>