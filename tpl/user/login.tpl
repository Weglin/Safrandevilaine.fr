<h1>Ceci est une zone réservée, vous devez être un administrateur pour accéder à ces pages.</h1>
<hr />
{$userInfos|default:null}
<h2>Veuillez vous identifier :</h2>
<br />
<form action="{Router::url('login')}" method="post">
{Form::input('email', 'E-mail :',$userEmail|default:null)}
{Form::input('pwd', 'Mot de passe :', '', 'password')}
<input type="submit" value="S'identifier"><a href="{Router::url('accueil')}"><button type="button">Retour</button></a>
</form>