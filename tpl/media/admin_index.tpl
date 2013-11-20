<header><h1>Bibliothèque des médias</h1></header>
{$infos|default:null}
<div class=mediaMenu>
	<a href="{Router::url('admin/media/add')}"><button>Ajouter des médias</button></a>
	<form action="{Router::url('admin/media/index')}" method="post" class="mediaIndex">
		<fieldset>
			<legend>Choisir un répertoire d'images :</legend>
			{Form::input('replist', '', $directories, 'select', $dirNow)}
			<input type="submit" value="Appliquer">
		</fieldset>
	</form>
</div>
<hr />
<div class="img_column">
{foreach from=$images item=element}
	<div class="element">
		<a onclick="return confirm('Vous êtes sur le point de supprimer une image.\nCelle-ci est peut être encore utilisé par le site.\n\n Merci de confirmer cette action');" href="{Router::url('admin/media/delete/'|cat:$element->id)}" class="suppr">delete</a>
		<div class="image"><img src="{$BASE_URL}/webroot/medias/img/{$element->dir}/{$element->fileName}" alt="{$element->fileName}" /></div>
		<div class="titre">{$element->titre}</div>
	</div>
{/foreach}
</div>

