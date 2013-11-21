<HTML>
	<BODY>
		<div style="height:20px;"></div>
		<span style="font-size=14px;">Vous avez une demande de contact de la part de :</span><br/>
		<bold style="margin-left:15px;"> Nom :</bold> {$data->name}<br />
		<bold style="margin-left:15px;"> E-mail :</bold> {$data->email}<br />
		<div style="height:20px;"></div>
		<span style="font-size=14px;">Son message est le suivant :</span><br/>
		<div style="margin-left:15px;">{$data->content}</div>
	</BODY>
</HTML>