<?php
/**
 * Created by PhpStorm.
 * User: rahi
 * Date: 02/07/2015
 * Time: 10:14 AM
 */

namespace Rahi\ApiBundle\Entity\Account\Company;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Rahi\ApiBundle\Entity\AbstractEntity;
use Rahi\ApiBundle\Entity\IdTrait;
use Rahi\ApiBundle\Entity\Locale\Address\Address;
use Rahi\ApiBundle\Entity\Account\User;
use Rahi\ApiBundle\Entity\Account\PhoneNumber\PhoneNumber;
use Rahi\ApiBundle\Entity\Account\EmailAddress;

/**
 * @ORM\Entity(repositoryClass="Rahi\ApiBundle\Entity\Repository\Account\Company\CompanyRepository")
 * @ORM\Table(name="company", options={"collate"="utf8mb4_unicode_ci", "charset"="utf8mb4"})
 *
 * @JMS\ExclusionPolicy("all")
 *
 * We have to set the charset/collation on a per table basis as Doctrine doesn't provide a mechanism for setting it globally.
 * Using utf8mb4 encoding as per Symfony2 docs at http://symfony.com/doc/current/book/doctrine.html (under "Setting up the Database to be UTF8")
 * Refer to https://florian.ec/articles/mysql-doctrine-utf8/
 */
class Company extends AbstractEntity
{
    use IdTrait;

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
     * @var ArrayCollection
     * @ORM\ManyToMany(targetEntity="Rahi\ApiBundle\Entity\Account\User", mappedBy="companies", indexBy="id")
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
     * @ORM\ManyToMany(targetEntity="Rahi\ApiBundle\Entity\Account\PhoneNumber\PhoneNumber", indexBy="id")
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
     * @ORM\ManyToMany(targetEntity="Rahi\ApiBundle\Entity\Account\EmailAddress", indexBy="id")
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
     * @ORM\ManyToMany(targetEntity="Rahi\ApiBundle\Entity\Locale\Address\Address", indexBy="id")
     * @ORM\JoinTable(name="companies_addresses",
     *      joinColumns={@ORM\JoinColumn(name="company_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="address_id", referencedColumnName="id")}
     *      )
     */
    protected $addresses;

    /**
     * $this represents other companies via CompanyRep
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="CompanyRep", mappedBy="company", indexBy="id")
     */
    protected $repClients;

    /**
     * $this is represented by other companies vai CompanyRep
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="CompanyRep", mappedBy="clientCompany", indexBy="id")
     */
    protected $repClientsOf;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="CompanyTree", mappedBy="rootCompany", indexBy="id")
     */
    protected $companyTrees;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="CompanyTree", mappedBy="childCompany", indexBy="id")
     */
    protected $parentCompanies;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="CompanyTree", mappedBy="parentCompany", indexBy="id")
     */
    protected $childCompanies;

    public function __construct()
    {
        $this->types = new ArrayCollection();
        $this->users = new ArrayCollection();
        $this->phoneNumbers = new ArrayCollection();
        $this->emailAddresses = new ArrayCollection();
        $this->addresses = new ArrayCollection();
        $this->repClients = new ArrayCollection();
        $this->repClientsOf = new ArrayCollection();
        $this->companyTrees = new ArrayCollection();
        $this->childCompanies = new ArrayCollection();
        $this->parentCompanies = new ArrayCollection();
    }

    /**
     * @param CompanyType $companyType
     * @return Company
     */
    public function addType(CompanyType $companyType)
    {
        $this->types[] = $companyType;
        return $this;
    }

    /**
     * @param Collection $types
     * @return Company
     */
    public function setTypes(Collection $types)
    {
        $this->types = $types;
        return $this;
    }

    /**
     * @param CompanyStatus $status
     * @return Company
     */
    public function setStatus(CompanyStatus $status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @param \DateTime $registeredDate
     * @return Company
     */
    public function setRegisteredDate(\DateTime $registeredDate)
    {
        $this->registeredDate = $registeredDate;
        return $this;
    }

    /**
     * @param User $user
     * @return Company
     */
    public function addUser(User $user)
    {
        $this->users[] = $user;
        return $this;
    }

    /**
     * @param Collection $users
     * @return Company
     */
    public function setUsers(Collection $users)
    {
        $this->users = $users;
        return $this;
    }

    /**
     * @param PhoneNumber $number
     * @return Company
     */
    public function addPhoneNumber(PhoneNumber $number)
    {
        $this->phoneNumbers[] = $number;
        return $this;
    }

    /**
     * @param Collection $phoneNumbers
     * @return Company
     */
    public function setPhoneNumbers(Collection $phoneNumbers)
    {
        $this->phoneNumbers = $phoneNumbers;
        return $this;
    }

    /**
     * @param EmailAddress $emailAddress
     * @return Company
     */
    public function addEmailAddress(EmailAddress $emailAddress)
    {
        $this->emailAddresses[] = $emailAddress;
        return $this;
    }

    /**
     * @param Collection $emailAddresses
     * @return Company
     */
    public function setEmailAddresses(Collection $emailAddresses)
    {
        $this->emailAddresses = $emailAddresses;
        return $this;
    }

    /**
     * @param Address $address
     * @return Company
     */
    public function addAddress(Address $address)
    {
        $this->addresses[] = $address;
        return $this;
    }

    /**
     * @param Collection $addresses
     * @return Company
     */
    public function setAddresses(Collection $addresses)
    {
        $this->addresses = $addresses;
        return $this;
    }

    /**
     * @param CompanyRep $repClient
     * @return Company
     */
    public function addRepClient(CompanyRep $repClient)
    {
        $repClient->setCompany($this);
        $this->repClients[] = $repClient;
        return $this;
    }

    /**
     * @param Collection $repClients
     * @return Company
     */
    public function setRepClients(Collection $repClients)
    {
        $this->repClients = $repClients;
        return $this;
    }

    /**
     * @param CompanyRep $repClientOf
     * @return Company
     */
    public function addRepClientOf(CompanyRep $repClientOf)
    {
        $repClientOf->setClientCompany($this);
        $this->repClientsOf[] = $repClientOf;
        return $this;
    }

    /**
     * @param Collection $repClientsOf
     * @return Company
     */
    public function setRepClientsOf(Collection $repClientsOf)
    {
        $this->repClientsOf = $repClientsOf;
        return $this;
    }

    /**
     * @param CompanyTree $companyTree
     * @return Company
     */
    public function addCompanyTree(CompanyTree $companyTree)
    {
        $companyTree->setRootCompany($this);
        $this->companyTrees[] = $companyTree;
        return $this;
    }

    /**
     * @param Collection $companyTrees
     * @return Company
     */
    public function setCompanyTrees(Collection $companyTrees)
    {
        $this->companyTrees = $companyTrees;
        return $this;
    }

    /**
     * @param CompanyTree $companyTree
     * @return Company
     */
    public function addParentCompany(CompanyTree $companyTree)
    {
        $companyTree->setChildCompany($this);
        $this->parentCompanies[] = $companyTree;
        return $this;
    }

    /**
     * @param Collection $parentCompanies
     * @return Company
     */
    public function setParentCompanies(Collection $parentCompanies)
    {
        $this->parentCompanies = $parentCompanies;
        return $this;
    }

    /**
     * @param CompanyTree $companyTree
     * @return Company
     */
    public function addChildCompany(CompanyTree $companyTree)
    {
        $companyTree->setParentCompany($this);
        $this->childCompanies[] = $companyTree;
        return $this;
    }

    /**
     * @param Collection $childCompanies
     * @return Company
     */
    public function setChildCompanies(Collection $childCompanies)
    {
        $this->childCompanies = $childCompanies;
        return $this;
    }
}