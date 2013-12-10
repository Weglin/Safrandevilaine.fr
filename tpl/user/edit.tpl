<header><h1>Mes informations personnelles</h1></header>
{$infos|default:null}
<hr />
<form action="{Router::url('myaccount')}" method="post">
	{Form::input('id', null, $user->id, 'hidden')}
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
		{Form::input('pwd', 'Mot de passe :', null, 'password')}
		{Form::input('pwd2', 'Répéter le mot de passe :', null, 'password')}
	</fieldset>
	<input type="submit" value="Valider"><a href="{Router::url('account')}"><button type="button">Retour</button></a>
</form>