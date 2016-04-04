<?php
/**
 * Created by PhpStorm.
 * User: rahi
 * Date: 02/07/2015
 * Time: 10:14 AM
 */

namespace Rahi\ApiBundle\Entity\Account\Company;

use Doctrine\ORM\Mapping as ORM;
use Rahi\ApiBundle\Entity\AbstractEntity;


/**
 * @ORM\Entity(repositoryClass="Rahi\ApiBundle\Entity\Repository\Account\Company\CompanyRelationRepository")
 * @ORM\Table(name="company_relation", options={"collate"="utf8mb4_unicode_ci", "charset"="utf8mb4"})
 *
 * We have to set the charset/collation on a per table basis as Doctrine doesn't provide a mechanism for setting it globally.
 * Using utf8mb4 encoding as per Symfony2 docs at http://symfony.com/doc/current/book/doctrine.html (under "Setting up the Database to be UTF8")
 * Refer to https://florian.ec/articles/mysql-doctrine-utf8/
 */
class CompanyRelation extends AbstractEntity
{
    /**
     * @ORM\Column(type="integer", options={"unsigned": true})
     * @ORM\Id
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * @var Company
     * @ORM\ManyToOne(targetEntity="Company", inversedBy="childRelations")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id", nullable=false)
     */
    protected $parent;

    /**
     * @var Company
     * @ORM\ManyToOne(targetEntity="Company", inversedBy="parentRelations")
     * @ORM\JoinColumn(name="child_id", referencedColumnName="id", nullable=false)
     */
    protected $child;

    /**
     * @var CompanyRelationType
     * @ORM\ManyToOne(targetEntity="CompanyRelationType")
     * @ORM\JoinColumn(name="company_relation_type_id", referencedColumnName="id", nullable=false)
     */
    protected $type;

    /**
     * @param Company $company
     * @return CompanyRelation
     */
    public function setParent(Company $company)
    {
        $this->parent = $company;
        return $this;
    }

    /**
     * @param Company $child
     * @return CompanyRelation
     */
    public function setChild(Company $child)
    {
        $this->child = $child;
        return $this;
    }

    /**
     * @param CompanyRelationType $companyRelationType
     * @return CompanyRelation
     */
    public function setType(CompanyRelationType $companyRelationType)
    {
        $this->type = $companyRelationType;
        return $this;
    }
}