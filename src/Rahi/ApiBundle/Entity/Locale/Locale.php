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
 * @ORM\Entity(repositoryClass="Rahi\ApiBundle\Entity\Repository\Locale\LocaleRepository")
 * We have to set the charset/collation on a per table basis as Doctrine doesn't provide a mechanism for setting it globally.
 * Using utf8mb4 encoding as per Symfony2 docs at http://symfony.com/doc/current/book/doctrine.html (under "Setting up the Database to be UTF8")
 * Refer to https://florian.ec/articles/mysql-doctrine-utf8/
 * @ORM\Table(
 *      name="locale",
 *      options={"collate"="utf8mb4_unicode_ci", "charset"="utf8mb4"},
 *      uniqueConstraints={
 *          @ORM\UniqueConstraint(name="unique_locale_idx", columns={"language_id", "country_id"})
 *      }
 * )
 *
 * @JMS\ExclusionPolicy("all")
 */
class Locale extends AbstractEntity
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
     * Expected to be in (ISO 639-1 language code)_(ISO 3166-1 alpha-2 country code) format
     * Refer to "Translations" section in http://symfony.com/doc/current/book/translation.html
     * @var string
     * @ORM\Column(type="string", length=10, name="iso_code")
     *
     * @JMS\Expose
     */
    protected $isoCode;

    /**
     * @var Language
     * @ORM\ManyToOne(targetEntity="Language", inversedBy="locales")
     * @ORM\JoinColumn(name="language_id", referencedColumnName="id", nullable=false)
     *
     * @JMS\Expose
     */
    protected $language;

    /**
     * We could map a Locale to a Region as well
     * @var Country
     * @ORM\ManyToOne(targetEntity="Country", inversedBy="locales")
     * @ORM\JoinColumn(name="country_id", referencedColumnName="id", nullable=false)
     *
     * @JMS\Expose
     */
    protected $country;

    public function setLanguage(Language $language)
    {
        $this->language = $language;
        return $this;
    }

    public function setCountry(Country $country)
    {
        $this->country = $country;
        return $this;
    }
}