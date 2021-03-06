<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\VideoGameRepository;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: VideoGameRepository::class)]
class VideoGame
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[Assert\NotBlank(message:"Vous devez saisir le nom du jeu")]
    #[Assert\Length(
        min:3,
        max:50,
        minMessage:"Le nom doit contenir au minimum {{ limit }} caractères",
        maxMessage:"Le nom doit contenir au maximum {{ limit }} caractères"
    )]
    #[ORM\Column(type: 'string', length: 50)]
    private $name;

    #[Assert\NotBlank(message:"Vous devez saisir une description du jeu")]
    #[Assert\Length(
        min:10,
        max:1500,
        minMessage:"La description doit contenir au minimum {{ limit }} caractères",
        maxMessage:"La description doit contenir au maximum {{ limit }} caractères"
    )]
    #[ORM\Column(type: 'text')]
    private $description;

    #[ORM\Column(type: 'string', length: 255)]
    private $picture;

    #[Assert\Url(message:"Vous devez saisir une URL valide")]
    private $pictureUrl;

    // #[Assert\Expression(
    //     "this.getPictureUrl() or this.getPictureFIle()",
    //     message:"Vous devez importer une image ou fournir une URL"
    // )]
    #[Assert\File(
        maxSize:"2M",
        mimeTypes:"image/jpeg/png",
        maxSizeMessage:"Les imports sont limités à {{ limit }}{{ suffix }}",
        mimeTypesMessage:"Les imports sont limités au JPEG et PNG"
    )]
    private $pictureFile;

    #[ORM\ManyToMany(targetEntity: Platform::class, inversedBy: 'videoGames')]
    private $platform;

    #[ORM\ManyToOne(targetEntity: VideoGameCategory::class, inversedBy: 'videoGames')]
    #[ORM\JoinColumn(nullable: false)]
    private $category;

    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'favoriteVideoGame')]
    private $users;

    public function __construct()
    {
        $this->platform = new ArrayCollection();
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
    /** 
    * @return Collection|Platform[]
    */
    public function getPlatform(): Collection
    {
        return $this->platform;
    }

    public function addPlatform(Platform $platform): self
    {
        if (!$this->platform->contains($platform)) {
            $this->platform[] = $platform;
        }

        return $this;
    }

    public function removePlatform(Platform $platform): self
    {
        $this->platform->removeElement($platform);

        return $this;
    }

    public function getCategory(): ?VideoGameCategory
    {
        return $this->category;
    }

    public function setCategory(?VideoGameCategory $category): self
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
            $user->addFavoriteVideoGame($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            $user->removeFavoriteVideoGame($this);
        }

        return $this;
    }
}
