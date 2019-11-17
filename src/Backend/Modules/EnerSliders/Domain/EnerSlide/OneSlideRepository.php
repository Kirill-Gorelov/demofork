<?php

namespace Backend\Modules\EnerSliders\Domain\EnerSlide;

use Doctrine\ORM\EntityRepository;

class OneSlideRepository extends EntityRepository
{
    public function update()
    {
        $this->getEntityManager()->flush();
    }

    public function add(OneSlide $oneslide)
    {
        $this->getEntityManager()->persist($oneslide);
        $this->getEntityManager()->flush();
    }

    public function delete(OneSlide $oneslide): void
    {
        $this->getEntityManager()->remove($oneslide);
        $this->getEntityManager()->flush();
    }

    public function getSlideById(int $id){
        // return $this->createQueryBuilder('o')->getQuery()->getResult();
        return  $this->createQueryBuilder('c')
        ->where('c.pagesliders = :id')
        ->setParameter('id', $id)
        ->getQuery()
        ->getResult();
    }

}
