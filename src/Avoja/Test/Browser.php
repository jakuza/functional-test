<?php
/**
 * @author Jacopo 'Jakuza' Romei <jromei@gmail.com>
 */

namespace Avoja\Test;

use Goutte\Client as Goutte;

class Browser extends Goutte {

    /**
     * Creates a crawler.
     *
     * @param string $uri     A uri
     * @param string $content Content for the crawler to use
     * @param string $type    Content type
     *
     * @return Crawler
     */
    protected function createCrawlerFromContent($uri, $content, $type) {
        $crawler = new Crawler(null, $uri);
        $crawler->addContent($content, $type);

        return $crawler;
    }
}
