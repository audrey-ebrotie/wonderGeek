<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ComicRepository;
use Symfony\Component\HttpFoundation\File\File;

#[ORM\Entity(repositoryClass: ComicRepository::class)]
class Comic
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    /**
     * @Assert\NotBlank(message="Vous devez saisir le nom du comic)
     * @Assert\Length(
     *      min=3,
     *      max=40,
     *      minMessage="Le nom doit contenir au minimum {{ limit }} caractères",
     *      maxMessage="Le nom doit contenir au maximum {{ limit }} caractères"
     * )
     */
    #[ORM\Column(type: 'string', length: 40)]
    private $name;

    #[ORM\Column(type: 'string', length: 255)]
    private $picture;

    /**
     * @Assert\Url(message="Vous devez saisir une URL valide")
     */
    private $pictureUrl;

    /**
     * @Assert\Expression(
     *     "this.getPictureUrl() or this.getPictureFIle()",
     *     message="Vous devez importer une image ou fournir une URL"
     * )
     * @Assert\File(
     *     maxSize="2M",
     *     mimeTypes={"image/jpeg", "image/png"},
     *     maxSizeMessage="Les imports sont limités à {{ limit }}{{ suffix }}",
     *     mimeTypesMessage="Les imports sont limités au JPEG et PNG"
     * )
     */
    private $pictureFile;

    #[ORM\Column(type: 'string', length: 50)]
    private $author;

    #[ORM\ManyToOne(targetEntity: ComicCategory::class, inversedBy: 'comics')]
    #[ORM\JoinColumn(nullable: false)]
    private $category;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function getPictureFile(): ?File
    {
        return $this->pictureFile;
    }

    public function setPictureFile(?File $pictureFile): self
    {
        $this->pictureFile = $pictureFile;

        return $this;
    }

    public function getPictureUrl(): ?string
    {
        return $this->pictureUrl;
    }

    public function setPictureUrl(string $pictureUrl): self
    {
        $this->pictureUrl = $pictureUrl;

        return $this;
    }
    
    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(string $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getCategory(): ?ComicCategory
    {
        return $this->category;
    }

    public function setCategory(?ComicCategory $category): self
    {
        $this->category = $category;

        return $this;
    }
}
