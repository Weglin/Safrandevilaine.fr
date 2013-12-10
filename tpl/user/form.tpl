{$infos|default:null}
<hr />
<form action="{Router::url('user/add')}" method="post">
	<fieldset>
		{Form::input('created', '', $form->created, 'hidden')}
		<legend>Vos coordonées</legend>
		{Form::input('nom', 'Nom :', $form->nom|default:null)}
		{Form::input('prenom', 'Prénom :', $form->prenom|default:null)}
		{Form::input('adresse', 'Adresse :', $form->adresse|default:null, 'textarea')}
		{Form::input('cp', 'Code Postal :', $form->cp|default:null)}
		{Form::input('ville', 'Ville :', $form->ville|default:null)}
		{Form::input('pays', 'Pays :', $comboBox, 'select', $form->pays|default:null)}
		{Form::input('email', 'E-mail :', $form->email|default:null)}
	</fieldset>
	<fieldset>
		<legend>Sécurité</legend>
		{Form::input('pwd', 'Mot de passe :', null, 'password')}
		{Form::input('pwd2', 'Répéter le mot de passe :', null, 'password')}
	</fieldset>
<input type="submit" value="Valider"><a href="{Router::url($back)}"><button type="button">Retour</button></a>
</form>