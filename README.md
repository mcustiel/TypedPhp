# TypedPhp
Immutable Object representation for PHP primitive types and Typed Arrays in PHP.

[![Build Status](https://scrutinizer-ci.com/g/mcustiel/TypedPhp/badges/build.png?b=master)](https://scrutinizer-ci.com/g/mcustiel/TypedPhp/build-status/master)
[![Code Coverage](https://scrutinizer-ci.com/g/mcustiel/TypedPhp/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/mcustiel/TypedPhp/?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/mcustiel/TypedPhp/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/mcustiel/TypedPhp/?branch=master)

## Motivations
In PHP versions 5.5 and 5.6 type hinting is supported for classes and arrays, but not for scalar types. 
In PHP version 7, type hinting for scalar types is supported, but not typed arrays.
So I created object wrappers for scalar types that can be used in PHP 5 and also typed arrays that can be used in PHP7.
These objects can be extended to create your own ValueObjects suitable for your domain.

## Installation

### Composer
```json
"require": {
    "mcustiel/typed-php": "*"
}
```
## How to use

All wrappers implement `Primitive` interface:
```php
interface Primitive
{
    /**
     * @return mixed
     */
    public function value();
}
```
Also all of them return themselves as string, through implementation of __toString magic method. So you can echo them directly.

### Primitives

* DoubleValue
* IntegerValue
* StringValue
* BooleanValue

### Arrays:

There are two base types:

* PrimitivesArray
* ObjectsArray

#### PrimitivesArray

PrimitivesArray object allows a collection of variables an internal PHP type. And there are already three classes using it:
* DoubleArray
* IntegerArray
* StringArray
* BooleanArray

All of them are constructed with an array as argument. If there is a value in the array of a type that is not correct, an exception will be thrown.

#### ObjectsArray

This type allows a collection of instances of a given class. An example to create a type for this is as follow:

```php
use Mcustiel\TypedPhp\ValueObjects\Multiple\ObjectsArray;

clas Foo 
{
    private function bar()
    {
        echo 'I am Bar';
    }
}

class FooArray extends ObjectsArray
{
    public function __construct(array $array)
    {
        parent::__construct(Foo::class, $array);
    }
}
```
That's it, you have a type that all. In your code you can use any FooArray object as a regular array.

If there are classes that extend Foo, FooArray will allow them, so polymorphism is supported.

#### Immutable arrays

For each array type provider there is an immutable version, that allows to be created with a set of values and is not allowed to change.
* ImmutableDoubleArray
* ImmutableIntegerArray
* ImmutableStringArray
* ImmutableBooleanArray
