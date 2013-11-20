<header><h1>Création d'un nouveau commerce</h1></header>
<hr />
<form action="{Router::url('admin/commerce/edit')}" method="post">
{Form::input('nom', 'Nom :', null)}
{Form::input('activite', 'Activité :', null)}
{Form::input('detail', 'Détail :', null, 'textarea', 'rows="2" cols="20"')}
{Form::input('proprio', 'Propriétaire:', null)}
{Form::input('adresse', 'Adresse :', null, 'textarea', 'rows="3" cols="20"')}
{Form::input('cp', 'Code Postal :', null)}
{Form::input('ville', 'Ville :', null)}
{Form::input('tel1', 'Tel 1 :', null)}
{Form::input('tel2', 'Tel 2 :', null)}
{Form::input('web', 'Site Internet :', 'http://www.')}
{Form::input('vente', 'Point de vente :', 0, 'checkbox')}
{Form::input('degustation', 'Point de dégustation :', 0, 'checkbox')}
{Form::input('online', 'Publiée :', 0, 'checkbox')}
<input type="submit" value="Ajouter"><a href="{Router::url('admin/commerce/index')}"><button type="button">Annuler</button></a>
</form>