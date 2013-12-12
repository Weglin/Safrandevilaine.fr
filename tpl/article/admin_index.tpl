<header><h1>Gestion des Articles</h1></header>
{$infos|default:null}
<a href="{Router::url('admin/article/edit')}"><button>Ajouter un article</button></a>
<hr />
<table>
	<tr><th>Type</th>
		<th>Nom</th>
		<th>Prix TTC</th>
		<th>Créé le</th>
		<th colspan=2>Actions</th>
	</tr>
{foreach from=$articles item=element}
	<tr>
		<td>{$element->id_typeArt}</td>
		<td>{$element->nom}</td>
		<td>{$element->TTC}</td>
		<td>{$element->created}</td>
		<td><a href="{Router::url('admin/article/edit/'|cat:$element->id)}"><button>Editer</button></a></td>
		<td><a  href="{Router::url('admin/article/delete/'|cat:$element->id)}" onclick="return confirm ('Êtes vous sûr de vouloir supprimer cet article ?\n\nCette opération est définitive et peut provoquer des erreurs dans l\'application.\nSupprimer cet article seulement si vous savez exactement ce que vous faite !');"><button>Supprimer</button></a></td>	
	</tr>
{/foreach}
</table>