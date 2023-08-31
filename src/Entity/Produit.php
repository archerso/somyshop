<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ProduitRepository::class)]
class Produit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\Length(min:5, max: 50, minMessage: "Pas assez de caractère , il faut au moins {{ limit }} caractères")]
    #[Assert\NotBlank(message: 'Ce champ ne peut pas être vide')]
    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[Assert\NotBlank(message: 'Ce champ ne peut pas être vide')]
    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[Assert\NotBlank(message: 'Ce champ ne peut pas être vide')]
    #[ORM\Column(length: 50)]
    private ?string $couleur = null;

    #[Assert\NotBlank(message: 'Ce champ ne peut pas être vide')]
    #[ORM\Column(length: 50)]
    private ?string $taille = null;

    #[Assert\NotBlank(message: 'Ce champ ne peut pas être vide')]
    #[ORM\Column(length: 255)]
    private ?string $collection = null;

    #[Assert\NotBlank(message: 'Ce champ ne peut pas être vide')]
    #[ORM\Column(length: 255)]
    private ?string $photo = null;

    #[Assert\NotBlank(message: 'Ce champ ne peut pas être vide')]
    #[ORM\Column]
    private ?int $prix = null;

    #[Assert\NotBlank(message: 'Ce champ ne peut pas être vide')]
    #[ORM\Column]
    private ?int $stock = null;

    #[Assert\NotBlank(message: 'Ce champ ne peut pas être vide')]
    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_enregistrement = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getCouleur(): ?string
    {
        return $this->couleur;
    }

    public function setCouleur(string $couleur): static
    {
        $this->couleur = $couleur;

        return $this;
    }

    public function getTaille(): ?string
    {
        return $this->taille;
    }

    public function setTaille(string $taille): static
    {
        $this->taille = $taille;

        return $this;
    }

    public function getCollection(): ?string
    {
        return $this->collection;
    }

    public function setCollection(string $collection): static
    {
        $this->collection = $collection;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(string $photo): static
    {
        $this->photo = $photo;

        return $this;
    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): static
    {
        $this->prix = $prix;

        return $this;
    }

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(int $stock): static
    {
        $this->stock = $stock;

        return $this;
    }

    public function getDateEnregistrement(): ?\DateTimeInterface
    {
        return $this->date_enregistrement;
    }

    public function setDateEnregistrement(\DateTimeInterface $date_enregistrement): static
    {
        $this->date_enregistrement = $date_enregistrement;

        return $this;
    }
}
