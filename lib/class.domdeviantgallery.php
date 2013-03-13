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
 * Grab html code from a deviant gallery webpage and make it available as
 *  DOMDocument.
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

class DOMDeviantGallery extends DOMDeviant{

    /**
     * Getting html from this $url
     *
     * @var string
     */
    public $url;

    /**
     * If $categoryUrl is NULL get html code from default gallery. Else get html
     * code from $url.
     *
     * @param string $profilId
     * @param string $categoryUrl
     * @return void 
     */
    public function __construct( $profilId, $galleryUrl = NULL ) {
        parent::__construct( $profilId );

        if( $galleryUrl !== NULL ) {
            if( $this->getHTML( $galleryUrl ) ) {
                @$this->loadHTML( $this->html );
                $this->url = $galleryUrl;
            }
        }
        else {
            if( $this->getHTML( $this->galleryUrl ) ) {
                @$this->loadHTML( $this->html );
                $this->url = $this->galleryUrl;
            }
        }

    }

}