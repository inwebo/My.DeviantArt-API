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
 * Query a DOMDocument searching for gallery and its total pages
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
class DeviantGallery extends DeviantParser {

    public $pagesNodeList;
    public $pages;

    public $deviationsNodeList;
    public $deviationsSplObjectStorage;

    public function  __construct(DOMDocument $doc) {
        parent::__construct($doc);
        $this->pages                      = $this->totalPages();
        $this->deviationsNodeList         = $this->query("//a[@class='thumb']");
        $this->deviationsSplObjectStorage = $this->iterate( $this->deviationsNodeList, 'DeviantParser::factoryDeviation' ) ;
    }

    public function totalPages() {
        $this->pagesNodeList = $this->query("//ul[@class='pages']/li");
        $length              = $this->pagesNodeList->length;

        if( $length === 0 ) {
            $length++;
        }
        else {
            $length -= 2;
        }

        return $length;
    }

}