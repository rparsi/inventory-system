<?php
/**
 * Created by PhpStorm.
 * User: rahi
 * Date: 03/08/2015
 * Time: 10:32 AM
 */
namespace Rahi\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;

trait DateLoggerTrait
{
    /**
     * @var \DateTime $createdDate
     *
     * @ORM\Column(type="datetime", name="created_date")
     *
     * @JMS\Expose
     */
    protected $createdDate;

    /**
     * @var \DateTime $modifiedDate
     *
     * @ORM\Column(type="datetime", name="modified_date", nullable=true)
     *
     * @JMS\Expose
     */
    protected $modifiedDate;

    /**
     * @return \DateTime
     */
    public function getCreatedDate()
    {
        return $this->createdDate;
    }

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
     * @return \DateTime
     */
    public function getModifiedDate()
    {
        return $this->modifiedDate;
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