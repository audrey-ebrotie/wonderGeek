<?php

namespace App\Entity;

use App\Repository\MangaCategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: MangaCategoryRepository::class)]
class MangaCategory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[Assert\NotBlank(message:"Vous devez saisir une catégorie de manga")]
    #[Assert\Length(
        min:3,
        max:50,
        minMessage:"Le nom doit contenir au minimum {{ limit }} caractères",
        maxMessage:"Le nom doit contenir au maximum {{ limit }} caractères"
    )]
    #[ORM\Column(type: 'string', length: 50)]
    private $name;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: Manga::class)]
    private $mangas;

    public function __construct()
    {
        $this->mangas = new ArrayCollection();
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
    /** 
    * @return Collection|Manga[]
    */
    public function getMangas(): Collection
    {
        return $this->mangas;
    }

    public function addManga(Manga $manga): self
    {
        if (!$this->mangas->contains($manga)) {
            $this->mangas[] = $manga;
            $manga->setCategory($this);
        }

        return $this;
    }

    public function removeManga(Manga $manga): self
    {
        if ($this->mangas->removeElement($manga)) {
            // set the owning side to null (unless already changed)
            if ($manga->getCategory() === $this) {
                $manga->setCategory(null);
            }
        }

        return $this;
    }
}
