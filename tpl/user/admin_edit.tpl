<header><h1>Édition de l'utilisateur {$user->prenom} {$user->nom}</h1></header>
{$infos|default:null}
<hr />
<form action="{Router::url('admin/user/edit/'|cat:$user->id)}" method="post">
	{Form::input('id', null, $user->id, 'hidden')}
	{Form::input('created', 'Date de création :', $user->created, 'dateTime', 'disabled')}
	<fieldset>
		<legend>Données de l'utilisateur</legend>
		{Form::input('nom', 'Nom :', $user->nom)}
		{Form::input('prenom', 'Prénom :', $user->prenom)}
		{Form::input('adresse', 'Adresse :', $user->adresse,'textarea')}
		{Form::input('cp', 'Code Postal :', $user->cp)}
		{Form::input('ville', 'Ville :', $user->ville)}
		{Form::input('pays', 'Pays :', $combo_pays, 'select', $user->pays)}
		{Form::input('email', 'E-mail :', $user->email)}
	</fieldset>
	<fieldset>
		<legend>Modifier le mot de passe</legend>
		{Form::input('pwd', 'Mot de passe :', '', 'password')}
		{Form::input('pwd', 'Répéter le mot de passe :', '', 'password')}
	</fieldset>
	<input type="submit" value="Valider"><a href="{Router::url('admin/user/index')}"><button type="button">Retour</button></a>
</form>


