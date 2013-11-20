<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//FR" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
    
    <head>
        <title>Safran de Vilaine</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <link rel="stylesheet" media="screen" href="{$CSS}/style.css">

        <link rel="shortcut icon" href="{$CSS}/images/favicon.ico'" >
        <link rel="icon" type="image/gif" href="{$CSS}/images/animated_favicon1.gif" >
        
    </head>
    <body>
        <header>
            {include file='./header.tpl'}
        </header>
        <section class="content">
            <!-- affichage du menu -->
            {include file='./menu.tpl'}
            <!-- affichage du corps de la page-->
            {$body}
        </section>
        <footer>
            <!-- affichage du pied de page-->
            {include file='./footer.tpl'}
        </footer>


    </body>
</html>



