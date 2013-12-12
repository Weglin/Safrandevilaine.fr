<header><h1>{$titre} {$article->id_typeArt} {$article->nom}</h1></header>
{$infos|default:null}
<hr />
<form action="{Router::url('admin/article/edit/'|cat:$article->id|default:null)}" method="post">
	{Form::input('id', null, $article->id|default:null, 'hidden')}
	{Form::input('created', 'Date de création :', $article->created|default:null, 'dateTime', $created|default:null)}
	<fieldset>
		<legend>Données de l'article</legend>
		{Form::input('id_typeArt', 'Type :', $article->id_typeArt|default:null)}
		{Form::input('nom', 'Nom :', $article->nom|default:null)}
		{Form::input('TTC', 'Prix (€):', $article->TTC|default:null)}
		{Form::input('photo', 'Photo :', $article->photo|default:null)}
	</fieldset>
	<input type="submit" value="Valider"><a href="{Router::url('admin/article/index')}"><button type="button">Retour</button></a>
</form>