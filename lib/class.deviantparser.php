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
 * Query a DOMDocument searching for all newest deviations.
 *
 * @category  My.Deviant API
 * @package   Base
 * @copyright Copyright (c) 2005-2011 Inwebo (http://www.inwebo.net)
 * @author    Julien Hannotin
 * @license   http://creativecommons.org/licenses/by-nc-sa/2.0/fr/
 * @version   $Id:$
 * @link      https://github.com/inwebo/My.DeviantArtParser
 * @since     File available since Beta 01-02-2012
 *
 */

class DeviantParser extends DOMXPath {
    
    /**
     * Init Xpath
     *
     * @param DOMDocument $doc
     * @return void
     */
    public function  __construct( DOMDocument $doc ) {
        parent::__construct( $doc );
    }

    /**
     * Iterate a DOMNodeList and for each node call a callback function
     *
     * @param DOMDocument $doc
     * @return SplObjectStorage
     */
    public function iterate( DOMNodeList $nodelist, $callback ) {
        $SplObjectStorage = new SplObjectStorage();
        foreach( $nodelist as $item ) {
            $SplObjectStorage->attach( call_user_func( $callback, $item ) );
        }
        return $SplObjectStorage;
    }

    /**
     * Set default nodeValue to NULL if item doesn't have got a nodeValue
     *
     * @param DOMNodeList $nodeList to iterate
     * @param int $index
     * @return string if nodeValue is set else NULL
     */
    public function setDefault( DOMNodeList $nodeList, $index ) {
        if( @($nodeList->item($index)) ) {
            return $nodeList->item($index)->nodeValue;
        }
        else {
            return NULL;
        }
    }

    /**
     * Make deviation object from a DOMNode
     *
     * @param DOMNode $node a deviation't DOMNode
     * @return object Daviation
     */
    public static function factoryDeviation( DOMNode $node ) {
        return new Deviation( $node );
    }

    /**
     * Make gallery object from a DOMNode
     *
     * @param DOMNode $node a deviation't DOMNode
     * @return object stdClass $gallerie
     */
    public static function factoryGallery( DOMNode $node ) {
        $gallerie       = new stdClass();
        $gallerie->url  = $node->attributes->getNamedItem("href")->nodeValue;
        $gallerie->name = $node->nodeValue;

        return $gallerie;
    }

}
