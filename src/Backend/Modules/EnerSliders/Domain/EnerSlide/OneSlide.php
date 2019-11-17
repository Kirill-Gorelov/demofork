<?php
namespace Backend\Modules\EnerSliders\Domain\EnerSlide;

use Doctrine\ORM\Mapping as ORM;
use Backend\Core\Engine\Authentication;
use Common\Doctrine\Entity\Meta;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 *
 * @ORM\Table(name="sliders_oneslide")
 * @ORM\Entity(repositoryClass="Backend\Modules\EnerSliders\Domain\OneSlide\OneSlideRepository")
 */

class OneSlide
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
     * @ORM\Column(type="text", nullable=true)
     */
    private $description = '';


    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private $image = '';

    /**
     * @var Pagesliders
     *
     * @ORM\ManyToOne(
     *     targetEntity="Backend\Modules\EnerSliders\Domain\Pagesliders\Pagesliders",
     *     inversedBy="oneslide"
     * )
     * @ORM\JoinColumn(
     *     name="oneslide_id",
     *     referencedColumnName="id",
     *     onDelete="cascade"
     * )
     */
    private $pagesliders;

    /**
     * @var Product
     *
     * @ORM\ManyToOne(
     *     targetEntity="Backend\Modules\EnerSliders\Domain\Products\Product",
     *     inversedBy="oneslidep"
     * )
     * @ORM\JoinColumn(
     *     name="oneslidep_id",
     *     referencedColumnName="id",
     *     onDelete="cascade"
     * )
     */
    private $product;

    /**
     * @var Amenties
     *
     * @ORM\ManyToOne(
     *     targetEntity="Backend\Modules\EnerSliders\Domain\Ament\Amenties",
     *     inversedBy="oneslidea"
     * )
     * @ORM\JoinColumn(
     *     name="oneslidea_id",
     *     referencedColumnName="id",
     *     onDelete="cascade"
     * )
     */
    private $amenties;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
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

    public function getPagesliders()
    {
        return $this->pagesliders;
    }

    public function setPagesliders($pagesliders)
    {
        $this->pagesliders = $pagesliders;
    }

    public function getProduct()
    {
        return $this->product;
    }

    public function setProduct($product)
    {
        $this->product = $product;
    }

    public function getAmenties()
    {
        return $this->amenties;
    }

    public function setAmenties( $amenties)
    {
        $this->amenties = $amenties;
    }

}
