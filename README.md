[//]: # (![Mail Intercept banner]&#40;screenshots/banner.jpg&#41;)

# Laravel Actions
### A package for handling simple actions with eventing.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/kirschbaum-development/laravel-actions.svg)](https://packagist.org/packages/kirschbaum-development/laravel-actions)
[![Total Downloads](https://img.shields.io/packagist/dt/kirschbaum-development/laravel-actions.svg)](https://packagist.org/packages/kirschbaum-development/laravel-actions)
[![Actions Status](https://github.com/kirschbaum-development/laravel-actions/workflows/CI/badge.svg)](https://github.com/kirschbaum-development/laravel-actions/actions)

Laravel Actions are simple job-like classes that don't interact with the queue. Actions are great to leverage when you have some simple functionality that you need to reuse. But the real power is with eventing.

This package exposes three events during your action:
- Before the action begins
- After the action completes
- Upon a failure of the action

The special sauce here is that you get to tell the action which events you want triggered!

## Requirements

This testing package requires Laravel 6.0 or higher.

## Installation

```bash
composer require kirschbaum-development/laravel-actions
```

## Creating and Preparing the Action

Create a new action with artisan command:

```bash
php artisan make:action ChuckNorris
```

This will create a new action class at `app/Actions/ChuckNorris.php`.

There are three public properties ready for your events: `$before`, `$after`, and `$failed`. You can set the ones you need and remove the others.

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

Notice we did not set the `$failed` property as Chuck Norris doesn't fail.

Next place your required arguments within the `__construct()` method and your action code within the `__invoke()` method. You are free to return anything you might need from the invokeable method. Now we're ready to use the action!

## Usage

There are two different ways we can call our newly created action.

### From the Action

We can call one of three methods on the action itself as long as the class is using the `CanAct` trait.

```php
ChuckNorris::act($data);
ChuckNorris::actWhen($isChuckNorrisMighty, $data);
ChuckNorris::actUnless($isChuckNorrisPuny, $data);
```

The `$data` is passed into the action's constructor. You can pass as many arguments as is needed in your use case.

The second two methods, `actWhen` and `actUnless` require a condition as the first variable. These work like other Laravel methods such as `throw_if()` and `throw_unless()`. And once again, you can pass and many arguments as is needed for your action after the condition.

### Facade

The package also has a facade. Here's the syntax:

```php
use Kirschbaum\Actions\Facades\Action;

Action::act(new ChuckNorris($data));
Action::actWhen($isChuckNorrisMighty, new ChuckNorris($data));
Action::actUnless($isChuckNorrisPuny, new ChuckNorris($data));
```

The usage is nearly identical to calling the methods directly on the action as mentioned in the section above. The benefit here is that you can easily test actions using `Action::shouldReceive('act')` or whichever method you used!

### Helpers

The package also has a few handy helpers to get Chuck in action. Here's the syntax:

```php
act(new ChuckNorris($data));
actWhen($isChuckNorrisMighty, new ChuckNorris($data));
actUnless($isChuckNorrisPuny, new ChuckNorris($data));
```

## Last thoughts

If for some reason you'd prefer not to use the cool eventing system, that's fine. Just call your action like this:

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
