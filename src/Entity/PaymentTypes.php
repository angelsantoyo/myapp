<?php

namespace App\Entity;

use App\Repository\PaymentTypesRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PaymentTypesRepository::class)]
class PaymentTypes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $payment_name = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $payment_description = null;

    #[ORM\Column]
    private ?bool $payment_status = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updated_at = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\ManyToOne(inversedBy: 'fk_membership_id')]
    #[ORM\JoinColumn(nullable: false)]
    private ?HistoryPayments $historyPayments = null;

    #[ORM\Column(length: 2)]
    private ?string $prefix = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPaymentName(): ?string
    {
        return $this->payment_name;
    }

    public function setPaymentName(string $payment_name): static
    {
        $this->payment_name = $payment_name;

        return $this;
    }

    public function getPaymentDescription(): ?string
    {
        return $this->payment_description;
    }

    public function setPaymentDescription(?string $payment_description): static
    {
        $this->payment_description = $payment_description;

        return $this;
    }

    public function isPaymentStatus(): ?bool
    {
        return $this->payment_status;
    }

    public function setPaymentStatus(bool $payment_status): static
    {
        $this->payment_status = $payment_status;

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

    public function getHistoryPayments(): ?HistoryPayments
    {
        return $this->historyPayments;
    }

    public function setHistoryPayments(?HistoryPayments $historyPayments): static
    {
        $this->historyPayments = $historyPayments;

        return $this;
    }

    public function getPrefix(): ?string
    {
        return $this->prefix;
    }

    public function setPrefix(string $prefix): static
    {
        $this->prefix = $prefix;

        return $this;
    }
}
