<?php
/**
 * Created by PhpStorm.
 * User: rahi
 * Date: 02/07/2015
 * Time: 9:57 AM
 */

namespace Rahi\ApiBundle\Model;

trait SetterTrait
{
    public function __set($name, $value)
    {
        $setterMethod = 'set' . ucfirst($name);
        if (method_exists($this, $setterMethod)) {
            return $this->$setterMethod($value);
        }

        $class = get_class($this);
        if (property_exists($class, $name)) {
            $this->{$name} = $value;
            return $this;
        }

        throw new \Exception('property ' . $name . ' of ' . $class . ' does not exist');
    }
}