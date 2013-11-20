<header><h1>Actualité</h1></header>

{foreach $actualites item=actualite}
	<h3>{$actualite->name}</h3>
	{$actualite->content}
	{insert name="DynamicUrl" type='actu' id=$actualite->id slug=$actualite->slug assign="link"}
	<a href="{$link}" title="Lire tout l'article">Lire la suite ></a>
	<hr />	
{/foreach}
<br />
{if $endLinkPage > 1}
<ul>
{for $linkPage=$startLinkPage to $endLinkPage}
	<li><a href="?page={$linkPage}">{$linkPage}</li>
{/for}
</ul>
{/if}

