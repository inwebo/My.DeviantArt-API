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
 * Query a DOMDocument gallery and grab all deviations.
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
class Gallery {

    public $deviantId;
    public $url;
    public $currentPage;
    public $totalPage;
    public $splObjectStorage;
    public $dom;
    public $query;

    public function __construct( $deviantId, $url = NULL) {
        
        $this->deviantId = $deviantId;
        $this->splObjectStorage = new SplObjectStorage();;
        if( !is_null( $url ) ) {
            $this->url   = $url;
            $this->dom   = new DOMDeviantGallery( $deviantId, $this->url );
            $this->xpath = new DeviantGallery( $this->dom );
        }
        else {
            $this->dom = new DOMDeviant( $deviantId );
            $this->url = $this->dom->galleryUrl;
            $this->dom = new DOMDeviantGallery( $deviantId, $this->url );
        }
        
        $this->xpath     = new DeviantGallery( $this->dom );
        $this->totalPage = $this->xpath->pages;

    }

    public function page( $which ) {

        if( ( intval( $which ) <= count( $this->xpath->pagesUrlList ) ) && ( intval( $which ) >= 0 ) ) {

            if( isset( $this->xpath->pagesUrlList[$which] ) ) {
                $this->url = $this->url . $this->xpath->pagesUrlList[$which];
            }
            
            $this->dom      = new DOMDeviantGallery( $this->deviantId, $this->url );
            $this->xpath    = new DeviantGallery( $this->dom );
        }

       return $this->xpath->splObjectStorage;
    }

    /**
     * Grab all deviation from a gallerie
     *
     * @param void
     * @return splObjectStorage
     */
    public function all() {
        foreach( $this->xpath->pagesUrlList as $value ) {
            $buffer      = $this->url . $value;
            $this->dom   = new DOMDeviantGallery( $this->deviantId, $buffer );
            $this->xpath = new DeviantGallery( $this->dom );
            $this->splObjectStorage->addAll( $this->xpath->splObjectStorage );
        }
        return $this->splObjectStorage;
    }

}