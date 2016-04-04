<?php
/**
 * Created by PhpStorm.
 * User: rahi
 * Date: 02/07/2015
 * Time: 10:14 AM
 */

namespace Rahi\ApiBundle\Entity\Account;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Rahi\ApiBundle\Model;
use FOS\UserBundle\Model\User as BaseUser;
use Symfony\Component\Validator\Constraints as Assert;
use Rahi\ApiBundle\Entity\DateLoggerTrait;
use Rahi\ApiBundle\Entity\Account\Company\Company;
use Rahi\ApiBundle\Entity\Account\PhoneNumber\PhoneNumber;
use Rahi\ApiBundle\Entity\Locale\Locale;
use Rahi\ApiBundle\Entity\Locale\Address\Address;
use Rahi\ApiBundle\Entity\Locale\Timezone;

/**
 * @ORM\Entity(repositoryClass="Rahi\ApiBundle\Entity\Repository\Account\UserRepository")
 * We have to set the charset/collation on a per table basis as Doctrine doesn't provide a mechanism for setting it globally.
 * Using utf8mb4 encoding as per Symfony2 docs at http://symfony.com/doc/current/book/doctrine.html (under "Setting up the Database to be UTF8")
 * Refer to https://florian.ec/articles/mysql-doctrine-utf8/
 * @ORM\Table(name="fos_user", options={"collate"="utf8mb4_unicode_ci", "charset"="utf8mb4"})
 */
class User extends BaseUser
{
    use Model\GetterTrait,
        Model\SetterTrait,
        DateLoggerTrait;

    /**
     * @ORM\Column(type="integer", options={"unsigned": true})
     * @ORM\Id
     * @ORM\GeneratedValue
     */
    protected $id;

    // FOSUserBundle 1.3.6 has the following properties, refer to https://github.com/FriendsOfSymfony/FOSUserBundle/blob/1.3.x/Model/User.php
    // Canonical fields get lowercased before comparison or search � to make sure there are no duplicates with the same value but with different case.
    /*
    string
    protected $username;

    string
    protected $usernameCanonical;

    string
    protected $email;

    string
    protected $emailCanonical;

    boolean
    protected $enabled;

    The salt to use for hashing
    string
    protected $salt;

    Encrypted password. Must be persisted.
    string
    protected $password;
    FOSUserBundle uses mysql reserved word 'password' as the column name

    Plain password. Used for model validation. Must not be persisted.
    string
    protected $plainPassword;

    \DateTime
    protected $lastLogin;

    Random string sent to the user email address in order to verify it
    string
    protected $confirmationToken;

    \DateTime
    protected $passwordRequestedAt;

    Collection
    protected $groups;

    boolean
    protected $locked;

    boolean
    protected $expired;

    \DateTime
    protected $expiresAt;

    array
    protected $roles;

    boolean
    protected $credentialsExpired;

    \DateTime
    protected $credentialsExpireAt;
    */

    // following are custom ATS properties
    /**
     * May have to make this an entity later
     * @var string
     * @ORM\Column(type="string", length=10)
     *
     * @Assert\NotBlank(message="Salutation.", groups={"Registration", "Profile"})
     * @Assert\Length(
     *     min=2,
     *     max=10,
     *     minMessage="Salutation is too short.",
     *     maxMessage="Salutation is too long.",
     *     groups={"Registration", "Profile"}
     * )
     */
    protected $salutation;

    /**
     * @var string
     * @ORM\Column(type="string", length=100, name="first_name")
     *
     * @Assert\NotBlank(message="First name.", groups={"Registration", "Profile"})
     * @Assert\Length(
     *     min=3,
     *     max=100,
     *     minMessage="First name is too short.",
     *     maxMessage="First name is too long.",
     *     groups={"Registration", "Profile"}
     * )
     */
    protected $firstName;

    /**
     * @var string
     * @ORM\Column(type="string", length=100, name="last_name")
     *
     * @Assert\NotBlank(message="Last name.", groups={"Registration", "Profile"})
     * @Assert\Length(
     *     min=3,
     *     max=100,
     *     minMessage="Last name is too short.",
     *     maxMessage="Last name is too long.",
     *     groups={"Registration", "Profile"}
     * )
     */
    protected $lastName;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime", name="registered_date", nullable=true)
     */
    protected $registeredDate;

    /**
     * @var ArrayCollection
     * @ORM\ManyToMany(targetEntity="Rahi\ApiBundle\Entity\Account\Company\Company", inversedBy="users")
     * @ORM\JoinTable(name="users_companies")
     */
    protected $companies;

    /**
     * @var PhoneNumber
     * @ORM\ManyToOne(targetEntity="Rahi\ApiBundle\Entity\Account\PhoneNumber\PhoneNumber")
     * @ORM\JoinColumn(name="number_id", referencedColumnName="id", nullable=true)
     */
    protected $mainNumber;

    /**
     * @var ArrayCollection
     * @ORM\ManyToMany(targetEntity="Rahi\ApiBundle\Entity\Account\PhoneNumber\PhoneNumber")
     * @ORM\JoinTable(name="users_numbers",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="number_id", referencedColumnName="id")}
     *      )
     */
    protected $phoneNumbers;

    /**
     * @var ArrayCollection
     * @ORM\ManyToMany(targetEntity="EmailAddress")
     * @ORM\JoinTable(name="users_email_addresses",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
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
     * @ORM\JoinTable(name="users_addresses",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="address_id", referencedColumnName="id")}
     *      )
     */
    protected $addresses;

    /**
     * @var string
     * @ORM\Column(type="string", length=10, name="iso_locale", nullable=true)
     */
    protected $isoLocale;

    /**
     * @var Locale
     * @ORM\ManyToOne(targetEntity="Rahi\ApiBundle\Entity\Locale\Locale")
     * @ORM\JoinColumn(name="locale_id", referencedColumnName="id", nullable=true)
     */
    protected $locale;

    /**
     * @var string
     * @ORM\Column(type="string", length=50, name="iso_timezone", nullable=true)
     */
    protected $isoTimezone;

    /**
     * @var Timezone
     * @ORM\ManyToOne(targetEntity="Rahi\ApiBundle\Entity\Locale\Timezone")
     * @ORM\JoinColumn(name="timezone_id", referencedColumnName="id", nullable=true)
     */
    protected $timezone;

    public function __construct()
    {
        parent::__construct();
        $this->companies = new ArrayCollection();
        $this->phoneNumbers = new ArrayCollection();
        $this->emailAddresses = new ArrayCollection();
        $this->addresses = new ArrayCollection();
    }

    public function setCompanies(Collection $companies)
    {
        $this->companies = $companies;
        return $this;
    }

    public function addCompany(Company $company)
    {
        $this->companies[] = $company;
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

    public function setDefaultValues()
    {
        $now = new \DateTime();
        $this->registeredDate = $now;
        $this->createdDate = $now;
        $this->modifiedDate = null;
        $this->roles = $this->getDefaultRoles();
        return $this;
    }

    public function getDefaultRoles()
    {
        return ['ROLE_USER'];
    }

    /**
     * Set registeredDate
     *
     * @param \DateTime $registeredDate
     *
     * @return User
     */
    public function setRegisteredDate($registeredDate)
    {
        $this->registeredDate = $registeredDate;

        return $this;
    }

    /**
     * Remove company
     *
     * @param \Rahi\ApiBundle\Entity\Account\Company\Company $company
     */
    public function removeCompany(Company $company)
    {
        $this->companies->removeElement($company);
    }

    /**
     * Set mainNumber
     *
     * @param \Rahi\ApiBundle\Entity\Account\PhoneNumber\PhoneNumber $mainNumber
     *
     * @return User
     */
    public function setMainNumber(PhoneNumber $mainNumber = null)
    {
        $this->mainNumber = $mainNumber;

        return $this;
    }

    /**
     * Remove phoneNumber
     *
     * @param \Rahi\ApiBundle\Entity\Account\PhoneNumber\PhoneNumber $phoneNumber
     */
    public function removePhoneNumber(PhoneNumber $phoneNumber)
    {
        $this->phoneNumbers->removeElement($phoneNumber);
    }

    /**
     * Remove emailAddress
     *
     * @param \Rahi\ApiBundle\Entity\Account\EmailAddress $emailAddress
     */
    public function removeEmailAddress(EmailAddress $emailAddress)
    {
        $this->emailAddresses->removeElement($emailAddress);
    }

    /**
     * Set mainAddress
     *
     * @param \Rahi\ApiBundle\Entity\Locale\Address\Address $mainAddress
     *
     * @return User
     */
    public function setMainAddress(Address $mainAddress = null)
    {
        $this->mainAddress = $mainAddress;

        return $this;
    }

    /**
     * Remove address
     *
     * @param \Rahi\ApiBundle\Entity\Locale\Address\Address $address
     */
    public function removeAddress(Address $address)
    {
        $this->addresses->removeElement($address);
    }

    /**
     * Set locale
     *
     * @param \Rahi\ApiBundle\Entity\Locale\Locale $locale
     *
     * @return User
     */
    public function setLocale(Locale $locale = null)
    {
        $this->locale = $locale;

        return $this;
    }

    /**
     * Set timezone
     *
     * @param \Rahi\ApiBundle\Entity\Locale\Timezone $timezone
     *
     * @return User
     */
    public function setTimezone(Timezone $timezone = null)
    {
        $this->timezone = $timezone;

        return $this;
    }
}