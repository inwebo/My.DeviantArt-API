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
class DeviantFeatured extends DeviantParser {

    public $featuredNodeList;
    public $featuredDeviationsSplObjectStorage;

    public function  __construct(DOMDocument $doc) {
        parent::__construct($doc);
        $this->featuredNodeList                   = $this->query("//div[@class='gr-box gr-genericbox  gr-featured_deviation']/div[@class='gr-body']/div/div/div/span/span/a");
        $this->featuredDeviationsSplObjectStorage = $this->iterate( $this->featuredNodeList, 'DeviantParser::factoryDeviation' ) ;
    }



}