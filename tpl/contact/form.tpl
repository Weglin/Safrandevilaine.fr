{$infos|default:null}
<hr />
<form action="{Router::url('contact')}" method="post" class="contact">
    {Form::input('subject','','Demande de contact (site Web)', 'hidden')}
    <fieldset>
    	<legend>Indiquer vos coordonnées</legend>
    	{Form::input('name', 'Votre nom :',$form->name|default:null)}
    	{Form::input('email', 'Votre E-mail :',$form->email|default:null)}
    </fieldset>
    <fieldset class="comments">
    	<legend>Votre message</legend>
    	{form::input('content','', $form->content,'textarea', 'rows="10" cols="45"')}
    </textarea>
	</fieldset>
    <input type="submit" value="Envoyer">
</form>
<div style="height:20px;"></div>