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
 * @ORM\Entity(repositoryClass="Rahi\ApiBundle\Entity\Repository\Locale\LanguageRepository")
 * We have to set the charset/collation on a per table basis as Doctrine doesn't provide a mechanism for setting it globally.
 * Using utf8mb4 encoding as per Symfony2 docs at http://symfony.com/doc/current/book/doctrine.html (under "Setting up the Database to be UTF8")
 * Refer to https://florian.ec/articles/mysql-doctrine-utf8/
 * @ORM\Table(name="language_", options={"collate"="utf8mb4_unicode_ci", "charset"="utf8mb4"})
 */
class Language extends AbstractEntity
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
     * Refer to https://en.wikipedia.org/wiki/List_of_ISO_639-1_codes
     * @var string
     * @ORM\Column(type="string", length=10, name="iso_code")
     */
    protected $isoCode;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Locale", mappedBy="language")
     */
    protected $locales;

    public function __construct()
    {
        $this->locales = new ArrayCollection();
    }

    public function addLocale(Locale $locale)
    {
        $locale->language = $this;
        $this->locales[] = $locale;
        return $this;
    }

    public function setLocales(Collection $locales)
    {
        $this->locales = $locales;
        return $this;
    }

    /**
     * Remove locale
     *
     * @param \Rahi\ApiBundle\Entity\Locale\Locale $locale
     */
    public function removeLocale(Locale $locale)
    {
        $this->locales->removeElement($locale);
    }
}