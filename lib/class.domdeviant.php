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
 * Grab html code from a webpage as string.
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

abstract class DOMDeviant extends DOMDocument{

    /**
     * Deviant's profil id, mine is inwebo
     * 
     * @var string
     */
    public $profilId;

    /**
     * Deviant's profil url, mine is http://inwebo.deviantart.com/
     *
     * @var string
     */
    public $profilUrl;

    /**
     * Deviant's gallery default url, mine is http://inwebo.deviantart.com/gallery/
     *
     * @var string
     */
    public $galleryUrl;

    /**
     * Webpage's html code.
     *
     * @var string
     */
    public $html;


    /**
     * Construct essentials class attributes
     *
     * @param string $profilId
     */
    public function __construct( $profilId ) {
        parent::__construct();
        $this->profilId   = $profilId;
        $this->profilUrl  = 'http://' . $this->profilId . '.deviantart.com/';
        $this->galleryUrl = $this->profilUrl . 'gallery/';
    }

    /**
     * Get html from $url.
     *
     * @param string $url
     * @return bool
     * @throws exception if $url doesn't exists
     */
    public function getHTML( $url ) {
            if( ( $this->html = @file_get_contents( $url ) ) !== FALSE ) {
                return true;
            }
            else {
                throw new Exception('<strong>' . $this->profilId . '</strong>\'s page doesn\'t exists @ : ' . $url );
            }
    }
    
}