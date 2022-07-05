# attribute

PHP Attribute(Cwola library).

## Overview

Add "ReadableAttribute" and "WritableAttribute" for PHP.

## Requirement
- PHP8.0+

## Usage
- Readable
```
<?php

use Cwola\Attribute\Readable;

class Foo {
    use Readable;

    /**
     * @var string
     */
    #[Readable]
    protected string $protectedString = 'Protected';
}

class Bar extends Foo {
    /**
     * @var string
     */
    protected string $override = 'OVER RIDE!!';

    /**
     * {@inheritDoc}
     */
    private function __read(string $name): mixed {
        return $this->override;
    }
}

$foo = new Foo;
echo $foo->protectedString;  // Protected
$foo->protectedString = 'modify';  // Error

$custom = new Bar;
echo $custom->protectedString;  // OVER RIDE!!
echo $custom->override;  // Error
```

## Licence

[MIT](https://github.com/cwola/attribute/blob/main/LICENSE)
