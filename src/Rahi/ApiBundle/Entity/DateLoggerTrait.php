<?php
/**
 * Created by PhpStorm.
 * User: rahi
 * Date: 03/08/2015
 * Time: 10:32 AM
 */
namespace Rahi\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


trait DateLoggerTrait
{
    /**
     * @var \DateTime $createdDate
     *
     * @ORM\Column(type="datetime", name="created_date")
     */
    protected $createdDate;

    /**
     * @var \DateTime $modifiedDate
     *
     * @ORM\Column(type="datetime", name="modified_date", nullable=true)
     */
    protected $modifiedDate;

    /**
     * @param \DateTime $createdDate
     * @return $this
     */
    public function setCreatedDate(\DateTime $createdDate)
    {
        $this->createdDate = $createdDate;
        return $this;
    }

    /**
     * @param \DateTime $modifiedDate
     * @return $this
     */
    public function setModifiedDate(\DateTime $modifiedDate = null)
    {
        $this->modifiedDate = $modifiedDate;
        return $this;
    }
}