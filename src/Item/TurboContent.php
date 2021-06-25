<?php


namespace lornkarios\YandexTurboPages\Item;


use lornkarios\YandexTurboPages\XmlElement\XmlElement;

class TurboContent
{

    private string $content;
    private Header $header;

    public function __construct(Header $header, string $content)
    {
        $this->content = $content;
        $this->header = $header;
    }

    public function toXmlElement(): XmlElement
    {
        $xml = new XmlElement('turbo:content',   $this->header . PHP_EOL . $this->content ,null,true,'http://turbo.yandex.ru');
        return $xml;
    }
}