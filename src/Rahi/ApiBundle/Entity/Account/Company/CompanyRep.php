<?php
/**
 * Created by PhpStorm.
 * User: rparsi
 * Date: 23/04/2016
 * Time: 3:40 PM
 */

namespace Rahi\ApiBundle\Entity\Account\Company;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;
use Rahi\ApiBundle\Entity\AbstractEntity;
use Rahi\ApiBundle\Entity\Account\User;
use Rahi\ApiBundle\Entity\IdTrait;

/**
 * Class CompanyRep
 * @package Rahi\ApiBundle\Entity\Account\Company
 *
 * @ORM\Entity(repositoryClass="Rahi\ApiBundle\Entity\Repository\Account\Company\CompanyRepRepository")
 * @ORM\Table(name="company_rep", options={"collate"="utf8mb4_unicode_ci", "charset"="utf8mb4"})
 *
 * @JMS\ExclusionPolicy("all")
 */
class CompanyRep extends AbstractEntity
{
    use IdTrait;

    /**
     * @var Company
     *
     * @ORM\ManyToOne(targetEntity="Company", inversedBy="repClients")
     * @ORM\JoinColumn(name="company_id", referencedColumnName="id", nullable=false)
     */
    protected $company;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="Rahi\ApiBundle\Entity\Account\User", inversedBy="repClients")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=true)
     */
    protected $user;

    /**
     * @var Company
     *
     * @ORM\ManyToOne(targetEntity="Company", inversedBy="repClientsOf")
     * @ORM\JoinColumn(name="client_company_id", referencedColumnName="id", nullable=false)
     */
    protected $clientCompany;

    /**
     * @var Company
     *
     * @ORM\ManyToOne(targetEntity="Rahi\ApiBundle\Entity\Account\User", inversedBy="repClientsOf")
     * @ORM\JoinColumn(name="client_user_id", referencedColumnName="id", nullable=true)
     */
    protected $clientUser;

    /**
     * @return Company
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @param Company $company
     * @return CompanyRep
     */
    public function setCompany(Company $company)
    {
        $this->company = $company;
        return $this;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param User $user
     * @return CompanyRep
     */
    public function setUser(User $user = null)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return Company
     */
    public function getClientCompany()
    {
        return $this->clientCompany;
    }

    /**
     * @param Company $clientCompany
     * @return CompanyRep
     */
    public function setClientCompany(Company $clientCompany)
    {
        $this->clientCompany = $clientCompany;
        return $this;
    }

    /**
     * @return User
     */
    public function getClientUser()
    {
        return $this->clientUser;
    }

    /**
     * @param User $clientUser
     * @return CompanyRep
     */
    public function setClientUser(User $clientUser = null)
    {
        $this->clientUser = $clientUser;
        return $this;
    }
}