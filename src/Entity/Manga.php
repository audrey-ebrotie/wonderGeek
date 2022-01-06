<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\MangaRepository;
use Symfony\Component\HttpFoundation\File\File;

#[ORM\Entity(repositoryClass: MangaRepository::class)]
class Manga
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    /**
     * * @Assert\NotBlank(message="Vous devez saisir un nom")
     */
    #[ORM\Column(type: 'string', length: 50)]
    private $name;

    /**
     * @Assert\NotBlank(message="Vous devez saisir une description du manga")
     * @Assert\Length(
     *      min=10,
     *      max=1500,
     *      minMessage="La description doit contenir au minimum {{ limit }} caractères",
     *      maxMessage="La description doit contenir au maximum {{ limit }} caractères"
     *)
     */
    #[ORM\Column(type: 'text')]
    private $description;

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

    #[ORM\ManyToOne(targetEntity: MangaCategory::class, inversedBy: 'mangas')]
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

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

    public function getCategory(): ?MangaCategory
    {
        return $this->category;
    }

    public function setCategory(?MangaCategory $category): self
    {
        $this->category = $category;

        return $this;
    }
}
