<div style="display:inline; margin-left:20px">{$infos|default:null}</div>
<div style="display:inline-block; margin-left: 360px;">
	<form action="{Router::url('login')}" method="post" class="login">
		{Form::input('email', 'E-mail :')} {Form::input('pwd', 'Mot de passe :', '', 'password')} <input type="submit" value="S'identifier">
	</form>
<div>