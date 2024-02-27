<?php

namespace App\Entity;

use App\Repository\FournisseursRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FournisseursRepository::class)]
class Fournisseurs
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column( name:'Id_fournisseur')]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $Code_fournisseur = null;

    #[ORM\Column(length: 50)]
    private ?string $Raison_sociale = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $Rue_fournisseur = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $Code_postal = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $Localite = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $Pays = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $Tel_fournisseur = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $Url_fournisseur = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $Email_fournisseur = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $Fax_fournisseur = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodeFournisseur(): ?string
    {
        return $this->Code_fournisseur;
    }

    public function setCodeFournisseur(string $Code_fournisseur): static
    {
        $this->Code_fournisseur = $Code_fournisseur;

        return $this;
    }

    public function getRaisonSociale(): ?string
    {
        return $this->Raison_sociale;
    }

    public function setRaisonSociale(string $Raison_sociale): static
    {
        $this->Raison_sociale = $Raison_sociale;

        return $this;
    }

    public function getRueFournisseur(): ?string
    {
        return $this->Rue_fournisseur;
    }

    public function setRueFournisseur(?string $Rue_fournisseur): static
    {
        $this->Rue_fournisseur = $Rue_fournisseur;

        return $this;
    }

    public function getCodePostal(): ?string
    {
        return $this->Code_postal;
    }

    public function setCodePostal(?string $Code_postal): static
    {
        $this->Code_postal = $Code_postal;

        return $this;
    }

    public function getLocalite(): ?string
    {
        return $this->Localite;
    }

    public function setLocalite(?string $Localite): static
    {
        $this->Localite = $Localite;

        return $this;
    }

    public function getPays(): ?string
    {
        return $this->Pays;
    }

    public function setPays(?string $Pays): static
    {
        $this->Pays = $Pays;

        return $this;
    }

    public function getTelFournisseur(): ?string
    {
        return $this->Tel_fournisseur;
    }

    public function setTelFournisseur(?string $Tel_fournisseur): static
    {
        $this->Tel_fournisseur = $Tel_fournisseur;

        return $this;
    }

    public function getUrlFournisseur(): ?string
    {
        return $this->Url_fournisseur;
    }

    public function setUrlFournisseur(?string $Url_fournisseur): static
    {
        $this->Url_fournisseur = $Url_fournisseur;

        return $this;
    }

    public function getEmailFournisseur(): ?string
    {
        return $this->Email_fournisseur;
    }

    public function setEmailFournisseur(?string $Email_fournisseur): static
    {
        $this->Email_fournisseur = $Email_fournisseur;

        return $this;
    }

    public function getFaxFournisseur(): ?string
    {
        return $this->Fax_fournisseur;
    }

    public function setFaxFournisseur(?string $Fax_fournisseur): static
    {
        $this->Fax_fournisseur = $Fax_fournisseur;

        return $this;
    }
}
