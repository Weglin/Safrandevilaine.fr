<header><h1>{$titre}</h1></header><hr />
{foreach from=$commerces item=element}
    <div class=commercant>
        <h4>{$element->nom}</h4>
        {$element->activite}<br />
        {$element->proprio}<br />
        {$element->adresse}<br />
        {$element->cp}<br />
        {$element->ville}<br />
        {$element->tel1}<br />
        {$element->tel2}<br />
        {$element->web}<br />
     </div>
{/foreach}