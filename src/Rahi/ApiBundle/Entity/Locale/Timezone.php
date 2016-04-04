<?php
/**
 * Created by PhpStorm.
 * User: rahi
 * Date: 15/07/2015
 * Time: 11:26 AM
 */

namespace Rahi\ApiBundle\Entity\Locale;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Rahi\ApiBundle\Entity\AbstractEntity;

/**
 * @ORM\Entity(repositoryClass="Rahi\ApiBundle\Entity\Repository\Locale\TimezoneRepository")
 * We have to set the charset/collation on a per table basis as Doctrine doesn't provide a mechanism for setting it globally.
 * Using utf8mb4 encoding as per Symfony2 docs at http://symfony.com/doc/current/book/doctrine.html (under "Setting up the Database to be UTF8")
 * Refer to https://florian.ec/articles/mysql-doctrine-utf8/
 * @ORM\Table(name="timezone", options={"collate"="utf8mb4_unicode_ci", "charset"="utf8mb4"})
 */
class Timezone extends AbstractEntity
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
     * Refer to
     * http://www.timeanddate.com/time/time-zones.html
     * http://www.timeanddate.com/time/zones/
     * @var integer
     * @ORM\Column(type="integer", name="utc_hours_offset")
     */
    protected $utcHoursOffset;

    /**
     * Refer to http://php.net/manual/en/timezones.america.php
     * @var string
     * @ORM\Column(type="string", length=100, name="php_timezone")
     */
    protected $phpTimezone;

    /**
     * Will eventually need to add association with Region or RegionItem
     * @var string
     * @ORM\Column(type="string", length=100)
     */
    protected $location;
}
