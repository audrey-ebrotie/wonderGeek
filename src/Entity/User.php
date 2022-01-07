<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    /**
     * @Assert\NotBlank(message="Vous devez saisir une adresse e-mail")
     * @Assert\Email(message="Vous devez saisir une adresse e-mail valide", mode="strict")
     * @ORM\Column(type="string", length=255)
     */
    #[ORM\Column(type: 'string', length: 180, unique: true)]
    private $email;

    #[ORM\Column(type: 'json')]
    private $roles = [];

    /**
     * @Assert\NotBlank(message="Vous devez saisir un mot de passe")
     * @Assert\Length(
     *      min=8,
     *      max=40,
     *      minMessage="Votre mot de passe doit contenir au minimum {{ limit }} caractères",
     *      maxMessage="Votre mot de passe doit contenir au maximum {{ limit }} caractères"
     * )
     * @Assert\Regex("/^(?=.*[A-Za-z])(?=.*\d)(?=.*?[@$!%*#?&])/", message="Votre mot de passe doit au minmum contenir un chiffre, une lettre et un caractère spécial")
     * @Assert\NotCompromisedPassword(message="Ce mot de passe a été compromis lors d'une fuite de donnée d'un autre service")
     */
    #[ORM\Column(type: 'string')]
    private $password;

    /**
     * @Assert\NotBlank(message="Vous devez saisir un nom d'utilisateur")
     * @Assert\Length(
     *      min=2,
     *      max=20,
     *      minMessage="Votre nom d'utilisateur doit contenir au minimum {{ limit }} caractères",
     *      maxMessage="Votre nom d'utilisateur doit contenir au maximum {{ limit }} caractères"
     * )
     */
    #[ORM\Column(type: 'string', length: 20)]
    private $username;

    /**
     * @Assert\NotBlank(message="Vous devez renseigner votre date de naissance")
     * @Assert\LessThanOrEqual("-13 years", message="Vous devez avoir au minimum 13 ans pour pouvoir vous inscrire")
     * @ORM\Column(type="date")
     */
    #[ORM\Column(type: 'date')]
    private $birthdate;

    #[ORM\OneToMany(mappedBy: 'owner', targetEntity: Event::class)]
    private $ownedEvents;

    #[ORM\ManyToMany(targetEntity: VideoGame::class, inversedBy: 'users')]
    private $favoriteVideoGame;

    #[ORM\ManyToMany(targetEntity: BoardGame::class, inversedBy: 'users')]
    private $favoriteBoardGame;

    #[ORM\ManyToMany(targetEntity: Manga::class, inversedBy: 'users')]
    private $favoriteManga;

    #[ORM\ManyToMany(targetEntity: Comic::class, inversedBy: 'users')]
    private $favoriteComic;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Booking::class, orphanRemoval: true)]
    private $bookings;

    public function __construct()
    {
        $this->ownedEvents = new ArrayCollection();
        $this->favoriteVideoGame = new ArrayCollection();
        $this->favoriteBoardGame = new ArrayCollection();
        $this->favoriteManga = new ArrayCollection();
        $this->favoriteComic = new ArrayCollection();
        $this->bookings = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getBirthdate(): ?\DateTimeInterface
    {
        return $this->birthdate;
    }

    public function setBirthdate(\DateTimeInterface $birthdate): self
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    /**
     * @return Collection|Event[]
     */
    public function getOwnedEvents(): Collection
    {
        return $this->ownedEvents;
    }

    public function addOwnedEvent(Event $ownedEvent): self
    {
        if (!$this->ownedEvents->contains($ownedEvent)) {
            $this->ownedEvents[] = $ownedEvent;
            $ownedEvent->setOwner($this);
        }

        return $this;
    }

    public function removeOwnedEvent(Event $ownedEvent): self
    {
        if ($this->ownedEvents->removeElement($ownedEvent)) {
            // set the owning side to null (unless already changed)
            if ($ownedEvent->getOwner() === $this) {
                $ownedEvent->setOwner(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|VideoGame[]
     */
    public function getFavoriteVideoGame(): Collection
    {
        return $this->favoriteVideoGame;
    }

    public function addFavoriteVideoGame(VideoGame $favoriteVideoGame): self
    {
        if (!$this->favoriteVideoGame->contains($favoriteVideoGame)) {
            $this->favoriteVideoGame[] = $favoriteVideoGame;
        }

        return $this;
    }

    public function removeFavoriteVideoGame(VideoGame $favoriteVideoGame): self
    {
        $this->favoriteVideoGame->removeElement($favoriteVideoGame);

        return $this;
    }

    /**
     * @return Collection|BoardGame[]
     */
    public function getFavoriteBoardGame(): Collection
    {
        return $this->favoriteBoardGame;
    }

    public function addFavoriteBoardGame(BoardGame $favoriteBoardGame): self
    {
        if (!$this->favoriteBoardGame->contains($favoriteBoardGame)) {
            $this->favoriteBoardGame[] = $favoriteBoardGame;
        }

        return $this;
    }

    public function removeFavoriteBoardGame(BoardGame $favoriteBoardGame): self
    {
        $this->favoriteBoardGame->removeElement($favoriteBoardGame);

        return $this;
    }

    /**
     * @return Collection|Manga[]
     */
    public function getFavoriteManga(): Collection
    {
        return $this->favoriteManga;
    }

    public function addFavoriteManga(Manga $favoriteManga): self
    {
        if (!$this->favoriteManga->contains($favoriteManga)) {
            $this->favoriteManga[] = $favoriteManga;
        }

        return $this;
    }

    public function removeFavoriteManga(Manga $favoriteManga): self
    {
        $this->favoriteManga->removeElement($favoriteManga);

        return $this;
    }

    /**
     * @return Collection|Comic[]
     */
    public function getFavoriteComic(): Collection
    {
        return $this->favoriteComic;
    }

    public function addFavoriteComic(Comic $favoriteComic): self
    {
        if (!$this->favoriteComic->contains($favoriteComic)) {
            $this->favoriteComic[] = $favoriteComic;
        }

        return $this;
    }

    public function removeFavoriteComic(Comic $favoriteComic): self
    {
        $this->favoriteComic->removeElement($favoriteComic);

        return $this;
    }

    /**
     * @return Collection|Booking[]
     */
    public function getBookings(): Collection
    {
        return $this->bookings;
    }

    public function addBooking(Booking $booking): self
    {
        if (!$this->bookings->contains($booking)) {
            $this->bookings[] = $booking;
            $booking->setUser($this);
        }

        return $this;
    }

    public function removeBooking(Booking $booking): self
    {
        if ($this->bookings->removeElement($booking)) {
            // set the owning side to null (unless already changed)
            if ($booking->getUser() === $this) {
                $booking->setUser(null);
            }
        }

        return $this;
    }
}
