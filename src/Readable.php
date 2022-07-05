<?php

declare(strict_types=1);

namespace Cwola\Attribute;

use Attribute;
use Exception;
use ReflectionException;
use ReflectionProperty;

#[Attribute]
trait Readable {

    /**
     * @param string $propertyName
     *
     * @return bool
     *
     * @throws \ReflectionException
     */
    public function __isReadable(string $propertyName) :bool {
        // @thrown ReflectionException
        $reflection = new ReflectionProperty($this, $propertyName);
        $attr = $reflection->getAttributes(__TRAIT__);
        return \count($attr) > 0;
    }

    /**
     * @param string $name
     *
     * @return mixed
     *
     * @throws \Exception
     */
    public function __get(string $name) :mixed {
        try {
            if ($this->__isReadable($name)) {
                return $this->__read($name);
            } else {
                throw new Exception("Property '${name}' is not readable.");
            }
        } catch (ReflectionException $reflectionException) {
            throw new Exception($reflectionException->getMessage());
        }
    }

    /**
     * @param string $name
     *
     * @return mixed
     */
    private function __read(string $name) :mixed {
        return $this->$name;
    }
}
