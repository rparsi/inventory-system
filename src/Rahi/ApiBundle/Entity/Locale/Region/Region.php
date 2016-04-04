<?php
/**
 * Created by PhpStorm.
 * User: rahi
 * Date: 15/07/2015
 * Time: 6:08 PM
 */

namespace Rahi\ApiBundle\Entity\Locale\Region;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Rahi\ApiBundle\Entity\AbstractEntity;

/**
 * @ORM\Entity(repositoryClass="Rahi\ApiBundle\Entity\Repository\Locale\Region\RegionRepository")
 * We have to set the charset/collation on a per table basis as Doctrine doesn't provide a mechanism for setting it globally.
 * Using utf8mb4 encoding as per Symfony2 docs at http://symfony.com/doc/current/book/doctrine.html (under "Setting up the Database to be UTF8")
 * Refer to https://florian.ec/articles/mysql-doctrine-utf8/
 * @ORM\Table(name="region", options={"collate"="utf8mb4_unicode_ci", "charset"="utf8mb4"})
 */
class Region extends AbstractEntity
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
     * @var RegionItem
     * @ORM\OneToMany(targetEntity="RegionItem", mappedBy="parentRegion")
     */
    protected $items;

    public function __construct()
    {
        $this->items = new ArrayCollection();
    }

    public function addItem(RegionItem $item)
    {
        $item->parentRegion = $this;
        $this->items[] = $item;
        return $this;
    }

    public function setItems(Collection $items)
    {
        $this->items = $items;
        return $this;
    }

    /**
     * Remove item
     *
     * @param \Rahi\ApiBundle\Entity\Locale\Region\RegionItem $item
     */
    public function removeItem(RegionItem $item)
    {
        $this->items->removeElement($item);
    }
}