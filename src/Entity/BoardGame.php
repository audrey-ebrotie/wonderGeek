<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\BoardGameRepository;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: BoardGameRepository::class)]
class BoardGame
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 50)]
    private $name;

    
    #[Assert\NotBlank(message:"Vous devez saisir le nom du jeu")]
    #[Assert\Length(
          min:3,
          max:50,
          minMessage:"Le nom doit contenir au minimum {{ limit }} caractères",
          maxMessage:"Le nom doit contenir au maximum {{ limit }} caractères"
     )]

    #[ORM\Column(type: 'text')]
    private $description;
    
    #[Assert\NotBlank(message:"Vous devez saisir une description du jeu")]
    #[Assert\Length(
          min:10,
          max:1500,
          minMessage:"La description doit contenir au minimum {{ limit }} caractères",
          maxMessage:"La description doit contenir au maximum {{ limit }} caractères"
    )]
    #[ORM\Column(type: 'string', length: 255)]
    private $picture;

    #[Assert\Url(message:"Vous devez saisir une URL valide")]
    private $pictureUrl;

    #[Assert\Expression(
         "this.getPictureUrl() or this.getPictureFIle()",
         message:"Vous devez importer une image ou fournir une URL"
     )]
    #[Assert\File(
         maxSize:"2M",
         mimeTypes:"image/jpeg/png",
         maxSizeMessage:"Les imports sont limités à {{ limit }}{{ suffix }}",
         mimeTypesMessage:"Les imports sont limités au JPEG et PNG"
    )]
    private $pictureFile;

    #[ORM\ManyToOne(targetEntity: BoardGameCategory::class, inversedBy: 'boardGames')]
    #[ORM\JoinColumn(nullable: false)]
    private $category;

    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'favoriteBoardGame')]
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

    public function getCategory(): ?BoardGameCategory
    {
        return $this->category;
    }

    public function setCategory(?BoardGameCategory $category): self
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
            $user->addFavoriteBoardGame($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            $user->removeFavoriteBoardGame($this);
        }

        return $this;
    }
}
