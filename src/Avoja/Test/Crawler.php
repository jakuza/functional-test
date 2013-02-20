<?php
/**
 * @author Jacopo 'Jakuza' Romei <jromei@gmail.com>
 */

namespace Avoja\Test;

use Symfony\Component\DomCrawler\Crawler as BaseCrawler;
use Symfony\Component\DomCrawler\Form as Form;

class Crawler extends BaseCrawler {

    /**
     * We need this method to be public
     *
     * @param $position
     *
     * @return null
     */
    public function getNode($position) {
        foreach ($this as $i => $node) {
            if ($i == $position) {
                return $node;
            }
        }

        return null;
    }

    /**
     * Build a new Form based on a CSS3 selector pointing at a form node.
     *
     * Example: $form = $crawler->buildFormFromNode($crawler, 'form#syi_create', $this->browser->getRequest()->getUri());
     *
     * $form = $crawler->buildFormFromNode($crawler, 'form#syi_create', $this->browser->getRequest()->getUri());
     *
     * @param $crawler
     * @param $css
     * @param $uri
     *
     * @return \Symfony\Component\DomCrawler\Form
     */
    public function buildFormFromNode($crawler, $css, $uri) {
        $form = new Form($crawler->filter($css)->getNode(0), $uri);

        return $form;
    }
}
