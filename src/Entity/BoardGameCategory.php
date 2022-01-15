<?php

namespace App\Entity;

use App\Repository\BoardGameCategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: BoardGameCategoryRepository::class)]
class BoardGameCategory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;


    #[Assert\NotBlank(message:"Vous devez saisir une catégorie de jeu de société")]
    #[Assert\Length(
        min:3,
        max:50,
        minMessage:"Le nom doit contenir au minimum {{ limit }} caractères",
        maxMessage:"Le nom doit contenir au maximum {{ limit }} caractères"
    )]
    #[ORM\Column(type: 'string', length: 50)]
    private $name;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: BoardGame::class)]
    private $boardGames;

    public function __construct()
    {
        $this->boardGames = new ArrayCollection();
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
    * @return Collection|BoardGame[]
    */

    public function getBoardGames(): Collection
    {
        return $this->boardGames;
    }

    public function addBoardGame(BoardGame $boardGame): self
    {
        if (!$this->boardGames->contains($boardGame)) {
            $this->boardGames[] = $boardGame;
            $boardGame->setCategory($this);
        }

        return $this;
    }

    public function removeBoardGame(BoardGame $boardGame): self
    {
        if ($this->boardGames->removeElement($boardGame)) {
            // set the owning side to null (unless already changed)
            if ($boardGame->getCategory() === $this) {
                $boardGame->setCategory(null);
            }
        }

        return $this;
    }
}
