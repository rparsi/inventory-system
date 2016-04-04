<?php
/**
 * Created by PhpStorm.
 * User: rahi
 * Date: 14/07/2015
 * Time: 5:20 PM
 */

namespace Rahi\ApiBundle\Entity\Account\PhoneNumber;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Rahi\ApiBundle\Entity\AbstractEntity;

/**
 * @ORM\Entity(repositoryClass="Rahi\ApiBundle\Entity\Repository\Account\PhoneNumber\PhoneNumberRepository")
 * We have to set the charset/collation on a per table basis as Doctrine doesn't provide a mechanism for setting it globally.
 * Using utf8mb4 encoding as per Symfony2 docs at http://symfony.com/doc/current/book/doctrine.html (under "Setting up the Database to be UTF8")
 * Refer to https://florian.ec/articles/mysql-doctrine-utf8/
 * @ORM\Table(name="phone_number", options={"collate"="utf8mb4_unicode_ci", "charset"="utf8mb4"})
 */
class PhoneNumber extends AbstractEntity
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
     * May need to add association to a locale
     * @var string
     * @ORM\Column(type="string", length=10, name="country_code")
     */
    protected $countryCode;

    /**
     * @var integer
     * @ORM\Column(type="integer", name="area_code", options={"unsigned": true})
     */
    protected $areaCode;

    /**
     * ie 456-7890
     * @var string
     * @ORM\Column(type="string", name="number_", length=30)
     */
    protected $number;

    /**
     * @var string
     * @ORM\Column(type="string", name="extension", length=30)
     */
    protected $extension;

    /**
     * @var PhoneNumberType
     * @ORM\ManyToOne(targetEntity="PhoneNumberType")
     * @ORM\JoinColumn(name="type_id", referencedColumnName="id")
     */
    protected $type;

    public function setType(PhoneNumberType $type)
    {
        $this->type = $type;
        return $this;
    }
}