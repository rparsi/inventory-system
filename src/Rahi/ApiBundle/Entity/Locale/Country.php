<?php
/**
 * Created by PhpStorm.
 * User: rahi
 * Date: 15/07/2015
 * Time: 11:26 AM
 */

namespace Rahi\ApiBundle\Entity\Locale;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Rahi\ApiBundle\Entity\AbstractEntity;
use Rahi\ApiBundle\Entity\IdTrait;

/**
 * @ORM\Entity(repositoryClass="Rahi\ApiBundle\Entity\Repository\Locale\CountryRepository")
 * We have to set the charset/collation on a per table basis as Doctrine doesn't provide a mechanism for setting it globally.
 * Using utf8mb4 encoding as per Symfony2 docs at http://symfony.com/doc/current/book/doctrine.html (under "Setting up the Database to be UTF8")
 * Refer to https://florian.ec/articles/mysql-doctrine-utf8/
 * @ORM\Table(name="country", options={"collate"="utf8mb4_unicode_ci", "charset"="utf8mb4"})
 *
 * @JMS\ExclusionPolicy("all")
 */
class Country extends AbstractEntity
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
     * Refer to https://en.wikipedia.org/wiki/ISO_3166-1#Current_codes
     * @var string
     * @ORM\Column(type="string", length=5)
     *
     * @JMS\Expose
     */
    protected $alpha2Code;

    /**
     * @var string
     * @ORM\Column(type="string", length=5)
     *
     * @JMS\Expose
     */
    protected $alpha3Code;

    /**
     * @var string
     * @ORM\Column(type="smallint", options={"unsigned": true})
     *
     * @JMS\Expose
     */
    protected $numericCode;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Province", mappedBy="country", indexBy="id")
     *
     * @JMS\Expose
     */
    protected $provinces;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Locale", mappedBy="country", indexBy="id")
     *
     * @JMS\Expose
     */
    protected $locales;

    public function __construct()
    {
        $this->provinces = new ArrayCollection();
        $this->locales = new ArrayCollection();
    }

    public function addProvince(Province $province)
    {
        $province->country = $this;
        $this->provinces[] = $province;
        return $this;
    }

    public function setProvinces(Collection $provinces)
    {
        $this->provinces = $provinces;
        return $this;
    }

    public function addLocale(Locale $locale)
    {
        $locale->country = $this;
        $this->locales[] = $locale;
        return $this;
    }

    public function setLocales(Collection $locales)
    {
        $this->locales = $locales;
        return $this;
    }
}