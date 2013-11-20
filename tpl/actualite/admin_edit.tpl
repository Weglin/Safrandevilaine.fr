<header><h1>Edition de l'actualité : {$actualite->name} </h1></header>
{$infos|default:null}
<a href="{Router::url('admin/actualite/view/'|cat:$actualite->id)}"><button>Prévisualisation</button></a>
<hr />
<form action="{Router::url('admin/actualite/edit/'|cat:$actualite->id)}" method="post">
{Form::input('id', null, $actualite->id, 'hidden')}
{Form::input('name', 'Titre :', $actualite->name)}
{Form::input('slug', 'Raccourci URL :', $actualite->slug)}
{Form::input('created', 'Date de création :', $actualite->created, 'date')}
{Form::input('online', 'Publiée :', $actualite->online, 'checkbox')}
{Form::input('content', 'Contenu :', $actualite->content, 'textarea', 'rows="20" cols="100"')}
<input type="submit" value="Valider"><a href="{Router::url('admin/actualite/index')}"><button type="button">Retour</button></a>
</form>
