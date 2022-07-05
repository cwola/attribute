<?php

declare(strict_types=1);

namespace Cwola\Attribute;

use Attribute;
use Exception;
use ReflectionException;
use ReflectionProperty;

#[Attribute]
trait Writable {

    /**
     * @param string $propertyName
     *
     * @return bool
     *
     * @throws \ReflectionException
     */
    public function __isWritable(string $propertyName) :bool {
        // @thrown ReflectionException
        $reflection = new ReflectionProperty($this, $propertyName);
        $attr = $reflection->getAttributes(__TRAIT__);
        return \count($attr) > 0;
    }

    /**
     * @param string $name
     * @param mixed $value
     *
     * @return void
     *
     * @throws \Exception
     */
    public function __set(string $name, mixed $value) :void {
        try {
            if ($this->__isWritable($name)) {
                $this->__write($name, $value);
            } else {
                throw new Exception("Property '${name}' is not writable.");
            }
        } catch (ReflectionException $reflectionException) {
            throw new Exception($reflectionException->getMessage());
        }
    }

    /**
     * @param string $name
     * @param mixed $value
     *
     * @return void
     */
    private function __write(string $name, mixed $value) :void {
        $this->$name = $value;
    }
}
