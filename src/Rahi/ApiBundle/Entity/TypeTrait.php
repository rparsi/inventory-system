<?php
/**
 * Created by PhpStorm.
 * User: rahi
 * Date: 03/08/2015
 * Time: 10:32 AM
 */
namespace Rahi\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;

trait TypeTrait
{
    use IdTrait;

    /**
     * @var string
     * @ORM\Column(type="string", length=100, name="name_")
     *
     * @JMS\Expose
     */
    protected $name;

    /**
     * @var string
     * @ORM\Column(type="string", length=30, name="slug")
     *
     * @JMS\Expose
     */
    protected $slug;
}