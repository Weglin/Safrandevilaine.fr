<header><h1>Gestion des actualités</h1></header>
{$infos|default:null}
<a href="{Router::url('admin/actualite/add')}"><button>Nouvelle actualité</button></a>
<hr />
<table>
	<tr><th>Titre</th>
		<th>Date de création</th>
		<th>URL</th>
		<th>Créé par</th>
		<th>Publié</th>
		<th colspan=2>Actions</th>
	</tr>
{foreach from=$actualites item=element}
	<tr>
		<td>{$element->name}</td>
		<td>{$element->created}</td>
		<td>{$element->slug}</td>
		<td>{$element->compte_id}</td>
		<td>{$element->online}</td>
		<td><a href="{Router::url('admin/actualite/edit/'|cat:$element->id)}"><button>Editer</button></a></td>
		<td><a onclick="return confirm('Êtes vous sûr de vouloir supprimer cette actualité ?\n\n(Vous pouver la mettre hors-ligne avant sa suppression définitive)');" href="{Router::url('admin/actualite/delete/'|cat:$element->id)}"><button>Supprimer</button></a></td>	
	</tr>
{/foreach}
</table>