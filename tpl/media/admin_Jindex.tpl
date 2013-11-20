<div class=mediaMenu>
	<a href="{Router::url('admin/media/Jadd')}"><button>Ajouter des médias</button></a>
	<form action="{Router::url('admin/media/Jindex')}" method="post" class="mediaIndex">
		<fieldset>
			<legend>Choisir un répertoire d'images</legend>
			{Form::input('replist', '', $directories, 'select', $dirNow)}
			<input type="submit" value="Appliquer">
		</fieldset>
	</form>
</div>
<hr />
<div class="content">
<div class="img_column">
	{foreach from=$images item=element}
		<div class="element">
			<div class="image">
				<a href="#" onclick="top.tinymce.activeEditor.windowManager.getParams().oninsert('{$BASE_URL}/webroot/medias/img/{$element->dir}/{$element->fileName}');">
					<img src="{$BASE_URL}/webroot/medias/img/{$element->dir}/{$element->fileName}" alt="{$element->fileName}" />
				</a>
			</div>
			<div class="titre">{$element->titre}</div>
		</div>
	{/foreach}
</div></div>

