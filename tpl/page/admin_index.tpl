<header><h1>Gestion des pages statiques</h1></header>
{$infos|default:null}
<a href="{Router::url('admin/page/add')}"><button>Nouvelle page</button></a>
<hr />
<table>
	<tr>
		<th>id</th>
		<th>Nom</th>
		<th>slug</th>
		<th>Online</th>
		<th colspan=2>Actions</th>
	</tr>
{foreach from=$pages item=page}
	<tr>
		<td>{$page->id}</td>
		<td>{$page->name}</td>
		<td>{$page->slug}</td>
		<td>{$page->online}</td>
		<td><a href="{Router::url('admin/page/edit/'|cat:$page->id)}"><button>Editer</button></a></td>
		<td><a onclick="return confirm('Effacer ce contenu peut altérer le fonctionnement normal du site.\nEssayez de le mettre hors-ligne avant sa suppression.\n\nÊtes vous sûr de vouloir le supprimer ?');" href="{Router::url('admin/page/delete/'|cat:$page->id)}"><button>Supprimer</button></a></td>	
	</tr>
{/foreach}
</table>