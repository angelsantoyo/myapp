<?php

namespace App\Entity;

use App\Repository\MembershipTypesRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MembershipTypesRepository::class)]
class MembershipTypes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column]
    private ?int $max_members = null;

    #[ORM\Column]
    private ?bool $status = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $annual_cost = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $monthly_amount = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updated_at = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    public function __construct()
    {

    }

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getMaxMembers(): ?int
    {
        return $this->max_members;
    }

    public function setMaxMembers(int $max_members): static
    {
        $this->max_members = $max_members;

        return $this;
    }

    public function isStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getAnnualCost(): ?string
    {
        return $this->annual_cost;
    }

    public function setAnnualCost(string $annual_cost): static
    {
        $this->annual_cost = $annual_cost;

        return $this;
    }

    public function getMonthlyAmount(): ?string
    {
        return $this->monthly_amount;
    }

    public function setMonthlyAmount(string $monthly_amount): static
    {
        $this->monthly_amount = $monthly_amount;

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

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getMembershipNumber(): ?Memberships
    {
        return $this->membership_number;
    }

    public function setMembershipNumber(?Memberships $membership_number): static
    {
        $this->membership_number = $membership_number;

        return $this;
    }

    public function getMemberships(): ?Memberships
    {
        return $this->memberships;
    }

    public function setMemberships(?Memberships $memberships): static
    {
        $this->memberships = $memberships;

        return $this;
    }
    public function getStatus(): bool
    {

        return $this->status;
    }

    public function findAll()
    {
        return $this;
    }
}
