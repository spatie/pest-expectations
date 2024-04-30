# A collection of handy custom Pest customizations

[![Latest Version on Packagist](https://img.shields.io/packagist/v/spatie/pest-expectations.svg?style=flat-square)](https://packagist.org/packages/spatie/pest-expectations)
[![Tests](https://img.shields.io/github/actions/workflow/status/spatie/pest-expectations/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/spatie/pest-expectations/actions/workflows/run-tests.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/spatie/pest-expectations.svg?style=flat-square)](https://packagist.org/packages/spatie/pest-expectations)

This repo contains custom expectations to be used in a [Pest](https://pestphp.com) test suite.

It also contains various helpers to make testing with Pest easier. Imagine, you only want to run a test on GitHub Actions. You can use the `whenGitHubActions` helper to do so.

```php
it('can only run well on github actions', function () {
    // your test
})->whenGitHubActions();
```

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

Once installed, you can use the [custom expectations](#expectations) and [helpers](#helpers) provided by this package.

### Expectations

#### toPassWith

This expectation can be used to test if [an invokable validation rule](https://laravel.com/docs/master/validation#using-rule-objects) works correctly.

In this example, the `$value` will be given to `YourValidationRule`. The expectation will pass if your rule passed for the given value.

```php
expect(new YourValidationRule())->toPassWith($value);
```

You can expect the your validation not to pass for the given value, by using Pest's `not()`.

```php
expect(new YourValidationRule()->not()->toPassWith($value);
```

#### toFailWith

This expectation can be used to test if [an invokable validation rule](https://laravel.com/docs/master/validation#using-rule-objects) did not pass for a given value.

In this example, the `$value` will be given to `YourValidationRule`. The expectation will pass if your rule did not pass for the given value.

```php
expect(new YourValidationRule())->toFailWith($value);
```

Optionally, you can also pass a message as the second argument. The expectation will pass is the validation rule return the given `$message`.

```php
expect(new YourValidationRule())->toFailWith($value, 'This value is not valid.');
```

#### toBeModel

Expect that a value is a model an equal to the passed model.

```php
expect($model)->toBeModel($anotherModel);
```

The expectation will only pass if both models are Eloquent models of the same class, with the same key.

#### toBeScheduled

Expect that a value is a scheduled job, command or invokable class.

```php
expect(MyJob::class)->toBeScheduled('0 * * * *');
```

Optionally, you may pass a callback that accepts an `Illuminate\Console\Scheduling\Event` or `Illuminate\Console\Scheduling\CallbackEvent` instance, so you can run any assertion needed:

```php
expect(MyArtisanCommand::class)->toBeScheduled(function (Event $event) {
    expect($event->getExpression())->toBe('0 0 * * *');
    expect($event->getSummaryForDisplay())->toBe('Foo');
});
```

#### toHaveJsonApiPagination

Expect that a response has JSON:API pagination.
Have a look at our package [spatie/laravel-json-api-paginate](https://github.com/spatie/laravel-json-api-paginate) to see how to add JSON:API pagination to your Laravel app.

```php
$response = $this->get('/');

expect($response)->toHaveJsonApiPagination();
```

### Helpers

This package offers various helpers that you can tack on any test. Here's an example of the `whenGitHubActions` helper. When tacked on to a test, the test will be skipped unless you're running it on GitHub Actions.

```php
it('can only run well on github actions', function () {
    // your test
})->whenGitHubActions();
```

To use the helpers, you should call `registerSpatiePestHelpers()` in your `Pest.php` file.

These helpers are provided by this package:

- `whenConfig($configKey)`: only run the test when the given Laravel config key is set
- `whenEnvVar($envVarName)`: only run the test when the given environment variable is set
- `whenWindows`: the test will be skipped unless running on Windows
- `whenMac`: the test will be skipped unless running on macOS
- `whenLinux`: the test will be skipped unless running on Linux
- `whenGitHubActions()`: the test will be skipped unless running on GitHub Actions
- `skipOnGitHubActions()`: the test will be skipped when running on GitHub Actions
- `whenPhpVersion($version)`: the test will be skipped unless running on the given PHP version, or higher. You can pass a version like `8` or `8.1`.

### Assertions

This package also provides a set of custom assertions that you can use in your tests.

In your `TestCase` class, you can use the `CustomAssertions` trait and call the `registerCustomAssertions` method in the `setUp` method.

```php
class TestCase extends \Illuminate\Foundation\Testing\TestCase
{
    use CustomAssertions;

    protected function setUp(): void
    {
        parent::setUp();

        $this->registerCustomAssertions();
    }
```

#### assertHasJsonApiPagination

Assert that a response has JSON:API pagination.
Have a look at our package [spatie/laravel-json-api-paginate](https://github.com/spatie/laravel-json-api-paginate) to see how to add JSON:API pagination to your Laravel app.

```php
$this
    ->get('/')
    ->assertHasJsonApiPagination();
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
