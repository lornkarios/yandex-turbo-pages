<?php


namespace lornkarios\YandexTurboPages;


use lornkarios\YandexTurboPages\Analytics\TurboAnalytics;
use lornkarios\YandexTurboPages\Item\Item;
use lornkarios\YandexTurboPages\XmlElement\XmlElement;

class Feed
{
    private string $encoding;
    /**
     * @var Item[]
     */
    private array $items=[];
    private ?string $title;
    private ?string $link;
    private ?string $description;
    private ?string $language;
    private ?TurboAnalytics $turboAnalytics;

    public function __construct(
        string $encoding = 'UTF-8',
        string $title = null,
        string $link = null,
        string $description = null,
        string $language = 'ru',
        TurboAnalytics $turboAnalytics = null
    )
    {
        $this->encoding = $encoding;
        $this->title = $title;
        $this->link = $link;
        $this->description = $description;
        $this->language = $language;
        $this->turboAnalytics = $turboAnalytics;
    }

    public function addItem(Item $item)
    {
        $this->items[] = $item;
    }

    public function asXml()
    {
        $xmlstr = <<<XML
<?xml version="1.0" encoding="{$this->encoding}"?>
<rss xmlns:yandex="http://news.yandex.ru"
     xmlns:media="http://search.yahoo.com/mrss/"
     xmlns:turbo="http://turbo.yandex.ru"
     version="2.0"></rss>
XML;

        $xml = new XmlElement('channel');
        if ($this->title) {
            $xml->addChild(new XmlElement('title', $this->title));
        }
        if ($this->link) {
            $xml->addChild(new XmlElement('link', $this->link));
        }
        if ($this->description) {
            $xml->addChild(new XmlElement('description', $this->description));
        }
        if ($this->language) {
            $xml->addChild(new XmlElement('language', $this->language));
        }
        if ($this->turboAnalytics) {
            $xml->addChild($this->turboAnalytics->toXmlElement());
        }

        foreach ($this->items as $item){
            $xml->addChild($item->toXmlElement());
        }

        return $xml->toXml(new \SimpleXMLElement($xmlstr,LIBXML_NOERROR | LIBXML_ERR_NONE | LIBXML_ERR_FATAL));
    }
}