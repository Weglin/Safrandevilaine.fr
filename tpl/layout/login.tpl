<table class="login"><tr>
<td style="width:30%">{$userInfos|default:null}</td>
<td>
	<form action="{Router::url('login')}" method="post">
		{Form::input('email', 'E-mail :',$userEmail|default:null)} {Form::input('pwd', 'Mot de passe :', '', 'password')} <input type="submit" value="S'identifier"><a href="{Router::url('inscription')}"><button type="button">Inscription</button></a>
	</form>
</td>
</tr></table>