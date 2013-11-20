<header><h1>Gestion des commerces</h1></header>
{$infos|default:null}
<a href="{Router::url('admin/commerce/add')}"><button>Nouveau commerce</button></a>
<hr />
<table>
	<tr><th>Nom</th>
		<th>Propriétaire</th>
		<th>CP</th>
		<th>Ville</th>
		<th>Degus.</th>
		<th>Vente</th>
		<th>Online</th>
		<th colspan=2>Actions</th>
	</tr>
{foreach from=$commerces item=element}
	<tr>
		<td>{$element->nom}</td>
		<td>{$element->proprio}</td>
		<td>{$element->cp}</td>
		<td>{$element->ville}</td>
		<td>{$element->degustation}</td>
		<td>{$element->vente}</td>
		<td>{$element->online}</td>
		<td><a href="{Router::url('admin/commerce/edit/'|cat:$element->id)}"><button>Editer</button></a></td>
		<td><a onclick="return confirm('Êtes vous sûr de vouloir supprimer ce commerce ?\n\n(Vous pouver le mettre hors-ligne avant sa suppression définitive)');" href="{Router::url('admin/commerce/delete/'|cat:$element->id|cat:'/'|cat:$element->nom)}"><button>Supprimer</button></a></td>	
	</tr>
{/foreach}
</table>