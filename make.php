<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$classes = glob('lib/*.php');

try {
    $phar = new Phar('deviant-api.phar.php');

    foreach( $classes as $class ) {
        $phar->addFile( $class );
    }
}
catch(Exception $e) {
    echo $e->getMessage();
}


?>
<h1>Creation de l'archive ok !</h1>
<p>
    elle se trouve à la racine du dossier courant et se nomme deviant-api.phar.php.
</p>