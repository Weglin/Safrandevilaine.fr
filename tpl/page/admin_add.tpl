<header><h1>Création d'une nouvelle page</h1></header>
<hr />
<form action="{Router::url('admin/page/edit')}" method="post">
{Form::input('name', 'Nom :', 'Nom de la page')}
{Form::input('slug', 'Raccourci URL :', 'Url de la page')}
{Form::input('created', 'Date de création :', $page->created, 'date')}
{Form::input('online', 'Publiée :', 0, 'checkbox')}
{Form::input('content', 'Contenu :', 'Contenu de la page en html', 'textarea', 'rows="20" cols="100"')}
<input type="submit" value="Ajouter"><a href="{Router::url('admin/page/index')}"><button type="button">Annuler</button></a>
</form>