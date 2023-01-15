# A collection of handy custom Pest expectations

[![Latest Version on Packagist](https://img.shields.io/packagist/v/spatie/pest-expectations.svg?style=flat-square)](https://packagist.org/packages/spatie/pest-expectations)
[![Tests](https://img.shields.io/github/actions/workflow/status/spatie/pest-expectations/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/spatie/pest-expectations/actions/workflows/run-tests.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/spatie/pest-expectations.svg?style=flat-square)](https://packagist.org/packages/spatie/pest-expectations)

This repo contains custom expectations to be used in a [Pest](https://pestphp.com) test suite.

## Support us

[<img src="https://github-ads.s3.eu-central-1.amazonaws.com/pest-expectations.jpg?t=1" width="419px" />](https://spatie.be/github-ad-click/pest-expectations)

We invest a lot of resources into creating [best in class open source packages](https://spatie.be/open-source). You can support us by [buying one of our paid products](https://spatie.be/open-source/support-us).

We highly appreciate you sending us a postcard from your hometown, mentioning which of our package(s) you are using. You'll find our address on [our contact page](https://spatie.be/about-us). We publish all received postcards on [our virtual postcard wall](https://spatie.be/open-source/postcards).

## Installation

You can install the package via composer:

```bash
composer require spatie/pest-expectations
```

## Usage

Once installed, you can use all of the following expectations.

### toPassWith

This expectation can be used to test if [an invokable validation rule](https://laravel.com/docs/master/validation#using-rule-objects) works correctly.

In this example, the `$value` will be given to `YourValidationRule`. The expectation will pass if your rule passed for the given value.

```php
expect(new YourValidationRule())->toPassWith($value);
```

You can expect the your validation not to pass for the given value, by using Pest's `not()`.

```php
expect(new YourValidationRule()->not()->toPassWith($value);
```

### toFailWith

This expectation can be used to test if [an invokable validation rule](https://laravel.com/docs/master/validation#using-rule-objects) did not pass for a given value.

In this example, the `$value` will be given to `YourValidationRule`. The expectation will pass if your rule did not pass for the given value.

```php
expect(new YourValidationRule())->toFailWith($value);
```

Optionally, you can also pass a message as the second argument. The expectation will pass is the validation rule return the given `$message`.

```php
expect(new YourValidationRule())->toFailWith($value, 'This value is not valid.');
```

### toBeEnum

Expect that a value is the passed enum.

Given this test enum...

```php
enum TestEnum: string
{
    case first = 'first';
    case second = 'second';

}
```

... all of these expectations will pass

```php
expect($value)->toBeEnum(TestEnum::first);
expect($value)->not()->toBeEnum(TestEnum::second);
expect('first')->not()->toBeEnum(TestEnum::first);
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](https://github.com/spatie/.github/blob/main/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Freek Van der Herten](https://github.com/freekmurze)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
