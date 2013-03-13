<?php

class XpathQueries {
    
    static $favorites = "//div[@class='gr-box gr-genericbox  gr-faves']/div[@class='gr-body']/div/div/div/span/span/a";
    static $featured = "//div[@class='gr-box gr-genericbox  gr-featured_deviation']/div[@class='gr-body']/div/div/div/span/span/a";
    static $galleries = "//div[@class='stream col-thumbs']/div/div/div[@class='label']/a";
    static $gallery = "//a[@class='thumb']";
    static $newest = "//div[@class='gr-box gr-genericbox  gr-newest']/div[@class='gr-body']/div/div/div/span/span/a";
    static $stats = "//div[@class='pbox pppbox']/strong";
    static $profilAboutMe = "//div[@id='super-secret-why']/div[@class='gr-body']/div[@class='gr']/div[@class='pbox']/dl[@class='f']/*";
    static $profilBadges = "//div[@class='gruserbadge']";
    static $profilAvatar = "//div[@class='catbar']/div/a/img";
    
}