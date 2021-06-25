<?php


namespace lornkarios\YandexTurboPages\Item;


class Header
{
    private string $h1;
    private ?string $imgSrc;
    private ?string $h2;
    private array $menu = [];

    public function __construct(string $h1, string $imgSrc = null, string $h2 = null)
    {
        $this->h1 = $h1;
        $this->imgSrc = $imgSrc;
        $this->h2 = $h2;
    }

    public function addMenuItem(string $href, string $text): void
    {
        $this->menu[] = [
            'href' => $href,
            'text' => $text
        ];
    }

    public function __toString()
    {
        $html = "<header>" . PHP_EOL;
        $html .= "<h1>{$this->h1}</h1>" . PHP_EOL;

        if ($this->imgSrc) {
            $html .= "<figure><img src=\"{$this->imgSrc}\"/></figure>" . PHP_EOL;
        }
        if ($this->h2) {
            $html .= "<h2>{$this->h2}</h2>" . PHP_EOL;
        }
        if ($this->menu) {
            $html .= "menu" . PHP_EOL;
            foreach ($this->menu as $menuItem) {
                $html .= "<a href=\"{$menuItem['href']}\">{$menuItem['text']}</a>" . PHP_EOL;
            }
        }
        $html .= "</header>";
        return $html;
    }
}