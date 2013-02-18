<?php

namespace Kijiji\Test;

use Guzzle\Http\Client as Guzzle;

/**
 * @author jromei
 */
abstract class AbstractFunctionalTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var Goutte\Client
     */
    protected $browser;

    protected function assertUniqueRobotsTagEquals($crawler, $expectation) {
        $canonicalTag = $crawler->filter('meta[name="robots"]');
        $this->assertEquals(1, $canonicalTag->count(), 'Robots tag must be present');
        $this->assertEquals($expectation, $canonicalTag->attr('content'), "Robots tag's content must be exact");
    }

    protected function assertUniqueCanonicalUrlEquals($crawler, $expectation) {
        $canonicalTag = $crawler->filter('link[rel="canonical"]');
        $this->assertEquals(1, $canonicalTag->count(), 'Canonical tag must be present');
        $this->assertEquals($expectation, $canonicalTag->attr('href'), 'Canonical url must be exact');
    }

    protected function assertUniqueNoScriptTag($crawler) {
        $this->assertEquals(1, $crawler->filter('#noscript-links')->count(), 'Noscript tag must be present');
    }

    protected function assertUniqueDescriptionMetaEquals($crawler, $expectation) {
        $descriptionTag = $crawler->filter('meta[name="description"]');
        $this->assertEquals(1, $descriptionTag->count(), 'Description tag must be present');
        $actualDescr = html_entity_decode($descriptionTag->attr('content'));
        $this->assertEquals($expectation, $actualDescr, 'Description text must be exact');
    }

    protected function assertUniqueH1TagEquals($crawler, $expectation) {
        $this->assertEquals(1, $crawler->filter('h1')->count(), 'H1 tag must be present');
        $this->assertRegExp("/$expectation/", $crawler->filter('h1')->text(), 'H1 tag must be exact');
    }

    protected function assertUniqueTagEquals($crawler, $tag, $expectation) {
        $tagCrawler = $crawler->filter($tag);
        $this->assertEquals(1, $tagCrawler->count(), $tag.' tag must be present');
        $this->assertEquals($expectation, $tagCrawler->text(), $tag.' text must be exact');
    }

    protected function assertUniqueTitleEquals($crawler, $expectation) {
        $this->assertUniqueTagEquals($crawler, 'title', $expectation);
    }

    /**
     * Performs HTTP GET request.
     *
     * @param $url URL to fetch
     *
     * @return string
     */
    protected function get($url) {
        return $this->browser->request('GET', $url);
    }

    /**
     * Proxy method to get HTTP response payload
     *
     * @return mixed
     */
    protected function getResponseContent() {
        return $this->browser->getResponse()->getContent();
    }

    /**
     * Performs HTTP POST request.
     *
     * @param $url    URL to post to
     * @param $params
     * @param $params POST parameters
     *
     * @return string
     */
    protected function post($url, $params) {
        return $this->browser->request('POST', $url, $params);
    }

    public function setUp() {
        $this->http = new Guzzle();
        $this->http->setSslVerification(false);

        $this->browser = new Browser;
        $this->browser->setClient($this->http);
    }

}
