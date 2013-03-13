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
     * Author's deviation
     * @var string
     */
    public $author;

    /**
     * Categorie's deviation
     * @var array
     */
    public $categorie;

    /**
     * Added date deviation
     * @var string
     */
    public $date;

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
        $this->prepare();
    }

    /**
     * If a deviation doesn't have got medium src, nor large src set them to null
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

    /**
     * Prepare deviation's informations
     *
     * @param void
     * @return void
     */
    public function prepare() {
        $by              = explode( 'by', $this->title );
        $this->title     = trim( $by[0] );
        $author          = explode( ',', $by[1] );
        $this->author    = substr( trim( $author[0] ), 1 );
        $categorie       = explode( 'in', trim( $author[2] ) );
        $this->categorie = explode( '>', trim( $categorie[1] ) );
        $this->date      = trim( $author[1] ) . trim( $categorie[0] );
    }

    /**
     * Save deviation locally
     *
     * @param string $path
     * @param string $size small, medium, full size
     * @return void
	 * @todo  test directory exists
     */
    public function save( $path, $size = 'small') {

        $size     = strtolower($size);
        switch ($size) {
            case 'small':
            default:
                $data     = file_get_contents( $this->deviationSmallSrc );
                $realName = explode( '/', $this->deviationSmallSrc );
                file_put_contents($path . 'small-' . $realName[ count($realName) - 1 ] , $data );
                break;

            case 'medium':
                if( !is_null( $this->deviationMediumSrc ) ) {
                    $data     = file_get_contents( $this->deviationMediumSrc );
                    $realName = explode( '/', $this->deviationMediumSrc );
                    file_put_contents($path . 'medium-' . $realName[ count($realName) - 1 ] , $data );
                }
                break;

            case 'full':
                if( !is_null( $this->deviationFullSrc ) ) {
                    $data     = file_get_contents( $this->deviationFullSrc );
                    $realName = explode( '/', $this->deviationFullSrc );
                    file_put_contents($path . 'full-' . $realName[ count($realName) - 1 ] , $data );
                }
                break;
        }
    }
    
}
