<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 03.05.2017
 * Time: 23:09
 */

namespace frontend\components;
use yii\web\XmlResponseFormatter;
use DOMDocument,
    DOMElement;

class SitemapXmlResponseFormatter extends XmlResponseFormatter {
    public $rootTag = 'urlset';
    public $rootNS = 'http://www.sitemaps.org/schemas/sitemap/0.9';

    public function format($response)
    {
        $charset = $this->encoding === null ? $response->charset : $this->encoding;
        if (stripos($this->contentType, 'charset') === false) {
            $this->contentType .= '; charset=' . $charset;
        }
        $response->getHeaders()->set('Content-Type', $this->contentType);
        if ($response->data !== null) {
            $dom = new DOMDocument($this->version, $charset);
            $root = new DOMElement($this->rootTag, null, $this->rootNS);
            $dom->appendChild($root);
            $this->buildXml($root, $response->data);
            $response->content = $dom->saveXML();
        }
    }
} 