<?php


namespace lornkarios\YandexTurboPages\Analytics;


class Yandex extends TurboAnalytics
{
    protected string $type = 'Yandex';

    public function __construct(string $id, array $params = null)
    {
        $this->addAttribute('id', $id);
        if ($params) {
            $params = json_encode($params, JSON_UNESCAPED_UNICODE);
            $this->addAttribute('params', $params);
        }

    }
}