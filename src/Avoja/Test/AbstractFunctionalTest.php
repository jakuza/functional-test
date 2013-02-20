<?php
/**
 * @author Jacopo 'Jakuza' Romei <jromei@gmail.com>
 */

namespace Avoja\Test;

use Guzzle\Http\Client as Guzzle;

abstract class AbstractFunctionalTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var Goutte\Client
     */
    protected $browser;

    /**
     * Performs HTTP GET request.
     *
     * @param $url string URL to fetch
     *
     * @return string
     */
    protected function get($url)
    {
        return $this->browser->request('GET', $url);
    }

    /**
     * Proxy method to get HTTP response payload
     *
     * @return mixed
     */
    protected function getResponseContent()
    {
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
    protected function post($url, $params)
    {
        return $this->browser->request('POST', $url, $params);
    }

    public function setUp()
    {
        $this->http = new Guzzle();
        $this->http->setSslVerification(false);

        $this->browser = new Browser;
        $this->browser->setClient($this->http);
    }

}
