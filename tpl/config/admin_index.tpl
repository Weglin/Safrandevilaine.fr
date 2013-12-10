<header><h1>Options de configuration</h1></header>
{$infos|default:null}
<hr />
<h2>Options générales</h2>
<div class="paramBox">
	<form action="{Router::url('admin/config/index')}" method="post">
		<fieldset>
			{Form::input('name', '','general','hidden')}
			{Form::input('shortURL', 'Raccourci URL de l\'administration :', $generalShortURL)}
		</fieldset>
		<input type="submit" value="Appliquer">
		<strong>Attention : </strong>Vous devrez redémarrer l'interface de gestion avec ce nouveau paramètre après la mise à jour.
	</form>
</div>
<hr />
<h2>Gestion du Menu </h2>
Accueil				▼ 	x<br />
Nos produits		▲▼	x<br />
Notre safranière	▲	x<br />
-Combo page-      Ajouter<br />
<br />

<hr />
<div class="paramBox">
	<h2>Paramètres E-mail</h2>
	<div>
		<a style="text-decoration: none;" href="{Router::url('admin/config/smtp')}">
			<button style="float:right">Paramètres d'envoie SMTP</button>
		</a>
	</div>
	<form action="{Router::url('admin/config/index')}" method="post">
		<fieldset>
			{Form::input('name', '','email','hidden')}
			{Form::input('contact', 'E-mail de contact :', $emailContact)}
		</fieldset>
		<input type="submit" value="Appliquer">
	</form>
</div>