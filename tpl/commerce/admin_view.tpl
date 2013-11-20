<header><h1>Prévisualisation du commerce : {$commerce->nom}</h1></header>
<a href="{Router::url('admin/commerce/edit/'|cat:$commerce->id)}"><button>Editer</button></a>
<hr/>
<div class=commercant>
    <h4>{$commerce->nom}</h4>
    {$commerce->activite}<br />
    {$commerce->proprio}<br />
    {$commerce->adresse}<br />
    {$commerce->cp}<br />
    {$commerce->ville}<br />
    {$commerce->tel1}<br />
    {$commerce->tel2}<br />
    {$commerce->web}<br />
</div>