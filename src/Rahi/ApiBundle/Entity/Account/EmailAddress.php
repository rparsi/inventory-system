<?php
/**
 * Created by PhpStorm.
 * User: rahi
 * Date: 14/07/2015
 * Time: 5:20 PM
 */

namespace Rahi\ApiBundle\Entity\Account;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Rahi\ApiBundle\Entity\AbstractEntity;

/**
 * @ORM\Entity(repositoryClass="Rahi\ApiBundle\Entity\Repository\Account\EmailAddressRepository")
 * We have to set the charset/collation on a per table basis as Doctrine doesn't provide a mechanism for setting it globally.
 * Using utf8mb4 encoding as per Symfony2 docs at http://symfony.com/doc/current/book/doctrine.html (under "Setting up the Database to be UTF8")
 * Refer to https://florian.ec/articles/mysql-doctrine-utf8/
 * @ORM\Table(name="email_address", options={"collate"="utf8mb4_unicode_ci", "charset"="utf8mb4"})
 */
class EmailAddress extends AbstractEntity
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
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    protected $email;
}