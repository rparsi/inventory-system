<?php
/**
 * Created by PhpStorm.
 * User: rparsi
 * Date: 23/04/2016
 * Time: 11:19 PM
 */

namespace Rahi\ApiBundle\Entity\Account\Company;


use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;
use Rahi\ApiBundle\Entity\AbstractEntity;
use Rahi\ApiBundle\Entity\IdTrait;

/**
 * Class CompanyTree
 * @package Rahi\ApiBundle\Entity\Account\Company
 *
 * @ORM\Entity(repositoryClass="Rahi\ApiBundle\Entity\Repository\Account\Company\CompanyTreeRepository")
 * @ORM\Table(name="company_tree", options={"collate"="utf8mb4_unicode_ci", "charset"="utf8mb4"})
 *
 * @JMS\ExclusionPolicy("all")
 */
class CompanyTree extends AbstractEntity
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
     * @var Company
     *
     * @ORM\ManyToOne(targetEntity="Company", inversedBy="companyTrees")
     * @ORM\JoinColumn(name="root_company_id", referencedColumnName="id", nullable=false)
     */
    protected $rootCompany;

    /**
     * @var Company
     *
     * @ORM\ManyToOne(targetEntity="Company", inversedBy="childCompanies")
     * @ORM\JoinColumn(name="parent_company_id", referencedColumnName="id", nullable=false)
     */
    protected $parentCompany;

    /**
     * @var Company
     *
     * @ORM\ManyToOne(targetEntity="Company", inversedBy="parentCompanies")
     * @ORM\JoinColumn(name="child_company_id", referencedColumnName="id", nullable=false)
     */
    protected $childCompany;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", options={"unsigned": true, "default": 1})
     * @JMS\Expose
     */
    protected $level;

    /**
     * @return Company
     */
    public function getRootCompany()
    {
        return $this->rootCompany;
    }

    /**
     * @param Company $rootCompany
     * @return CompanyTree
     */
    public function setRootCompany(Company $rootCompany)
    {
        $this->rootCompany = $rootCompany;
        return $this;
    }

    /**
     * @return Company
     */
    public function getParentCompany()
    {
        return $this->parentCompany;
    }

    /**
     * @param Company $parentCompany
     * @return CompanyTree
     */
    public function setParentCompany(Company $parentCompany)
    {
        $this->parentCompany = $parentCompany;
        return $this;
    }

    /**
     * @return Company
     */
    public function getChildCompany()
    {
        return $this->childCompany;
    }

    /**
     * @param Company $childCompany
     * @return CompanyTree
     */
    public function setChildCompany(Company $childCompany)
    {
        $this->childCompany = $childCompany;
        return $this;
    }
}