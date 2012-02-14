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


/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * @todo : Harvest category to. eg : webdesign > bla > bla and put them in array
 */

class Deviation extends DeviantParser{

    public $title;
    public $deviantUrl;
    public $deviationSmallSrc;
    public $deviationSmallWidth;
    public $deviationSmallHeight;
    public $deviationMediumSrc;
    public $deviationMediumWidth;
    public $deviationMediumHeight;
    public $deviationFullSrc;
    public $deviationFullWidth;
    public $deviationFullHeight;

    public function  __construct( DOMNode $node ) {

        $this->title                 = $node->attributes->getNamedItem("title")->nodeValue;
        $this->deviantUrl            = $node->attributes->getNamedItem("href")->nodeValue;
        $this->deviationSmallSrc     = $node->getElementsByTagName('img')->item(0)->attributes->getNamedItem("data-src")->nodeValue;
        $this->deviationSmallHeight  = $node->getElementsByTagName('img')->item(0)->attributes->getNamedItem("height")->nodeValue;
        $this->deviationSmallWidth   = $node->getElementsByTagName('img')->item(0)->attributes->getNamedItem("width")->nodeValue;      
        $this->deviationMediumSrc    = self::attributeDefault( $node, 'super_img' );
        $this->deviationMediumHeight = self::attributeDefault( $node, 'super_h' );
        $this->deviationMediumWidth  = self::attributeDefault( $node, 'super_w' );
        $this->deviationFullSrc      = self::attributeDefault( $node, 'super_fullimg' );
        $this->deviationFullWidth    = self::attributeDefault( $node, 'super_fullw' );
        $this->deviationFullHeight   = self::attributeDefault( $node, 'super_fullh' );
 
    }

    public static function attributeDefault( DOMNode $node, $attributeName ) {
        if( @$node->attributes->getNamedItem( $attributeName )->nodeValue ) {
            return $node->attributes->getNamedItem( $attributeName )->nodeValue;
        }
        else {
            return NULL;
        }
    }

    public function  __toString() {
    }

}
