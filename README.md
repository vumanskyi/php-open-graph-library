# PHP Open Graph library

This is a library to help you configure and render [Open Graph Protocol](https://ogp.me) and [Twitter Cards](https://developer.twitter.com/en/docs/tweets/optimize-with-cards/overview/abouts-cards)     for your website.

## Installation

The package could be installed with composer:
```
```

## Usage
```
use VU\OpenGraph\Render;
use VU\OpenGraph\TagConfiguration;
use VU\OpenGraph\Tags\Basic;

$render = new Render();
$configuration = new TagConfiguration($render);

$basic = new Basic($configuration);
$basic->setTitle('Test title')
    ->setDescription('Test description')
    ->setLocale('uk_UA')
    ->handle();

echo $basic->render();
```
And the result will be:
```
<meta property="og:title" content="Test title">
<meta property="og:description" content="Test description">
<meta property="og:locale" content="uk_UA">
```

Another types:
 - \VU\OpenGraph\Tags\Articles
 - \VU\OpenGraph\Tags\Audio
 - \VU\OpenGraph\Tags\Basic
 - \VU\OpenGraph\Tags\Book
 - \VU\OpenGraph\Tags\Image
 - \VU\OpenGraph\Tags\Profile
 - \VU\OpenGraph\Tags\Video
 - \VU\OpenGraph\Tags\TwitterCard
 
## Unit testing
```
./vendor/bin/phpunit 
```
---------------------- 
If you have any [issues](https://github.com/vumanskyi/vanilla-open-graph/issues), pleas let me know
