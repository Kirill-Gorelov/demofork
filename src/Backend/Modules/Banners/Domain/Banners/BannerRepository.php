<?php

namespace Backend\Modules\Banners\Domain\Banners;

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

    public function getUrl(string $url): string
    {
        return $url;
    }

    public function getAllBanner(){
        return $this->createQueryBuilder('o')->getQuery()->getResult();
    }

}
