<header><h1>Test de la page : {$page->name}</h1></header>
<a href="{Router::url('admin/page/edit/'|cat:$page->id)}"><button>Editer</button></a>
<hr/>
<h1>{$page->name}</h1>
{eval  var=$page->content}<br />