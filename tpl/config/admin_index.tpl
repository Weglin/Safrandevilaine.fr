<header><h1>Administration du site</h1></header>
{$infos|default:null}
<hr />
<h2>Options générales</h2>
Raccourci URL de l'administration :<br />
<hr />
<h2>Gestion du Menu </h2>
Accueil				▼ 	x<br />
Nos produits		▲▼	x<br />
Notre safranière	▲	x<br />
-Combo page-      Ajouter<br />
<br />

<hr />
<h2>Nlk, llasdfdqs qdsd</h2><hr />
<h2>Pllflll qqqdttht</h2><hr />
<form action="{Router::url('admin/config/index')}" method="post">
		<fieldset>
		<legend>Paramètres mail</legend>
			{Form::input('name', '','email','hidden')}
			{Form::input('contact', 'E-mail de contact :', $emailContact)}
			<input type="submit" value="Appliquer">
		</fieldset>
	</form>
<a href="{Router::url('admin/config/SMTP')}"><button>Paramètres d'envoie SMTP</button></a>
<hr />