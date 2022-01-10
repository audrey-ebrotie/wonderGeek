<?php

namespace App\Entity;

use App\Repository\PlatformRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: PlatformRepository::class)]
class Platform
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    # @Assert\NotBlank(message="Vous devez saisir le nom de la plateforme")
    # @Assert\Length(
    #      min=2,
    #      max=50,
    #      minMessage="Le nom doit contenir au minimum {{ limit }} caractères",
    #      maxMessage="Le nom doit contenir au maximum {{ limit }} caractères"
    # )
    #[ORM\Column(type: 'string', length: 50)]
    private $name;

    #[ORM\ManyToMany(targetEntity: VideoGame::class, mappedBy: 'platform')]
    private $videoGames;

    public function __construct()
    {
        $this->videoGames = new ArrayCollection();
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

    # @return Collection|VideoGame[]
    public function getVideoGames(): Collection
    {
        return $this->videoGames;
    }

    public function addVideoGame(VideoGame $videoGame): self
    {
        if (!$this->videoGames->contains($videoGame)) {
            $this->videoGames[] = $videoGame;
            $videoGame->addPlatform($this);
        }

        return $this;
    }

    public function removeVideoGame(VideoGame $videoGame): self
    {
        if ($this->videoGames->removeElement($videoGame)) {
            $videoGame->removePlatform($this);
        }

        return $this;
    }
}
