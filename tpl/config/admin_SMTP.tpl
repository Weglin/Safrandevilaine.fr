<header><h1>Edition des paramètres d'envoie de mail (SMTP)</h1></header>
{$infos|default:null}
<hr />
<form action="{Router::url('admin/config/SMTP')}" method="post">
	{Form::input('name', 'smtp','smtp','hidden')}
	{Form::input('host', 'Host :', $smtp->host)}
	{Form::input('port', 'Port :', $smtp->port)}
	{Form::input('username', 'Identifiant :', $smtp->username)}
	{Form::input('password', 'Mot de passe :', $smtp->password)}
<input type="submit" value="Valider"><a href="{Router::url('admin/config/index')}"><button type="button">Retour</button></a>
</form>
