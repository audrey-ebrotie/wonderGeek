<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\EventRepository;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use App\Entity\EventActivity;

#[ORM\Entity(repositoryClass: EventRepository::class)]
class Event
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[Assert\NotBlank(message : "Vous devez saisir un nom pour l'événement")]
    #[Assert\Length(
        min : 3,
        max : 100,
        minMessage : "Le nom doit au minimum contenir {{ limit }} caractères",
        maxMessage : "Le nom doit contenir au maximum {{ limit }} caractères" )]

    #[ORM\Column(type: 'string', length: 100)]
    private $name;

    #[Assert\NotBlank(message : "Vous devez saisir une description pour l'événement")]
    #[Assert\Length(
        min : 10,
        max : 1500,
        minMessage : "La description doit au minimum contenir {{ limit }} caractères",
        maxMessage : "La description doit contenir au maximum {{ limit }} caractères"
        )]
    #[ORM\Column(type: 'text')]
    private $description;

    #[ORM\Column(type: 'string', length: 255)]
    private $picture;

    #[Assert\NotBlank(message : "Vous devez saisir une date de début")]
    #[Assert\GreaterThan("now", message : "Vous devez saisir une date de début supérieure à la date actuelle")]
    #[ORM\Column(type: 'datetime')]
    private $startAt;

    #[Assert\NotBlank(message : "Vous devez saisir une date de fin")]
    #[Assert\GreaterThan(propertyPath : "startAt", message : "Vous devez saisir une date de fin supérieure à la date de début")]
    #[ORM\Column(type: 'datetime')]
    private $endAt;

    #[Assert\Positive(message : "Vous devez saisir un nombre de places positif ou laisser le champ vide pour ne pas imposer de limite")]
    #[ORM\Column(type: 'integer', nullable: true)]
    private $capacity;

    #[Assert\NotBlank(message : "Vous devez renseigner une catégorie pour l'évènement")]
    #[ORM\ManyToOne(targetEntity: EventCategory::class, inversedBy: 'events')]
    #[ORM\JoinColumn(nullable: false)]
    private $category;

    #[ORM\ManyToOne(targetEntity: Place::class, inversedBy: 'events')]
    private $place;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'ownedEvents')]
    #[ORM\JoinColumn(nullable: false)]
    private $owner;

    #[ORM\OneToMany(mappedBy: 'event', targetEntity: Booking::class, orphanRemoval: true)]
    private $bookings;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private $gameLevel;

    #[Assert\NotBlank(message : "Vous devez renseigner le type d'activité")]
    #[ORM\ManyToOne(targetEntity: EventActivity::class, inversedBy: 'events')]
    #[ORM\JoinColumn(nullable: false)]
    private $activity;

    public function __construct()
    {
        $this->bookings = new ArrayCollection();
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

    public function getStartAt(): ?\DateTimeInterface
    {
        return $this->startAt;
    }

    public function setStartAt(?\DateTimeInterface $startAt): self
    {
        $this->startAt = $startAt;

        return $this;
    }

    public function getEndAt(): ?\DateTimeInterface
    {
        return $this->endAt;
    }

    public function setEndAt(?\DateTimeInterface $endAt): self
    {
        $this->endAt = $endAt;

        return $this;
    }

    public function getCapacity(): ?int
    {
        return $this->capacity;
    }

    public function setCapacity(?int $capacity): self
    {
        $this->capacity = $capacity;

        return $this;
    }

    public function getCategory(): ?EventCategory
    {
        return $this->category;
    }

    public function setCategory(?EventCategory $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getPlace(): ?Place
    {
        return $this->place;
    }

    public function setPlace(?Place $place): self
    {
        $this->place = $place;

        return $this;
    }

    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(?User $owner): self
    {
        $this->owner = $owner;

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
            $booking->setEvent($this);
        }

        return $this;
    }

    public function removeBooking(Booking $booking): self
    {
        if ($this->bookings->removeElement($booking)) {
            
            if ($booking->getEvent() === $this) {
                $booking->setEvent(null);
            }
        }

        return $this;
    }

    public function getGameLevel(): ?string
    {
        return $this->gameLevel;
    }

    public function setGameLevel(?string $gameLevel): self
    {
        $this->gameLevel = $gameLevel;

        return $this;
    }

    public function getActivity(): ?EventActivity
    {
        return $this->activity;
    }

    public function setActivity(?EventActivity $activity): self
    {
        $this->activity = $activity;

        return $this;
    }
}
