<?php
/**
 * Created by PhpStorm.
 * User: rahi
 * Date: 14/07/2015
 * Time: 5:20 PM
 */

namespace Rahi\ApiBundle\Entity\Locale\Address;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Rahi\ApiBundle\Entity\AbstractEntity;
use Rahi\ApiBundle\Entity\Locale\Country;
use Rahi\ApiBundle\Entity\Locale\Province;
use Rahi\ApiBundle\Entity\Locale\City;

/**
 * @ORM\Entity(repositoryClass="Rahi\ApiBundle\Entity\Repository\Locale\Address\AddressRepository")
 * We have to set the charset/collation on a per table basis as Doctrine doesn't provide a mechanism for setting it globally.
 * Using utf8mb4 encoding as per Symfony2 docs at http://symfony.com/doc/current/book/doctrine.html (under "Setting up the Database to be UTF8")
 * Refer to https://florian.ec/articles/mysql-doctrine-utf8/
 * @ORM\Table(name="address", options={"collate"="utf8mb4_unicode_ci", "charset"="utf8mb4"})
 */
class Address extends AbstractEntity
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
     * @ORM\Column(type="string", length=255)
     */
    protected $line1;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $line2;

    /**
     * @var AddressType
     * @ORM\ManyToOne(targetEntity="AddressType")
     * @ORM\JoinColumn(name="type_id", referencedColumnName="id", nullable=false)
     */
    protected $type;

    /**
     * @var Country
     * @ORM\ManyToOne(targetEntity="Rahi\ApiBundle\Entity\Locale\Country")
     * @ORM\JoinColumn(name="country_id", referencedColumnName="id", nullable=false)
     */
    protected $country;

    /**
     * @var Province
     * @ORM\ManyToOne(targetEntity="Rahi\ApiBundle\Entity\Locale\Province")
     * @ORM\JoinColumn(name="province_id", referencedColumnName="id", nullable=false)
     */
    protected $province;

    /**
     * @var City
     * @ORM\ManyToOne(targetEntity="Rahi\ApiBundle\Entity\Locale\City")
     * @ORM\JoinColumn(name="city_id", referencedColumnName="id", nullable=false)
     */
    protected $city;

    /**
     * @var string
     * @ORM\Column(type="string", length=30, name="postal_code")
     */
    protected $postalCode;

    public function setType(AddressType $type)
    {
        $this->type = $type;
        return $this;
    }

    public function setCountry(Country $country)
    {
        $this->country = $country;
        return $this;
    }

    public function setProvince(Province $province)
    {
        $this->province = $province;
        return $this;
    }

    public function setCity(City $city)
    {
        $this->city = $city;
        return $this;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Address
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set line1
     *
     * @param string $line1
     *
     * @return Address
     */
    public function setLine1($line1)
    {
        $this->line1 = $line1;

        return $this;
    }

    /**
     * Get line1
     *
     * @return string
     */
    public function getLine1()
    {
        return $this->line1;
    }

    /**
     * Set line2
     *
     * @param string $line2
     *
     * @return Address
     */
    public function setLine2($line2)
    {
        $this->line2 = $line2;

        return $this;
    }

    /**
     * Get line2
     *
     * @return string
     */
    public function getLine2()
    {
        return $this->line2;
    }

    /**
     * Set postalCode
     *
     * @param string $postalCode
     *
     * @return Address
     */
    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    /**
     * Get postalCode
     *
     * @return string
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * Get type
     *
     * @return \Rahi\ApiBundle\Entity\Locale\Address\AddressType
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Get country
     *
     * @return \Rahi\ApiBundle\Entity\Locale\Country
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Get province
     *
     * @return \Rahi\ApiBundle\Entity\Locale\Province
     */
    public function getProvince()
    {
        return $this->province;
    }

    /**
     * Get city
     *
     * @return \Rahi\ApiBundle\Entity\Locale\City
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Get createdDate
     *
     * @return \DateTime
     */
    public function getCreatedDate()
    {
        return $this->createdDate;
    }

    /**
     * Get modifiedDate
     *
     * @return \DateTime
     */
    public function getModifiedDate()
    {
        return $this->modifiedDate;
    }
}
