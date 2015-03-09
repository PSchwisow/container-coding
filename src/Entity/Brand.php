<?php

namespace PSchwisow\ContainerCoding\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Brand domain entity
 *
 * @ORM\Table(name="brand")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class Brand
{
    /**
     * Primary id
     *
     * @var integer brandId
     *
     * @ORM\Column(name="brand_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $brandId;

    /**
     * Brand name
     *
     * @var string $name
     *
     * @ORM\Column(name="name", type="string")
     */
    protected $name;

    /**
     * Updated at time
     *
     * @var \DateTime updatedAt
     *
     * @ORM\Column(name="updated_at", type="datetime")
     */
    protected $updatedAt;

    /**
     * Get brandId
     *
     * @return integer $brandId
     */
    public function getBrandId()
    {
        return $this->brandId;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return void
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime|string $updatedAt - user last update
     * @return void
     */
    public function setUpdatedAt($updatedAt)
    {
        if (is_string($updatedAt)) {
            $this->updatedAt = new \DateTime($updatedAt);
        } else {
            $this->updatedAt = $updatedAt;
        }
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime $updatedAt - user last update
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Automatically set updatedAt for new entity
     *
     * @ORM\PrePersist
     */
    public function onPrePersist()
    {
        $this->setUpdatedAt('now');
    }

    /**
     * Automatically set updatedAt for updated entity
     *
     * @ORM\PreUpdate
     */
    public function onPreUpdate()
    {
        $this->setUpdatedAt('now');
    }
}
