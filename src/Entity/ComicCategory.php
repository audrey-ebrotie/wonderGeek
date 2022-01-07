<?php

namespace App\Entity;

use App\Repository\ComicCategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ComicCategoryRepository::class)]
class ComicCategory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    /**
     * @Assert\NotBlank(message="Vous devez saisir une catégorie de comic")
     * @Assert\Length(
     *      min=3,
     *      max=50,
     *      minMessage="Le nom doit contenir au minimum {{ limit }} caractères",
     *      maxMessage="Le nom doit contenir au maximum {{ limit }} caractères"
     * )
     */
    #[ORM\Column(type: 'string', length: 50)]
    private $name;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: Comic::class)]
    private $comics;

    public function __construct()
    {
        $this->comics = new ArrayCollection();
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
     * @return Collection|Comic[]
     */
    public function getComics(): Collection
    {
        return $this->comics;
    }

    public function addComic(Comic $comic): self
    {
        if (!$this->comics->contains($comic)) {
            $this->comics[] = $comic;
            $comic->setCategory($this);
        }

        return $this;
    }

    public function removeComic(Comic $comic): self
    {
        if ($this->comics->removeElement($comic)) {
            // set the owning side to null (unless already changed)
            if ($comic->getCategory() === $this) {
                $comic->setCategory(null);
            }
        }

        return $this;
    }
}
