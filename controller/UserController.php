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
		$lastPage=Session::read('lastPage');
		if ($lastPage=='inscription'){
			$lastPage='accueil';
		}

		if($this->request->data){
			$this->User->dataRule['pwd'] = array ('rule' => 'password',
											'message'=> array(
												'inf' => "Votre mot de passe doit comporter au moins 8 caractères pour être valide",
												'idem' => "Vous avez fait une erreur de frappe en indiquant votre mot de passe, les deux champs doivent être identiques"));
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
				Session::setInfos ('Votre inscription a bien été pris en compte, vous pouvez désormais vous connecter sur le site avec vos identifiants', 'success');
				$id=$this->User->lastEntryId();
				$this->render->assignVar('screen','tpl',array('file'=> './success.tpl'));
			}else{
				foreach ($result as $k=>$v){
					Session::setInfos ($v, 'info');					
				}
				Session::setInfos ('Une erreur est survenue lors de votre inscription, merci de réessayer', 'error');
			}
		}else{
			$user = new stdClass();
			$user->created= date('Y-m-d H:i:s');	
		}
		$this->render->assignVar('screen','tpl',array('user'=> $user));
		$this->render->assignVar('screen','tpl',array('lastPage'=> $lastPage));
	}

	public function view(){
		$user=Session::getUser();
		if (!empty($user)){
			$user=$this->User->findFirst(array(	'fields'=>array('id','nom','prenom','adresse','cp','ville','pays','email','created'),
												'conditions'=> array('id'=>$user->id)));
			$this->render->assignVar('screen','tpl', array('user' => $user));			
		}else{
			$this->redirect('accueil');
		}
	}

	public function edit(){
		$user=$this->User->findFirst(array(	'fields'=>array('id','nom','prenom','adresse','cp','ville','pays','email','created'),
												'conditions'=> array('id'=>Session::getUser()->id)));
		if($this->request->data){
			$user=$this->request->data;
			if (isset($user->pwd) && !empty($user->pwd)){
				$this->User->dataRule['pwd'] = array ('rule' => 'password',
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
				Session::setInfos ('Vos informations ont bien été modifiées', 'success');
			}else{
				foreach ($result as $k=>$v){
					Session::setInfos ($v, 'info');
				}
				Session::setInfos ('Erreur : Vos informations n\'ont pu être modifié', 'error');
			}
		}
		$this->render->assignVar('screen','tpl', array('user'=>$user));				
	}

	/**
	* Fonction permettant l'affichage des actualités en vue de leur gestion
	**/
	function admin_index() {
		$users = $this->User->find(array('fields'=>array('id','nom','prenom','cp','ville','email','created')));
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
			$this->User->dataRule['pwd'] = array ('rule' => 'password',
											'message'=> array(
												'inf' => "Votre mot de passe doit comporter au moins 8 caractères pour être valide",
												'idem' => "Vous avez fait une erreur de frappe en indiquant votre mot de passe, les deux champs doivent être identiques"));
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
				$this->User->dataRule['pwd'] = array ('rule' => 'password',
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
			$user= $this->User->findFirst(array('fields'=>array('id as id','nom','prenom','adresse','cp','ville','pays','email','created'),
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
	public function admin_delete($id=null){
		if ($id){
			$user=$this->User->findFirst(array('fields'=>array('nom','prenom'),
													'conditions'=>array('id'=>$id)));
			if($user){
				if ($this->User->delete($id)){
					Session::setInfos('L\'utilisateur "'.$user->prenom.' '.$user->nom.'" a bien été supprimée de la base de donnée', 'success');			
				}else{
					Session::setInfos('Erreur : L\'utilisateur "'.$user->prenom.' '.$user->nom.'" n\'a pas été supprimée', 'error');
				}
			}	
		}
		$this->redirect('admin/user/index');
	}

	/**
	* Login
	*
	**/
	public function login(){
		if ($this->request->data && !empty($this->request->data)){
			$data =$this->request->data;
			if($data->email && $data->pwd && !empty($data->email) && !empty($data->pwd)){
				$data->pwd =sha1($data->pwd);
				$user = $this->User->findFirst(array('conditions'=>array('email'=>$data->email,
																		'pwd'=>$data->pwd),
													'fields'=>array('id','prenom','nom','grpuser')));
				if(!empty($user)){
					if ($user->grpuser>=100){
						Session::write('isAdmin', true);
					}else{
						Session::write('isAdmin', false);
					}
					unset($user->grpuser);
					Session::setUser($user);				
				}else{
					Session::setUserInfos('Ces identifiants ne sont pas correct !');
					Session::setUser('email', $data->email);
				}				
			}else{
				Session::setUserInfos('Les identifiants ne sont pas renseignés');
			}
		}
		$this->redirect(Session::read('lastPage'));
	}

	/**
	* Logout
	*
	**/
	public function logout(){
		

		if(Session::destruct('user') && Session::destruct('isAdmin')){
			Session::setUserInfos('Vous êtes déconnecté du site');
		}else{
			Session::setUserInfos('Un problème est aparu, merci de réessayer');
		}		
		$this->redirect(Session::read('lastPage'));
	}
}

?>