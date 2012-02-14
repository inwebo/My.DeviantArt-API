<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$classes = glob('lib/*.php');

$phar = new Phar('deviant-api.phar.php');

foreach( $classes as $class ) {
    $phar->addFile( $class );
}

?>
