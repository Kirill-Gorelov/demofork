<?php
namespace Backend\Modules\Banners\Domain\Banners;

use Doctrine\ORM\Mapping as ORM;
use Backend\Core\Engine\Authentication;
// use Doctrine\Common\Collections\ArrayCollection;
// use Doctrine\Common\Collections\Collection;

/**
 *
 * @ORM\Table(name="banners")
 * @ORM\Entity(repositoryClass="Backend\Modules\Banners\Domain\Banners\BannerRepository")
 */

class Banner
{
    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue()
     */
    private $id = 0;

    /**
     * @var string
     *
     * @ORM\Column(type="string", name="title")
     */
    private $title;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", name="sort", nullable=true)
     */
    private $sort;


    /**
     * @var string
     *
     * @ORM\Column(type="string", name="link", nullable=true)
     */
    private $link;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $description = '';


    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean", options={"default" = false})
     */
    private $active = false;


    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private $image = '';

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active;
    }

    /**
     * @param bool $active
     */
    public function setActive(bool $active): void
    {
        $this->active = $active;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return (string)$this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return integer
     */
    public function getSort()
    {
        return (int)$this->sort;
    }

    /**
     * @param integer $sort
     */
    public function setSort(int $sort): void
    {
        $this->sort = $sort;
    }

    /**
     * @return string
     */
    public function getLink()
    {
        return (string)$this->link;
    }

    /**
     * @param string $link
     */
    public function setLink(string $link): void
    {
        $this->link = $link;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return (string)$this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }


    /**
     * @return string
     */
    public function getImage(): string
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    //public function setImage(string $image): void
    public function setImage($image): void
    {
        if(!$image){
            $image = '';
        }
        $this->image = $image;
    }

}
