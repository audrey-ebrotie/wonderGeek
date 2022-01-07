<?php

namespace App\Entity;

use App\Repository\ComicRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
    #[ORM\Column(type: 'string', length: 50)]
    private $name;

    /**
     * @Assert\NotBlank(message="Vous devez saisir une description du comic")
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

    /**
     * * @Assert\NotBlank(message="Vous devez saisir un auteur")
     */
    #[ORM\Column(type: 'string', length: 50)]
    private $author;

    #[ORM\ManyToOne(targetEntity: ComicCategory::class, inversedBy: 'comics')]
    #[ORM\JoinColumn(nullable: false)]
    private $category;

    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'favoriteComic')]
    private $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

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

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->addFavoriteComic($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            $user->removeFavoriteComic($this);
        }

        return $this;
    }
}
