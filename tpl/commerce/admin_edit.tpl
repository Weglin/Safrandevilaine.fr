<header><h1>Edition du commerce : {$commerce->nom} </h1></header>
{$infos|default:null}
<a href="{Router::url('admin/commerce/view/'|cat:$commerce->id)}"><button>Prévisualisation</button></a>
<hr />
<form action="{Router::url('admin/commerce/edit/'|cat:$commerce->id)}" method="post">
{Form::input('id', null, $commerce->id, 'hidden')}
{Form::input('nom', 'Nom :', $commerce->nom)}
{Form::input('activite', 'Activité :', $commerce->activite)}
{Form::input('detail', 'Détail :', $commerce->detail, 'textarea', 'rows="2" cols="20"')}
{Form::input('proprio', 'Propriétaire:', $commerce->proprio)}
{Form::input('adresse', 'Adresse :', $commerce->adresse, 'textarea', 'rows="3" cols="20"')}
{Form::input('cp', 'Code Postal :', $commerce->cp)}
{Form::input('ville', 'Ville :', $commerce->ville)}
{Form::input('tel1', 'Tel 1 :', $commerce->tel1)}
{Form::input('tel2', 'Tel 2 :', $commerce->tel2)}
{Form::input('web', 'Site Internet :', $commerce->web)}
{Form::input('vente', 'Point de vente :', $commerce->vente, 'checkbox')}
{Form::input('degustation', 'Point de dégustation :', $commerce->degustation, 'checkbox')}
{Form::input('online', 'Publiée :', $commerce->online, 'checkbox')}
{Form::input('created', 'Date de création :', $commerce->created, 'date')}
<input type="submit" value="Valider"><a href="{Router::url('admin/commerce/index')}"><button type="button">Retour</button></a>
</form>

