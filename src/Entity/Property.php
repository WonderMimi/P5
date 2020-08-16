<?php

namespace App\Entity;

use App\Repository\PropertyRepository;
use Doctrine\ORM\Mapping as ORM;
use Cocur\Slugify\Slugify;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=PropertyRepository::class)
 * @Vich\Uploadable
 */
class Property
{
	const HEAT = [
		0 => 'électrique',
		1 => 'gaz',
		2 => 'fioul',
		3 => 'chauffage par le sol',
		4 => 'bois'
	];

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

	/**
	 * @ORM\Column(type="string")
	 * @var string|null
	 */
    private $filename;

	/**
	 * @Vich\UploadableField(mapping="property_image", fileNameProperty="filename")
	 * @Assert\Image(mimeTypes="image/jpeg")    // User can only upload .jpeg files
	 * @var File|null
	 */
    private $imageFile;

    /**
     * @ORM\Column(type="string", length=255)
	 * @Assert\Length(
	 *     min=15,
	 *     minMessage="Le titre doit avoir au moins 15 caractères.",
	 *     max=150,
	 *     maxMessage="Votre titre est trop long. Il ne doit pas dépasser 150 caractères"
	 * )
     */
    private $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
	 * @Assert\Range(min=10, max=400)
     */
    private $surface;

    /**
     * @ORM\Column(type="integer")
     */
    private $rooms;

    /**
     * @ORM\Column(type="integer")
     */
    private $bedrooms;

    /**
     * @ORM\Column(type="integer")
	 * @Assert\Range(max=20)
	 */
    private $floor;

    /**
     * @ORM\Column(type="integer")
     */
    private $price;

    /**
     * @ORM\Column(type="integer")
     */
    private $heat;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $postal_code;

    /**
     * @ORM\Column(type="boolean", options={"default": false})
     */
    private $sold = false;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updated_at;

    /**
     * @ORM\Column(type="float", scale=4, precision=6)
     */
    private $lat;

    /**
     * @ORM\Column(type="float", scale=4, precision=7)
     */
    private $lng;

    public function __construct()
	{
		$this->created_at = new \DateTime();
	}

	public function getId(): ?int
   {
	   return $this->id;
   }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

	/**
	 * @return string
	 */
    public function getSlug(): string
	{
		$slugify = new Slugify();
		$slug = $slugify->slugify($this->title);
		return $slug;
	}

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getSurface(): ?int
    {
        return $this->surface;
    }

    public function setSurface(int $surface): self
    {
        $this->surface = $surface;

        return $this;
    }

    public function getRooms(): ?int
    {
        return $this->rooms;
    }

    public function setRooms(int $rooms): self
    {
        $this->rooms = $rooms;

        return $this;
    }

    public function getBedrooms(): ?int
    {
        return $this->bedrooms;
    }

    public function setBedrooms(int $bedrooms): self
    {
        $this->bedrooms = $bedrooms;

        return $this;
    }

    public function getFloor(): ?int
    {
        return $this->floor;
    }

    public function setFloor(int $floor): self
    {
        $this->floor = $floor;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getHeat(): ?int
    {
        return $this->heat;
    }

    public function setHeat(int $heat): self
    {
        $this->heat = $heat;

        return $this;
    }

	public function getHeatType()
	{
		return self::HEAT [$this->heat];

	}

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getPostalCode(): ?string
    {
        return $this->postal_code;
    }

    public function setPostalCode(string $postal_code): self
    {
        $this->postal_code = $postal_code;

        return $this;
    }

    public function getSold(): ?bool
    {
        return $this->sold;
    }

    public function setSold(bool $sold): self
    {
        $this->sold = $sold;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

	/**
	 * @return string|null
	 */
	public function getFilename(): ?string
	{
		return $this->filename;
	}

	/**
	 * @param string|null $filename
	 * @return Property
	 */
	public function setFilename(?string $filename): Property
	{
		$this->filename = $filename;
		return $this;
	}

	/**
	 * @return \Symfony\Component\HttpFoundation\File\File|null
	 */
	public function getImageFile()
	{
		return $this->imageFile;
	}

	/**
	 * @param \Symfony\Component\HttpFoundation\File\File $imageFile
	 * @return Property
	 */
	public function setImageFile(File $imageFile): Property
	{
		$this->imageFile = $imageFile;

		if ($this->imageFile instanceof UploadedFile) {  //this condition checks if an image has been uploaded and update the updated_at field so it is taken into account (know issue)
			$this->updated_at = new \DateTime('now');
		}
		return $this;
	}

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    public function getLat(): ?float
    {
        return $this->lat;
    }

    public function setLat(float $lat): self
    {
        $this->lat = $lat;

        return $this;
    }

    public function getLng(): ?float
    {
        return $this->lng;
    }

    public function setLng(float $lng): self
    {
        $this->lng = $lng;

        return $this;
    }

}
