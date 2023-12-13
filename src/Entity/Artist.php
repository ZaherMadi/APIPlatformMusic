<?php

namespace App\Entity;

use App\Repository\ArtistRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Metadata\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Entity\DTO;
use App\Entity\Dto\DetailsAlbum;

#[ORM\Entity(repositoryClass: ArtistRepository::class)]
#[ApiResource]
class Artist
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(['album:read'])]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $style = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getStyle(): ?string
    {
        return $this->style;
    }

    public function setStyle(string $style): static
    {
        $this->style = $style;

        return $this;
    }


    #[ORM\OneToMany(targetEntity: Album::class, mappedBy: "artist")]
    private $albums;

    public function __construct()
    {
        $this->albums = new ArrayCollection();
    }



    /**
     * @return Collection|Album[] 
     */
    public function getAlbums(): Collection
    {

        return $this->albums;   
    }

     public function getdetails(): array
     {
         return $this->albums->map(function ($album) {
             // Assuming AlbumDto takes parameters in its constructor to set its properties
             return new DetailsAlbum(
                 $album->getId(),
                 $album->getTitle(),
                 $album->getDate() // Make sure the date format or conversion is handled as needed
                 // Add other properties as required
             );
         })->toArray();
     }
}
