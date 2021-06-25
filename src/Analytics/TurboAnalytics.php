<?php


namespace lornkarios\YandexTurboPages\Analytics;


use lornkarios\YandexTurboPages\XmlElement\XmlElement;

abstract class TurboAnalytics
{
    private array $attributes = [];
    protected string $type;

    protected function addAttribute(string $code, string $value)
    {
        $this->attributes[$code] = $value;
    }

    public function toXmlElement()
    {
        $this->attributes['type'] = $this->type;

        return new XmlElement('turbo:analytics', null, $this->attributes,null,'http://turbo.yandex.ru');
    }
}