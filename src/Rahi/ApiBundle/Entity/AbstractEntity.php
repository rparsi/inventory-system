<?php
/**
 * Created by PhpStorm.
 * User: rahi
 * Date: 02/07/2015
 * Time: 10:15 AM
 */

namespace Rahi\ApiBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Rahi\ApiBundle\Model;

abstract class AbstractEntity
{
    use Model\GetterTrait,
        Model\SetterTrait,
        DateLoggerTrait;
}