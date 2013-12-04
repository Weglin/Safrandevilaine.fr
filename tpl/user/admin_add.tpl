<header><h1>Création d'un utlisateur</h1></header>
{$infos|default:null}
<hr />
<form action="{Router::url('admin/user/add')}" method="post">
	<fieldset>
		{Form::input('created', 'Date de création :', $user->created, 'dateTime', 'disabled')}
		<legend>Données de l'utilisateur</legend>
		{Form::input('nom', 'Nom :', null)}
		{Form::input('prenom', 'Prénom :', null)}
		{Form::input('adresse', 'Adresse :', null, 'textarea')}
		{Form::input('cp', 'Code Postal :', null)}
		{Form::input('ville', 'Ville :', null)}
		{Form::input('pays', 'Pays :', $combo_pays, 'select')}
		{Form::input('email', 'E-mail :', null)}
	</fieldset>
	<fieldset>
		<legend>Sécurité</legend>
		{Form::input('pwd', 'Mot de passe :', null)}
		{Form::input('pwd2', 'Répéter le mot de passe :', null)}
	</fieldset>
<input type="submit" value="Valider"><a href="{Router::url('admin/user/index')}"><button type="button">Retour</button></a>
</form>
