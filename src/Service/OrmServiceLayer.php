<?php

namespace PSchwisow\ContainerCoding\Service;

use Doctrine\ORM\EntityManager;

class OrmServiceLayer
{
    /**
     * Entity manager
     *
     * @var EntityManager
     */
    protected $em;

    /**
     * Sets entity manager for service
     *
     * @param EntityManager $em entity manager
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * Insert entity operation
     *
     * @param string $entityName entity name
     * @param array  $data       data to insert
     * @return mixed
     */
    public function insert($entityName, array $data)
    {
        $entity = new $entityName();
        foreach ($data as $key => $value) {
            if (method_exists($entity, 'set' . $key)) {
                $entity->{'set' . $key}($value);
                continue;
            }
        }
        if (method_exists($entity, 'isValid') && !$entity->isValid()) {
            throw new \DomainException("Invalid data for {$entity}");
        }
        $this->em->persist($entity);
        $this->em->flush();
        return $entity;
    }

    /**
     * Insert entity operation
     *
     * @param array  $data       data to insert
     * @return mixed
     */
    public function insertProduct(array $data)
    {
        if (!empty($data['brand_id'])) {
            $data['Brand'] = $this->find('PSchwisow\ContainerCoding\Entity\Brand', $data['brand_id']);
        }
        return $this->insert('Entity\Product', $data);
    }

    /**
     * Update entity operation
     *
     * @param string $entityName entity name
     * @param string $id         entity id
     * @param array  $data       updated data
     * @throws \InvalidArgumentException
     * @return mixed
     */
    public function update($entityName, $id, array $data)
    {
        $entity = $this->em->find($entityName, $id);
        if (is_null($entity)) {
            throw new \InvalidArgumentException("$entityName with id " . $id . ' for update not found');
        }
        foreach ($data as $key => $value) {
            if (method_exists($entity, 'set' . $key)) {
                $entity->{'set' . $key}($value);
                continue;
            }
        }
        if (method_exists($entity, 'isValid') && !$entity->isValid()) {
            throw new \DomainException("Invalid data for {$entity}");
        }
        $this->em->flush();
        return $entity;
    }

    /**
     * Get entity by primary key
     *
     * @param string $entityName entity name
     * @param string $id         entity id
     * @return mixed
     */
    public function find($entityName, $id)
    {
        $entity = $this->em->find($entityName, $id);
        return $entity;
    }

    /**
     * Gets repository for given entity
     *
     * @param string $entityName entity name
     * @return \Doctrine\ORM\EntityRepository
     */
    public function getRepository($entityName)
    {
        return $this->em->getRepository($entityName);
    }

    /**
     * Gets brand options
     *
     * @return array
     */
    public function getBrandOptions()
    {
        $brands = $this->em->getRepository('PSchwisow\ContainerCoding\Entity\Brand')->findAll();
        $out = array();
        foreach ($brands as $brand) {
            /** @var \PSchwisow\ContainerCoding\Entity\Brand $brand */
            $out[$brand->getBrandId()] = $brand->getName();
        }
        return $out;
    }
}
