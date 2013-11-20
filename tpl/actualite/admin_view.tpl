<header><h1>Prévisualisation de l'actualité : {$actualite->name}</h1></header>
<a href="{Router::url('admin/actualite/edit/'|cat:$actualite->id)}"><button>Editer</button></a>
<hr/>
<h1>{$actualite->name}</h1>
{eval  var=$actualite->content}<br />