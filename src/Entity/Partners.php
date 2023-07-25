<?php

namespace App\Entity;

use App\Repository\PartnersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PartnersRepository::class)]
class Partners
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToMany(mappedBy: 'id', targetEntity: Memberships::class)]
    private Collection $fk_membership_id;

    #[ORM\Column(length: 100)]
    private ?string $first_name = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $last_name = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $last_name2 = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $birthdate = null;

    #[ORM\Column(length: 2)]
    private ?string $relationship = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updated_at = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $activated_at = null;

    public function __construct()
    {
        $this->fk_membership_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Memberships>
     */
    public function getFkMembershipId(): Collection
    {
        return $this->fk_membership_id;
    }

    public function addFkMembershipId(Memberships $fkMembershipId): static
    {
        if (!$this->fk_membership_id->contains($fkMembershipId)) {
            $this->fk_membership_id->add($fkMembershipId);
            $fkMembershipId->setPartners($this);
        }

        return $this;
    }

    public function removeFkMembershipId(Memberships $fkMembershipId): static
    {
        if ($this->fk_membership_id->removeElement($fkMembershipId)) {
            // set the owning side to null (unless already changed)
            if ($fkMembershipId->getPartners() === $this) {
                $fkMembershipId->setPartners(null);
            }
        }

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function setFirstName(string $first_name): static
    {
        $this->first_name = $first_name;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    public function setLastName(?string $last_name): static
    {
        $this->last_name = $last_name;

        return $this;
    }

    public function getLastName2(): ?string
    {
        return $this->last_name2;
    }

    public function setLastName2(?string $last_name2): static
    {
        $this->last_name2 = $last_name2;

        return $this;
    }

    public function getBirthdate(): ?\DateTimeInterface
    {
        return $this->birthdate;
    }

    public function setBirthdate(\DateTimeInterface $birthdate): static
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    public function getRelationship(): ?string
    {
        return $this->relationship;
    }

    public function setRelationship(string $relationship): static
    {
        $this->relationship = $relationship;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeImmutable $updated_at): static
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    public function getActivatedAt(): ?\DateTimeInterface
    {
        return $this->activated_at;
    }

    public function setActivatedAt(\DateTimeInterface $activated_at): static
    {
        $this->activated_at = $activated_at;

        return $this;
    }
    public function findAll()
    {
        return $this;
    }
}
