<header><h1>Gestion des utilisateurs</h1></header>
{$infos|default:null}
<a href="{Router::url('admin/user/add')}"><button>Nouvel utilisateur</button></a>
<hr />
<table>
	<tr><th>Nom</th>
		<th>Prénom</th>
		<th>CP</th>
		<th>Ville</th>
		<th>E-mail</th>
		<th>Créé le</th>
		<th colspan=2>Actions</th>
	</tr>
{foreach from=$users item=element}
	<tr>
		<td>{$element->nom}</td>
		<td>{$element->prenom}</td>
		<td>{$element->cp}</td>
		<td>{$element->ville}</td>
		<td>{$element->email}</td>
		<td>{$element->created}</td>
		<td><a href="{Router::url('admin/user/edit/'|cat:$element->id)}"><button>Editer</button></a></td>
		<td><a onclick="return confirm('Êtes vous sûr de vouloir supprimer cet utilisateur ?\n\nCette opération est définitive et peut provoquer des erreurs dans l\'application.\nSupprimer cet utilisateur seulement si vous savez exactement ce que vous faite !');" href="{Router::url('admin/user/delete/'|cat:$element->id)}"><button>Supprimer</button></a></td>	
	</tr>
{/foreach}
</table>