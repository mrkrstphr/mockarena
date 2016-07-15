# heyyyyyyy mockarena

[![Builds](https://img.shields.io/travis/mrkrstphr/mockarena.svg?style=flat-square&maxAge=2592000)](https://travis-ci.org/mrkrstphr/mockarena)

> A function mocking utility for PHP

![](http://i.imgur.com/KBEQEqf.gif)

This library allows for mocking non-existent functions so that they can exist during tests, and their invocation be
tracked and evaluated.

## Example

```php
it('should add a login_url filter', function () {
    $fn = $this->mocker->mock('add_filter');
    $class = new WPSingleSignOn($this->apiClient->reveal());

    expect($fn)->to->have->been->called(1);
    expect($fn)->calls(0)->to->have->arguments('login_url', [$class, 'redirecToProvider'], 10, 2);
});
```
