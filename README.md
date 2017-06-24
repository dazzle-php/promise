# Dazzle Promise Implementation

[![Build Status](https://travis-ci.org/dazzle-php/promise.svg)](https://travis-ci.org/dazzle-php/promise)
[![Code Coverage](https://scrutinizer-ci.com/g/dazzle-php/promise/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/dazzle-php/promise/?branch=master)
[![Code Quality](https://scrutinizer-ci.com/g/dazzle-php/promise/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/dazzle-php/promise/?branch=master)
[![Latest Stable Version](https://poser.pugx.org/dazzle-php/promise/v/stable)](https://packagist.org/packages/dazzle-php/promise) 
[![Latest Unstable Version](https://poser.pugx.org/dazzle-php/promise/v/unstable)](https://packagist.org/packages/dazzle-php/promise) 
[![License](https://poser.pugx.org/dazzle-php/promise/license)](https://packagist.org/packages/dazzle-php/promise/license)

<br>
<p align="center">
<img src="https://avatars0.githubusercontent.com/u/29509136?v=3&s=150" />
</p>

## Description

Dazzle Promise is a component that provides PHP implementation of promises specification and additional promise-related concepts such as joining, mapping, reducing and cancelling promises.

## Feature Highlights

Promise features:

* Implementation of promises,
* Methods to resolve, reject or cancel promises,
* Cancellation of promises using forget semantics,
* Methods to join, map, race, reduce and do other things with set of promises,
* ...and more.

## Requirements

* PHP-5.6 or PHP-7.0+,
* UNIX or Windows OS.

## Installation

```
$> composer require dazzle-php/promise
```

## Tests

```
$> vendor/bin/phpunit -d memory_limit=1024M
```

## Contributing

Thank you for considering contributing to this repository! The contribution guide can be found in the [contribution tips][1].

## License

Dazzle Framework is open-sourced software licensed under the [MIT license][2].

[1]: https://github.com/dazzle-php/promise/blob/master/CONTRIBUTING.md
[2]: http://opensource.org/licenses/MIT
