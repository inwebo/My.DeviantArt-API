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
 * Object representation of one pictures deviation.
 *
 * @category  My.Deviant API
 * @package   Base
 * @copyright Copyright (c) 2005-2011 Inwebo (http://www.inwebo.net)
 * @author    Julien Hannotin
 * @license   http://creativecommons.org/licenses/by-nc-sa/2.0/fr/
 * @version   $Id:$
 * @link      https://github.com/inwebo/My.DeviantArtParser
 * @since     File available since Beta 01-02-2012
 * @todo      Harvest category to. eg : webdesign > bla > bla and put them in array
 */

class Deviation extends DeviantParser{

    /**
     * Deviation's title
     * @var string
     */
    public $title;

    /**
     * Deviation's original url
     * @var string
     */
    public $deviantUrl;

    /**
     * Deviation's small img src
     * @var string
     */
    public $deviationSmallSrc;

    /**
     * Deviation's small img width
     * @var string
     */
    public $deviationSmallWidth;

    /**
     * Deviation's small img height
     * @var string
     */
    public $deviationSmallHeight;

    /**
     * Deviation's medium img src
     * @var string
     */
    public $deviationMediumSrc;

    /**
     * Deviation's medium img width
     * @var string
     */
    public $deviationMediumWidth;

    /**
     * Deviation's medium img height
     * @var string
     */
    public $deviationMediumHeight;

    /**
     * Deviation's full img src
     * @var string
     */
    public $deviationFullSrc;

    /**
     * Deviation's full img width
     * @var string
     */
    public $deviationFullWidth;

    /**
     * Deviation's full img height
     * @var string
     */
    public $deviationFullHeight;

    /**
     * Collect all deviation's attributes from a DOMNode
     *
     * @param DOMNode $node
     * @return void
     */
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

    /**
     * If a deviation doesn't have got medium src, or large src set them to null
     *
     * @param DOMNode $node
     * @param string $attributeName attribute's value searching for.
     * @return void
     */
    public static function attributeDefault( DOMNode $node, $attributeName ) {
        if( @$node->attributes->getNamedItem( $attributeName )->nodeValue ) {
            return $node->attributes->getNamedItem( $attributeName )->nodeValue;
        }
        else {
            return NULL;
        }
    }

}
