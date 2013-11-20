<header><h1>Edition de la page : {$page->name} </h1></header>
{$infos|default:null}
<a href="{Router::url('admin/page/view/'|cat:$page->id)}"><button>Prévisualisation</button></a>
<hr />
<form action="{Router::url('admin/page/edit/'|cat:$page->id)}" method="post">
{Form::input('id', null, $page->id, 'hidden')}
{Form::input('name', 'Nom :', $page->name)}
{Form::input('slug', 'Raccourci URL :', $page->slug)}
{Form::input('created', 'Date de création :', $page->created, 'date')}
{Form::input('online', 'Publiée :', $page->online, 'checkbox')}
{Form::input('content', 'Contenu :', $page->content, 'textarea', 'rows="20" cols="100"')}
<input type="submit" value="Valider"><a href="{Router::url('admin/page/index')}"><button type="button">Retour</button></a>
</form>


