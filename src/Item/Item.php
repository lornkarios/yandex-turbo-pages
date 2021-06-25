<?php


namespace lornkarios\YandexTurboPages\Item;


use DateTime;
use lornkarios\YandexTurboPages\Item\TurboContent;
use lornkarios\YandexTurboPages\XmlElement\XmlElement;

class Item
{
    private bool $turboExtendedHtml;
    private string $link;
    private TurboContent $turboContent;
    private bool $turbo;
    private ?string $turboSource;
    private ?string $turboTopic;
    private ?DateTime $pubDate;
    private ?string $author;

    public function __construct(
        bool $turboExtendedHtml,
        string $link,
        TurboContent $turboContent,
        bool $turbo = true,
        string $turboSource = null,
        string $turboTopic = null,
        DateTime $pubDate = null,
        string $author = null
    )
    {
        $this->turboExtendedHtml = $turboExtendedHtml;
        $this->link = $link;
        $this->turboContent = $turboContent;
        $this->turbo = $turbo;
        $this->turboSource = $turboSource;
        $this->turboTopic = $turboTopic;
        $this->pubDate = $pubDate;
        $this->author = $author;
    }

    public function toXmlElement(): XmlElement
    {
        $xml = new XmlElement('item', null, ['turbo' => ($this->turbo) ? 'true' : 'false']);
        $xml->addChild(new XmlElement('turbo:extendedHtml', ($this->turboExtendedHtml) ? 'true' : 'false',null,null,'http://turbo.yandex.ru'));
        $xml->addChild(new XmlElement('link', $this->link));
        if (!is_null($this->turboSource)) {
            $xml->addChild(new XmlElement('turbo:source', $this->turboSource,null,null,'http://turbo.yandex.ru'));
        }
        if (!is_null($this->turboSource)) {
            $xml->addChild(new XmlElement('turbo:topic', $this->turboSource,null,null,'http://turbo.yandex.ru'));
        }
        if (!is_null($this->pubDate)) {
            $xml->addChild(new XmlElement('pubDate', $this->pubDate->format(DateTime::RFC822)));
        }
        if (!is_null($this->author)) {
            $xml->addChild(new XmlElement('author', $this->author));
        }
        $xml->addChild($this->turboContent->toXmlElement());
        return $xml;
    }
}