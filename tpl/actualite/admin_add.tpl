<header><h1>Création d'une nouvelle actualité</h1></header>
<hr />
<form action="{Router::url('admin/actualite/edit')}" method="post">
{Form::input('name', 'Titre :', null)}
{Form::input('slug', 'Raccourci URL :', null)}
{Form::input('created', 'Date de création :', $actualite->created, 'date')}
{Form::input('online', 'Publiée :', 0, 'checkbox')}
{Form::input('content', 'Article :', null, 'textarea', 'rows="20" cols="100"')}
<br />
<input type="submit" value="Ajouter"><a href="{Router::url('admin/actualite/index')}"><button type="button">Annuler</button></a>
</form>
<br />