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
 * Query a DOMDocument searching for user stats.
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
class DeviantStats extends DeviantParser {

    /**
     * Nodes from stats section
     *
     * @var DOMNodeList
     */
    public $statsNodeList;

    /**
     * Total user's deviations
     * @var string
     */
    public $deviations;

    /**
     * Total user's comments
     * @var string
     */
    public $comments;

    /**
     * User's account pageview
     * @var string
     */
    public $pageviews;

    /**
     * Total user's scraps
     * @var string
     */
    public $scraps;

    /**
     * Users account watchers
     * @var string
     */
    public $watchers;

    /**
     * Total user's critiques
     * @var string
     */
    public $critiques;

    /**
     * Total user's forum posts
     * @var string
     */
    public $forumPosts;

    /**
     * Total user's favourites
     * @var string
     */
    public $favourites;

    /**
     * Query DOMDocument searching for stats.
     *
     * @param DOMDocument $doc
     * @return void
     */
    public function  __construct(DOMDocument $doc) {
        parent::__construct($doc);

        $this->statsNodeList = $this->query("//div[@class='pbox pppbox']/strong");
        
        $this->deviations    = $this->statsNodeList->item(0)->nodeValue;
        $this->comments      = $this->statsNodeList->item(1)->nodeValue;
        $this->pageviews     = $this->statsNodeList->item(2)->nodeValue;
        $this->scraps        = $this->statsNodeList->item(3)->nodeValue;
        $this->watchers      = $this->statsNodeList->item(4)->nodeValue;
        $this->critiques     = $this->statsNodeList->item(5)->nodeValue;
        $this->forumPosts    = $this->statsNodeList->item(6)->nodeValue;
        $this->favourites    = $this->statsNodeList->item(7)->nodeValue;

    }

}