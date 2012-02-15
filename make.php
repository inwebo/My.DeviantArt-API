<?php

try {
    $phar = new Phar( __DIR__ . '/phar/deviant-api.phar' );
    $phar->buildFromDirectory(__DIR__ . '/lib', '/\.php$/');
    $phar->stopBuffering();
}
catch(Exception $e) {
    echo $e->getMessage();
}


?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
    <title>Deviant art API</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  </head>
  <body>
    <h1>Création de l'archive ok !</h1>
    <p>
        Elle se trouve à la racine du dossier courant et se nomme deviant-api.phar.php
    </p>
    <p>
        Fonctionnement trés simple, plutôt que d'inclure n fichiers, d'avoir un recours à un
        autoload, il suffit d'inclure l'archive phar !
        Pour en savoir plus il existe ce trés bon article <a href="http://blog.pascal-martin.fr/post/php-5.3-phar-php-archive#phar-premiere-archive">PHAR premiere archive</a>
    </p>
    <code>
        include ('phar/deviant-api.phar');
        // Toutes les classes sont dorénavant disponibles.
    </code>
  </body>
</html>