<?php
/**
 * Created by PhpStorm.
 * User: rahi
 * Date: 14/07/2015
 * Time: 3:10 PM
 */

namespace Rahi\ApiBundle\Entity\Account\Company;

use Rahi\ApiBundle\Entity\TypeTrait;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;
use Rahi\ApiBundle\Entity\AbstractEntity;

/**
 * @ORM\Entity(repositoryClass="Rahi\ApiBundle\Entity\Repository\Account\Company\CompanyTypeRepository")
 * We have to set the charset/collation on a per table basis as Doctrine doesn't provide a mechanism for setting it globally.
 * Using utf8mb4 encoding as per Symfony2 docs at http://symfony.com/doc/current/book/doctrine.html (under "Setting up the Database to be UTF8")
 * Refer to https://florian.ec/articles/mysql-doctrine-utf8/
 * @ORM\Table(
 *      name="company_type",
 *      indexes={@ORM\Index(name="slug_idx", columns={"slug"})},
 *      options={"collate"="utf8mb4_unicode_ci", "charset"="utf8mb4"}
 * )
 *
 * @JMS\ExclusionPolicy("all")
 */
class CompanyType extends AbstractEntity
{
    use TypeTrait;
}