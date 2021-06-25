<?php


namespace lornkarios\YandexTurboPages\Analytics;


class LiveInterner extends TurboAnalytics
{
    protected string $type = 'LiveInternet';

    public function __construct(string $params = null)
    {
        if ($params) {
            $this->addAttribute('params', $params);
        }
    }
}