<?php

namespace App\Entity;

use App\Repository\LivresRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LivresRepository::class)]
class Livres
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'Id_Livre')]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $ISBN = null;

    #[ORM\Column(length: 100)]
    private ?string $Titre_livre = null;

    #[ORM\Column(length: 50)]
    private ?string $Theme_livre = null;

    #[ORM\Column(type: Types::BIGINT)]
    private ?string $Nbr_pages_livre = null;

    #[ORM\Column(length: 50)]
    private ?string $Format_livre = null;

    #[ORM\Column(length: 100)]
    private ?string $Nom_auteur = null;

    #[ORM\Column(length: 100)]
    private ?string $Prenom_auteur = null;

    #[ORM\Column(length: 100)]
    private ?string $Editeur = null;

    #[ORM\Column(type: Types::BIGINT)]
    private ?string $Annee_edition = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 6, scale: 2)]
    private ?string $Prix_vente = null;

    #[ORM\Column(length: 50)]
    private ?string $Langue_livre = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getISBN(): ?string
    {
        return $this->ISBN;
    }

    public function setISBN(string $ISBN): static
    {
        $this->ISBN = $ISBN;

        return $this;
    }

    public function getTitreLivre(): ?string
    {
        return $this->Titre_livre;
    }

    public function setTitreLivre(string $Titre_livre): static
    {
        $this->Titre_livre = $Titre_livre;

        return $this;
    }

    public function getThemeLivre(): ?string
    {
        return $this->Theme_livre;
    }

    public function setThemeLivre(string $Theme_livre): static
    {
        $this->Theme_livre = $Theme_livre;

        return $this;
    }

    public function getNbrPagesLivre(): ?string
    {
        return $this->Nbr_pages_livre;
    }

    public function setNbrPagesLivre(string $Nbr_pages_livre): static
    {
        $this->Nbr_pages_livre = $Nbr_pages_livre;

        return $this;
    }

    public function getFormatLivre(): ?string
    {
        return $this->Format_livre;
    }

    public function setFormatLivre(string $Format_livre): static
    {
        $this->Format_livre = $Format_livre;

        return $this;
    }

    public function getNomAuteur(): ?string
    {
        return $this->Nom_auteur;
    }

    public function setNomAuteur(string $Nom_auteur): static
    {
        $this->Nom_auteur = $Nom_auteur;

        return $this;
    }

    public function getPrenomAuteur(): ?string
    {
        return $this->Prenom_auteur;
    }

    public function setPrenomAuteur(string $Prenom_auteur): static
    {
        $this->Prenom_auteur = $Prenom_auteur;

        return $this;
    }

    public function getEditeur(): ?string
    {
        return $this->Editeur;
    }

    public function setEditeur(string $Editeur): static
    {
        $this->Editeur = $Editeur;

        return $this;
    }

    public function getAnneeEdition(): ?string
    {
        return $this->Annee_edition;
    }

    public function setAnneeEdition(string $Annee_edition): static
    {
        $this->Annee_edition = $Annee_edition;

        return $this;
    }

    public function getPrixVente(): ?string
    {
        return $this->Prix_vente;
    }

    public function setPrixVente(string $Prix_vente): static
    {
        $this->Prix_vente = $Prix_vente;

        return $this;
    }

    public function getLangueLivre(): ?string
    {
        return $this->Langue_livre;
    }

    public function setLangueLivre(string $Langue_livre): static
    {
        $this->Langue_livre = $Langue_livre;

        return $this;
    }
}
