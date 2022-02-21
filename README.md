[//]: # (![Mail Intercept banner]&#40;screenshots/banner.jpg&#41;)

# Laravel Actions
### A package for handling simple actions with eventing.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/kirschbaum-development/laravel-actions)](https://packagist.org/packages/kirschbaum-development/laravel-actions)
[![Total Downloads](https://img.shields.io/packagist/dt/kirschbaum-development/laravel-actions)](https://packagist.org/packages/kirschbaum-development/laravel-actions)
[![Actions Status](https://github.com/kirschbaum-development/laravel-actions/workflows/CI/badge.svg)](https://github.com/kirschbaum-development/laravel-actions/actions)

Laravel Actions are simple job-like classes that don't interact with the queue. Actions are great to leverage when you have some simple functionality that you need to reuse.

But why would you want to use Actions you ask? Actions are great when you have small bits of code that you want to extract into small, testable classes. Actions can also take the place of queued jobs when you don't want or need that kind of power, or if you need the results of the code right now.

But the real power is with eventing.

This package exposes two events during your Action:
- Before the Action begins
- After the Action completes

The special sauce here is that you get to tell the Action which events you want triggered!

## Requirements

This package requires Laravel 6.0 or higher.

## Installation

```bash
composer require kirschbaum-development/laravel-actions
```

## Creating and Preparing the Action

Create a new Action with artisan command:

```bash
php artisan make:action ChuckNorris
```

This will create a new Action class at `app/Actions/ChuckNorris.php`. You are, of course, free to move the action wherever you want. Just make sure you update the namespace!

There are two public properties ready for your events: `$before` and `$after`. You can use one or both of these, and you can remove either of them if you don't use them in your Action class.

```php
 /**
  * Event to dispatch before action starts.
  *
  * @var string
  */
 public $before = ChuckNorrisWillBlowYourMind::class;

 /**
  * Event to dispatch after action completes.
  *
  * @var string
  */
 public $after = ChuckNorrisBlewYourMind::class;
```

Next place your required arguments within the `__construct()` method and your Action code within the `__invoke()` method. You are free to return anything you might need from the invokeable method. Now we're ready to use the Action!

```php
/**
 * Create a new action instance.
 *
 * @return void
 */
public function __construct()
{
    // Pass any arguments you need.
}

/**
 * Execute the action.
 *
 * @return mixed
 */
public function __invoke()
{
    // Handle your action here.
}
```

## Usage

There are two different ways we can call our newly created Action.

### From the Action

We can call one of three methods on the Action itself as long as the class is using the `CanAct` trait.

```php
ChuckNorris::act($data);
ChuckNorris::actWhen($isChuckNorrisMighty, $data);
ChuckNorris::actUnless($isChuckNorrisPuny, $data);
```

The `$data` is passed into the Action's constructor. You can pass as many arguments as needed in your use case.

The second two methods, `actWhen` and `actUnless` require a condition as the first variable. These work like other Laravel methods such as `throw_if()` and `throw_unless()`. Finally, you can pass as many arguments as needed for your Action after the condition.

### Facade

The package also has a facade. Here's the syntax:

```php
use Kirschbaum\Actions\Facades\Action;

Action::act(new ChuckNorris($data));
Action::actWhen($isChuckNorrisMighty, new ChuckNorris($data));
Action::actUnless($isChuckNorrisPuny, new ChuckNorris($data));
```

The usage is nearly identical to calling the methods directly on the Action as mentioned in the section above. The benefit here is that you can easily test actions using `Action::shouldReceive('act')`, `Action::shouldReceive('actWhen')` or `Action::shouldReceive('actUnless')`.

### Helpers

The package also has a few handy helpers to get Chuck in action. Here's the syntax:

```php
act(new ChuckNorris($data));
act_when($isChuckNorrisMighty, new ChuckNorris($data));
act_unless($isChuckNorrisPuny, new ChuckNorris($data));
```

### Dependency Injection

You can even inject Actions as a dependencies inside your application!

```php
use Kirschbaum\Actions\Contracts\Actionable;

public function index (Actionable $action)
{
    $action->act(new ChuckNorris($data));
    $action->actWhen($isChuckNorrisMighty, new ChuckNorris($data));
    $action->actUnless($isChuckNorrisPuny, new ChuckNorris($data));
}
```

## Handling Failures

We all know Chuck Norris isn't going to fail us, but he isn't the only one using this... Handling failures is pretty easy with Actions. Out of the box, any exceptions thrown by your Action classes get handled by Laravel's exception handler. If you'd rather implement your own logic during a failure, add a `failed()` method to your Action. It's that easy! You can return data from your `failed()` method if you choose as well.

```php
/**
 * Handle failure of the action.
 *
 * @throws Throwable
 *
 * @return mixed
 */
public function failed(Throwable $exception)
{
    event(new VanDammeFailedEvent);
}
```

Hashtag #BAM!

### Custom Exceptions

Another option for handling failures is to tell the Action to throw its own exception. If you don't need the extra overhead of writing your own `failed()` method, you can just tell your Action to throw a custom exception. It's as simple as just defining the exception you want thrown from the Action.

```php
/**
 * Event to dispatch if action throws an exception.
 *
 * @var string
 */
public $exception = SeagalFailedException::class;
```

## Testing

Have no fear. Testing all of this is very straightforward. There are two approaches to testing built in.

### Testing Facades

If you are using Facades to implement your Actions, you can use the standard `shouldReceive()` method directly from the Facade.

```php
use Kirschbaum\Actions\Facades\Action;

Action::shouldReceive('act')
    ->once()
    ->andReturnTrue();
```

### Mocking

If you are using helpers, the `CanAct` trait, or dependency injection, you can easily mock the `Actionable` interface with Laravel's mocking tools.

```php
use Kirschbaum\Actions\Contracts\Actionable;

$this->mock(Actionable::class, function ($mock) {
    $mock->shouldReceive('act')
        ->once()
        ->andReturnTrue();
});
```

## Last thoughts

If for some reason you'd prefer not to use the cool Eventing system, Facades, Mocking, etc., that's fine. Just call your Action like this:

```php
new ChuckNorris($data);
```

This will bypass all the magic and call the invoke method automagically, letting Chuck do his thing without anyone knowing, but why? ;)

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email brandon@kirschbaumdevelopment.com or nathan@kirschbaumdevelopment.com instead of using the issue tracker.

## Credits

- [Brandon Ferens](https://github.com/brandonferens)
- Inspired in part by [Luke Downing's](https://github.com/lukeraymonddowning) Laracon Online Winter '22 [talk](https://www.youtube.com/watch?v=0Rq-yHAwYjQ&t=1678s). 

## Sponsorship

Development of this package is sponsored by Kirschbaum, a developer driven company focused on problem solving, team building, and community. Learn more [about us](https://kirschbaumdevelopment.com) or [join us](https://careers.kirschbaumdevelopment.com)!

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
