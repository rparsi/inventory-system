<?php
/**
 * Created by PhpStorm.
 * User: rahi
 * Date: 02/07/2015
 * Time: 9:51 AM
 */

namespace Rahi\ApiBundle\Model;

trait GetterTrait
{
    // for getting arrays by reference you need to create an actual getter method, or use a collection object
    public function __get($name)
    {
        $getterMethod = 'get' . ucfirst($name);
        if (method_exists($this, $getterMethod)) {
            return $this->$getterMethod();
        }

        $class = get_class($this);
        if (property_exists($class, $name)) {
            return $this->{$name};
        }

        throw new \Exception('property ' . $name . ' of ' . $class . ' does not exist');
    }

    // refer to http://twig.sensiolabs.org/doc/recipes.html#using-dynamic-object-properties
    public function __isset($name)
    {
        $class = get_class($this);
        if (!property_exists($class, $name)) {
            return false;
        }
        return true;
    }
}