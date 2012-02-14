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
 * Description of class
 *
 * @author inwebo
 */
class DeviantStats extends DeviantParser {

    public $statsNodeList;

    public $deviations;
    public $comments;
    public $pageviews;
    public $scraps;
    public $watchers;
    public $critiques;
    public $forum_posts;
    public $favourites;

    public function  __construct(DOMDocument $doc) {
        parent::__construct($doc);

        $this->statsNodeList = $this->query("//div[@class='pbox pppbox']/strong");
        
        $this->deviations    = $this->statsNodeList->item(0)->nodeValue;
        $this->comments      = $this->statsNodeList->item(1)->nodeValue;
        $this->pageviews     = $this->statsNodeList->item(2)->nodeValue;
        $this->scraps        = $this->statsNodeList->item(3)->nodeValue;
        $this->watchers      = $this->statsNodeList->item(4)->nodeValue;
        $this->critiques     = $this->statsNodeList->item(5)->nodeValue;
        $this->forum_posts   = $this->statsNodeList->item(6)->nodeValue;
        $this->favourites    = $this->statsNodeList->item(7)->nodeValue;

    }

}