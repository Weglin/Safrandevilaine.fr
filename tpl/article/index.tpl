<h1>Nos produits</h1>
{$infos|default:null}
<hr />
{foreach from=$articles item=element}
{$element->id}<br />
{$element->id_typeArt}<br />
{$element->nom}<br />
{$element->TTC}<br />
{$element->photo}<br />
{$element->dispo}<br />
<hr />
{/foreach}