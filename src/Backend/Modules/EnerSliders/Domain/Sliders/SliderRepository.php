<?php

namespace Backend\Modules\EnerSliders\Domain\Sliders;

use Doctrine\ORM\EntityRepository;
use Backend\Modules\EnerSliders\Domain\Sliders\Slider;

class SliderRepository extends EntityRepository
{
    public function update()
    {
        $this->getEntityManager()->flush();
    }

    public function add(Slider $slider)
    {
        $this->getEntityManager()->persist($slider);
        $this->getEntityManager()->flush();
    }

    public function delete(Slider $slider): void
    {
        $this->getEntityManager()->remove($slider);
        $this->getEntityManager()->flush();
    }

    public function getSlider(int $id){
        $rez = $this->createQueryBuilder('b')
        ->where('b.id = :id and b.active = 1 and b.date_views < :now')
        // ->setMaxResults(1)
        ->setParameter('id', $id)
        ->setParameter('now', new \DateTime('now'))
        ->getQuery()
        ->getResult();

        if (!empty($rez)) {
            $rez = $rez[0]; //TODO: или ????
            return $rez;
        }

        return '';
    }

}
