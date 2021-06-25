PHP7 Yandex Turbo Pages RSS feed generator
=====================================

Yandex Turbo Pages valid RSS feed generator for PHP 7.4. 

## Examples

```php
//create feed with all params
$feed = new Feed(
    'UTF-8',
    'Название канала',
    'http://www.example.com/',
    'Краткое описание канала',
    'ru',
    $turboAnalytics = new Yandex('yndx-metrica-id', ['param1' => 'afw'])
);

//create header for item
$header = new Header(
    $h1 = 'Ресторан «Полезный завтрак»',
    $imgSrc = 'https://avatars.mds.yandex.net/get-sbs-sd/403988/e6f459c3-8ada-44bf-a6c9-dbceb60f3757/orig',
    $h2 = 'Вкусно и полезно'
);

//we can add menuItem if need
$header->addMenuItem('http://example.com/page1.html','Пункт меню 1');
$header->addMenuItem('http://example.com/page2.html','Пункт меню 2');

$content = <<<CONTENT
    <p>Как хорошо начать день? <del>С чашки бодрящего кофе!</del> <ins>Вкусно и полезно позавтракать!</ins></p>
                    <p><b>Приходите</b> к нам на завтрак. Фотографии наших блюд ищите <a href="#">на нашем сайте</a>.</p>
                    <h2>Меню</h2>
                    <figure>
                        <img src="https://avatars.mds.yandex.net/get-sbs-sd/369181/49e3683c-ef58-4067-91f9-786222aa0e65/orig">
                        <figcaption>Омлет с травами</figcaption>
                    </figure> 
                    <p>В нашем меню всегда есть свежие, вкусные и полезные блюда.</p>
                    <p>Убедитесь в этом сами.</p>
                    <button formaction="tel:+7(123)456-78-90" data-background-color="#5B97B0" data-color="white" data-primary="true">Заказать столик</button>
                    <section id="contacts">
                        <div data-block="widget-feedback" data-stick="false">
                            <div data-block="chat" data-type="whatsapp" data-url="https://whatsapp.com"></div>
                            <div data-block="chat" data-type="telegram" data-url="http://telegram.com/"></div>
                            <div data-block="chat" data-type="vkontakte" data-url="https://vk.com/"></div>
                            <div data-block="chat" data-type="facebook" data-url="https://facebook.com"></div>
                            <div data-block="chat" data-type="viber" data-url="https://viber.com"></div>
                        </div>
                        <p>Наш адрес: <a href="#">Nullam dolor massa, porta a nulla in, ultricies vehicula arcu.</a></p>
                    <section>
                    <p><small>Фотографии — http://unsplash.com</small></p>
CONTENT;

$item = new Item(
    $turboExtendedHtml = true,
    'http://www.example.com/category/sub-category/page1.html',
    new TurboContent($header,$content)
);

$feed->addItem($item);
echo $feed->asXml();
```


## Installing


```bash
# Install Composer
curl -sS https://getcomposer.org/installer | php
```

Next, run the Composer command to install the latest stable version of **yandex-turbo-pages**

```bash
php composer.phar require lornkarios/yandex-turbo-pages
```

After installing, you need to require Composer's autoloader:

```php
require 'vendor/autoload.php';
```

You can then later update **yandex-turbo-pages** using composer:

 ```bash
composer.phar update
 ```
 
 
## Requirements

This Yandex Trurbo Pages RSS feed generator requires at least PHP 7.4


## License

[![License](https://poser.pugx.org/sokolnikov911/yandex-turbo-pages/license)](https://packagist.org/packages/sokolnikov911/yandex-turbo-pages)

This library is licensed under the MIT License.