<?php
/**
 * Created by PhpStorm.
 * User: rahi
 * Date: 02/07/2015
 * Time: 10:14 AM
 */

namespace Rahi\ApiBundle\Entity\Account\Company;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Rahi\ApiBundle\Entity\AbstractEntity;
use Rahi\ApiBundle\Entity\Locale\Address\Address;
use Rahi\ApiBundle\Entity\Account\User;
use Rahi\ApiBundle\Entity\Account\PhoneNumber\PhoneNumber;
use Rahi\ApiBundle\Entity\Account\EmailAddress;

/**
 * @ORM\Entity(repositoryClass="Rahi\ApiBundle\Entity\Repository\Account\Company\CompanyRepository")
 * @ORM\Table(name="company", options={"collate"="utf8mb4_unicode_ci", "charset"="utf8mb4"})
 *
 * We have to set the charset/collation on a per table basis as Doctrine doesn't provide a mechanism for setting it globally.
 * Using utf8mb4 encoding as per Symfony2 docs at http://symfony.com/doc/current/book/doctrine.html (under "Setting up the Database to be UTF8")
 * Refer to https://florian.ec/articles/mysql-doctrine-utf8/
 */
class Company extends AbstractEntity
{
    /**
     * @ORM\Column(type="integer", options={"unsigned": true})
     * @ORM\Id
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * @var ArrayCollection
     * @ORM\ManyToMany(targetEntity="CompanyType", indexBy="id")
     * @ORM\JoinTable(name="companies_types",
     *      joinColumns={@ORM\JoinColumn(name="company_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="type_id", referencedColumnName="id")}
     *      )
     */
    protected $types;

    /**
     * @var CompanyStatus
     * @ORM\ManyToOne(targetEntity="CompanyStatus")
     * @ORM\JoinColumn(name="status_id", referencedColumnName="id", nullable=false)
     */
    protected $status;

    /**
     * @var string
     * @ORM\Column(type="string", length=100, name="name_")
     */
    protected $name;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime", name="registered_date")
     */
    protected $registeredDate;

    /**
     * @var Company
     * @ORM\OneToMany(targetEntity="CompanyRelation", mappedBy="child")
     */
    protected $parentRelations;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="CompanyRelation", mappedBy="parent")
     */
    protected $childRelations;

    /**
     * @var ArrayCollection
     * @ORM\ManyToMany(targetEntity="Rahi\ApiBundle\Entity\Account\User", mappedBy="companies")
     */
    protected $users;

    /**
     * @var PhoneNumber
     * @ORM\ManyToOne(targetEntity="Rahi\ApiBundle\Entity\Account\PhoneNumber\PhoneNumber")
     * @ORM\JoinColumn(name="number_id", referencedColumnName="id", nullable=true)
     */
    protected $mainNumber;

    /**
     * @var ArrayCollection
     * @ORM\ManyToMany(targetEntity="Rahi\ApiBundle\Entity\Account\PhoneNumber\PhoneNumber")
     * @ORM\JoinTable(name="companies_numbers",
     *      joinColumns={@ORM\JoinColumn(name="company_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="number_id", referencedColumnName="id")}
     *      )
     */
    protected $phoneNumbers;

    /**
     * @var EmailAddress
     * @ORM\ManyToOne(targetEntity="Rahi\ApiBundle\Entity\Account\EmailAddress")
     * @ORM\JoinColumn(name="email_address_id", referencedColumnName="id", nullable=true)
     */
    protected $mainEmailAddress;

    /**
     * @var ArrayCollection
     * @ORM\ManyToMany(targetEntity="Rahi\ApiBundle\Entity\Account\EmailAddress")
     * @ORM\JoinTable(name="companies_email_addresses",
     *      joinColumns={@ORM\JoinColumn(name="company_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="email_address_id", referencedColumnName="id")}
     *      )
     */
    protected $emailAddresses;

    /**
     * @var Address
     * @ORM\ManyToOne(targetEntity="Rahi\ApiBundle\Entity\Locale\Address\Address")
     * @ORM\JoinColumn(name="address_id", referencedColumnName="id", nullable=true)
     */
    protected $mainAddress;

    /**
     * @var ArrayCollection
     * @ORM\ManyToMany(targetEntity="Rahi\ApiBundle\Entity\Locale\Address\Address")
     * @ORM\JoinTable(name="companies_addresses",
     *      joinColumns={@ORM\JoinColumn(name="company_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="address_id", referencedColumnName="id")}
     *      )
     */
    protected $addresses;

    public function __construct()
    {
        $this->types = new ArrayCollection();
        $this->parentRelations = new ArrayCollection();
        $this->childRelations = new ArrayCollection();
        $this->users = new ArrayCollection();
        $this->phoneNumbers = new ArrayCollection();
        $this->emailAddresses = new ArrayCollection();
        $this->addresses = new ArrayCollection();
    }

    public function addType(CompanyType $companyType)
    {
        $this->types[] = $companyType;
        return $this;
    }

    public function setTypes(Collection $types)
    {
        $this->types = $types;
        return $this;
    }

    public function setStatus(CompanyStatus $status)
    {
        $this->status = $status;
        return $this;
    }

    public function setRegisteredDate(\DateTime $registeredDate)
    {
        $this->registeredDate = $registeredDate;
        return $this;
    }

    public function addParentRelation(CompanyRelation $parentRelation)
    {
        $parentRelation->setChild($this);
        $this->parentRelations[] = $parentRelation;
        return $this;
    }

    public function addChildRelation(CompanyRelation $childRelation)
    {
        $childRelation->setParent($this);
        $this->childRelations[] = $childRelation;
        return $this;
    }

    public function addUser(User $user)
    {
        $this->users[] = $user;
        return $this;
    }

    public function setUsers(Collection $users)
    {
        $this->users = $users;
        return $this;
    }

    public function addPhoneNumber(PhoneNumber $number)
    {
        $this->phoneNumbers[] = $number;
        return $this;
    }

    public function setPhoneNumbers(Collection $phoneNumbers)
    {
        $this->phoneNumbers = $phoneNumbers;
        return $this;
    }

    public function addEmailAddress(EmailAddress $emailAddress)
    {
        $this->emailAddresses[] = $emailAddress;
        return $this;
    }

    public function setEmailAddresses(Collection $emailAddresses)
    {
        $this->emailAddresses = $emailAddresses;
        return $this;
    }

    public function addAddress(Address $address)
    {
        $this->addresses[] = $address;
        return $this;
    }

    public function setAddresses(Collection $addresses)
    {
        $this->addresses = $addresses;
        return $this;
    }
}