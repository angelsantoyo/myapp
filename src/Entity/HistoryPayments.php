<?php

namespace App\Entity;

use App\Repository\HistoryPaymentsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HistoryPaymentsRepository::class)]
class HistoryPayments
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToMany(mappedBy: 'historyPayments', targetEntity: PaymentTypes::class)]
    private Collection $fk_payment_type_id;

    #[ORM\OneToMany(mappedBy: 'historyPayments', targetEntity: Memberships::class)]
    private Collection $fk_membership_id;

    #[ORM\Column(length: 64)]
    private ?string $number = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $payment_amount = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\Column]
    private ?bool $status = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updated_at = null;

    public function __construct()
    {
        $this->fk_membership_id = new ArrayCollection();
        $this->fk_payment_type_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, PaymentTypes>
     */
    public function getFkMembershipId(): Collection
    {
        return $this->fk_membership_id;
    }

    public function addFkMembershipId(PaymentTypes $fkMembershipId): static
    {
        if (!$this->fk_membership_id->contains($fkMembershipId)) {
            $this->fk_membership_id->add($fkMembershipId);
            $fkMembershipId->setHistoryPayments($this);
        }

        return $this;
    }

    public function removeFkMembershipId(PaymentTypes $fkMembershipId): static
    {
        if ($this->fk_membership_id->removeElement($fkMembershipId)) {
            // set the owning side to null (unless already changed)
            if ($fkMembershipId->getHistoryPayments() === $this) {
                $fkMembershipId->setHistoryPayments(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Memberships>
     */
    public function getFkPaymentTypeId(): Collection
    {
        return $this->fk_payment_type_id;
    }

    public function addFkPaymentTypeId(Memberships $fkPaymentTypeId): static
    {
        if (!$this->fk_payment_type_id->contains($fkPaymentTypeId)) {
            $this->fk_payment_type_id->add($fkPaymentTypeId);
            $fkPaymentTypeId->setHistoryPayments($this);
        }

        return $this;
    }

    public function removeFkPaymentTypeId(Memberships $fkPaymentTypeId): static
    {
        if ($this->fk_payment_type_id->removeElement($fkPaymentTypeId)) {
            // set the owning side to null (unless already changed)
            if ($fkPaymentTypeId->getHistoryPayments() === $this) {
                $fkPaymentTypeId->setHistoryPayments(null);
            }
        }

        return $this;
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function setNumber(string $number): static
    {
        $this->number = $number;

        return $this;
    }

    public function getPaymentAmount(): ?string
    {
        return $this->payment_amount;
    }

    public function setPaymentAmount(string $payment_amount): static
    {
        $this->payment_amount = $payment_amount;

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

    public function isStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): static
    {
        $this->status = $status;

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
}
