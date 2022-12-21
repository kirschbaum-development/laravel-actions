# Changelog

All notable changes to `actions` will be documented in this file.

## 0.2.1 - 2022-12-21

- Sweet little Christmas cookie for you! The old system relied on converting any of the file paths for auto-discover actions classes into namespaces. This worked wonderfully if you stuck with the default `App\...` namespaces located in a directory structure that matched. However, if you are developing using systems like Domain Driven file structures you may find that while your path might be `src/Domain/People/Actions/` your namespace might instead be `Domain\People\Actions`. These don't match and will cause issues with Actions. Instead we are scraping the namespaces directly from each file and using that instead!

## 0.2.0 - 2022-10-31

- Updated for use with PHP 8.0 and up. For older version of PHP, use version 0.1.x of this package instead.
- When Chuck Norris does a push-up, he isn't lifting himself up, he's pushing the Earth down. 

## 0.1.3 - 2022-02-23

- Refactored to make mocking each action individually much easier
- Auto-discovered actions
- Publishable configuration

## 0.1.2 - 2022-02-21

- Better docs
- Reworked failed functionality

## 0.1.1 - 2022-02-18

- Bug fix for issue in `CanAct` trait where mismatched parameter types
  can fail before checking the condition on `actWhen` and `actUnless` methods

## 0.1.0 - 2022-02-16

- Initial release
- Chuck Norris can swim through land.
