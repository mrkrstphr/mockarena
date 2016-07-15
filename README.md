# heyyyyyyy mockarena

[![Builds](https://img.shields.io/travis/mrkrstphr/mockarena.svg?style=flat-square&maxAge=2592000)](https://travis-ci.org/mrkrstphr/mockarena)

> A function mocking utility for PHP

![](http://i.imgur.com/KBEQEqf.gif)

This library allows for mocking non-existent functions so that they can exist during tests, and their invocation be
tracked and evaluated.

## Example

```php
$mocker = new \Mockarena\Mockarena();
$fn = $mocker->mock('add_filter');

add_filter('login_url', 'some_func');

assert(count($fn->calls) === 1);
assert($fn->calls[0] == ['login_url', 'some_func']);
```
