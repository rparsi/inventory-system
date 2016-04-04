<?php
/**
 * Created by PhpStorm.
 * User: rahi
 * Date: 03/08/2015
 * Time: 10:32 AM
 */
namespace Rahi\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

trait TypeTrait
{
    /**
     * @ORM\Column(type="integer", options={"unsigned": true})
     * @ORM\Id
     * @ORM\GeneratedValue
     */
    protected $id;
    /**
     * @var string
     * @ORM\Column(type="string", length=100, name="name_")
     */
    protected $name;
    /**
     * @var string
     * @ORM\Column(type="string", length=30, name="slug")
     */
    protected $slug;
}