<div style="margin-left:15px">
	<header><h1>Ajouter des médias</h1></header>
	<hr />
	{$infos|default:null}
	<form action="{Router::url('admin/media/Jadd')}" method="post" enctype="multipart/form-data" class="mediaAdd">
		<fieldset class="file">
			<legend>Sélectionner une image</legend>
			{Form::input('name', 'Donner un titre :')}
			{Form::input('file', '', '', 'file')}
		</fieldset>
		<fieldset class="rep">
			<legend>Choisir un emplacement de stockage</legend>
			{Form::input('rep', 'Nouveau répertoire :')}
			{Form::input('replist', 'OU sélectionner dans la liste :', $directories, 'select', '0')}
		</fieldset>
	<input type="submit" value="Ajouter"><a href="{Router::url('admin/media/Jindex')}"><button type="button">Retour</button></a>
</div>