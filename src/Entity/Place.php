<?php

namespace App\Entity;

use App\Repository\PlaceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlaceRepository::class)]
class Place
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    /**
     * * @Assert\NotBlank(message="Vous devez saisir le nom du lieu")
     */
    #[ORM\Column(type: 'string', length: 50)]
    private $name;

    /**
     * * @Assert\NotBlank(message="Vous devez saisir la rue")
     */
    #[ORM\Column(type: 'string', length: 120)]
    private $street;

    /**
     * 
     * @Assert\NotBlank(message="Vous devez saisir le code postal")
     */
    #[ORM\Column(type: 'string', length: 12)]
    private $zipcode;

    /**
    * @Assert\NotBlank(message="Vous devez saisir la ville")
     */
    #[ORM\Column(type: 'string', length: 60)]
    private $city;

    /**
    * @Assert\NotBlank(message="Vous devez saisir le pays")
     */
    #[ORM\Column(type: 'string', length: 50)]
    private $country;

    #[ORM\OneToMany(mappedBy: 'place', targetEntity: Event::class)]
    private $events;

    public function __construct()
    {
        $this->events = new ArrayCollection();
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

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(string $street): self
    {
        $this->street = $street;

        return $this;
    }

    public function getZipcode(): ?string
    {
        return $this->zipcode;
    }

    public function setZipcode(string $zipcode): self
    {
        $this->zipcode = $zipcode;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @return Collection|Event[]
     */
    public function getEvents(): Collection
    {
        return $this->events;
    }

    public function addEvent(Event $event): self
    {
        if (!$this->events->contains($event)) {
            $this->events[] = $event;
            $event->setPlace($this);
        }

        return $this;
    }

    public function removeEvent(Event $event): self
    {
        if ($this->events->removeElement($event)) {
            // set the owning side to null (unless already changed)
            if ($event->getPlace() === $this) {
                $event->setPlace(null);
            }
        }

        return $this;
    }
}
