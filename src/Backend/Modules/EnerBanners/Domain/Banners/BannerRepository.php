<?php

namespace Backend\Modules\EnerBanners\Domain\Banners;

use Doctrine\ORM\EntityRepository;
// use Backend\Modules\Banners\Domain\Banners\Banner;

class BannerRepository extends EntityRepository
{
    public function update()
    {
        $this->getEntityManager()->flush();
    }

    public function add(Banner $Banner)
    {
        $this->getEntityManager()->persist($Banner);
        $this->getEntityManager()->flush();
    }

    public function delete(Banner $Banner): void
    {
        $this->getEntityManager()->remove($Banner);
        $this->getEntityManager()->flush();
    }

    public function getBanner(int $id){
        $rez = $this->createQueryBuilder('b')
        ->where('b.id = :id and b.active = 1')
        ->setParameter('id', $id)
        ->getQuery()
        ->getResult();

        if (!empty($rez)) {
            return $rez['0'];
        }
        return '';
    }

}
