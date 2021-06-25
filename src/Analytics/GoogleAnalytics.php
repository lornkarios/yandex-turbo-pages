<?php


namespace lornkarios\YandexTurboPages\Analytics;


class GoogleAnalytics extends TurboAnalytics
{
    protected string $type = 'Google';

    public function __construct(string $id)
    {
        $this->addAttribute('id', $id);
    }
}