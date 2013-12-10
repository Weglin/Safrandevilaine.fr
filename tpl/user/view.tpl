<h1>Mon Compte</h1>
<div>
Bienvenue sur la page de gestion de votre compte.<br />Dans cet espace, vous pouvez modifier les informations vous concernant et consulter vos commandes en cours.
</div>
<hr />
<div>
<table>
	<tr>
		<td>Nom :</td>
		<td>{$user->nom}</td>
	</tr>
	<tr>
		<td>Prenom :</td>
		<td>{$user->prenom}</td>
	</tr>
	<tr>
		<td>Adresse :</td>
		<td>{$user->adresse}</td>
	</tr>
	<tr>
		<td>Code Postal :</td>
		<td>{$user->cp}</td>
	</tr>
	<tr>
		<td>Ville :</td>
		<td>{$user->ville}</td>
	</tr>
		<tr>
		<td>Pays :</td>
		<td>{$user->pays}</td>
	</tr>
	<tr>
		<td>E-Mail :</td>
		<td>{$user->email}</td>
	</tr>
</table>
<a href="{Router::url('myaccount')}"><button>Modifier ces informations</button></a>
</div>
<hr />
<div>
Afficher les adresses de livraison<br />
Lien pour modifier/supprimer les adresses de livraison
</div>
<hr />
<div>
Afficher les commandes en cours
</div>
<hr />
<div>
Afficher les commandes passées
</div>