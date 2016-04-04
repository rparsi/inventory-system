<?php
/**
 * Created by PhpStorm.
 * User: rahi
 * Date: 15/07/2015
 * Time: 11:26 AM
 */

namespace Rahi\ApiBundle\Entity\Locale;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Rahi\ApiBundle\Entity\AbstractEntity;

/**
 * @ORM\Entity(repositoryClass="Rahi\ApiBundle\Entity\Repository\Locale\ProvinceRepository")
 * We have to set the charset/collation on a per table basis as Doctrine doesn't provide a mechanism for setting it globally.
 * Using utf8mb4 encoding as per Symfony2 docs at http://symfony.com/doc/current/book/doctrine.html (under "Setting up the Database to be UTF8")
 * Refer to https://florian.ec/articles/mysql-doctrine-utf8/
 * @ORM\Table(name="province", options={"collate"="utf8mb4_unicode_ci", "charset"="utf8mb4"})
 */
class Province extends AbstractEntity
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
     * For example refer to https://en.wikipedia.org/wiki/ISO_3166-2:CA
     * @var string
     * @ORM\Column(type="string", length=10, name="iso_code")
     */
    protected $isoCode;

    /**
     * The subdivision category, ie 'province' or 'territory' for Canada
     * @var string
     * @ORM\Column(type="string", length=30)
     */
    protected $category;

    /**
     * @var Country
     * @ORM\ManyToOne(targetEntity="Country", inversedBy="provinces")
     * @ORM\JoinColumn(name="country_id", referencedColumnName="id", nullable=false)
     */
    protected $country;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="City", mappedBy="province")
     */
    protected $cities;

    public function __construct()
    {
        $this->cities = new ArrayCollection();
    }

    public function setCountry(Country $country)
    {
        $this->country = $country;
        return $this;
    }

    public function addCity(City $city)
    {
        $city->province = $this;
        $this->cities[] = $city;
        return $this;
    }

    public function setCities(Collection $cities)
    {
        $this->cities = $cities;
        return $this;
    }
}