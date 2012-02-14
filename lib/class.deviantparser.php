<?php
/**
 * My.Deviant API
 *
 * LICENCE
 *
 * Vous êtes libre de :
 *
 * Partager : reproduire, distribuer et communiquer l'oeuvre
 * Remixer  : adapter l'oeuvre
 *
 * Selon les conditions suivantes :
 *
 * Attribution : Vous devez attribuer l'oeuvre de la manière indiquée par
 * l'auteur de l'oeuvre ou le titulaire des droits (mais pas d'une manière
 * qui suggérerait qu'ils vous soutiennent ou approuvent votre utilisation
 * de l'oeuvre).
 *
 * Pas d’Utilisation Commerciale : Vous n'avez pas le droit d'utiliser cette
 * oeuvre à des fins commerciales.
 *
 * Partage à l'Identique : Si vous modifiez, transformez ou adaptez cette
 * oeuvre, vous n'avez le droit de distribuer votre création que sous une
 * licence identique ou similaire à celle-ci.
 *
 * Remarque : A chaque réutilisation ou distribution de cette oeuvre, vous
 * devez faire apparaître clairement au public la licence selon laquelle elle
 * est mise à disposition. La meilleure manière de l'indiquer est un lien vers
 * cette page web.
 *
 */

 /**
  * Root class for querying our HTML.
  *
  * Description longue de la classe, s'il y en a une
  *
  * @category  My.Framworks
  * @package   Base
  * @copyright Copyright (c) 2005-2011 Inwebo (http://www.inwebo.net)
  * @author    Julien Hannotin
  * @license   http://creativecommons.org/licenses/by-nc-sa/2.0/fr/
  * @version   $Id:$
  * @link      https://github.com/inwebo/My.MVC
  * @since     File available since Beta 28-11-2011
  */


class DeviantParser extends DOMXPath {

    public function  __construct( DOMDocument $doc ) {
        parent::__construct( $doc );
    }

    public function iterate( DOMNodeList $nodelist, $callback ) {
        $SplObjectStorage = new SplObjectStorage();
        foreach( $nodelist as $item ) {
            $SplObjectStorage->attach( call_user_func( $callback, $item ) );
        }
        return $SplObjectStorage;
    }

    /* @todo : rename method */
    public function setDefault( DOMNodeList $nodeList, $index ) {
        if( @($nodeList->item($index)) ) {
            return $nodeList->item($index)->nodeValue;
        }
        else {
            return NULL;
        }
    }

    public static function factoryDeviation( DOMNode $node ) {
        return new Deviation( $node );
    }
    
    public static function factoryGallery( DOMNode $node ) {
        $gallerie       = new stdClass();
        $gallerie->url  = $node->attributes->getNamedItem("href")->nodeValue;
        $gallerie->name = $node->nodeValue;

        return $gallerie;
    }

}
