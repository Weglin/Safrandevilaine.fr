<form action="{Router::url('contact')}" method="post" class="contact">
    {Form::input('subject','','Demande de contact (site Web)', 'hidden')}
    <fieldset>
    	<legend>Indiquer vos coordonnées</legend>
    	{Form::input('name', 'Votre nom :',$form->name)}
    	{Form::input('email', 'Votre E-mail :',$form->email)}
    </fieldset>
    <fieldset class="comments">
    	<legend>Votre message</legend>
    	{form::input('content','', $form->content,'textarea', 'rows="10" cols="45"')}
    </textarea>
	</fieldset>
    <input type="submit" value="Envoyer">
</form>
<div style="height:20px;"></div>