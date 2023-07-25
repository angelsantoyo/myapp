<?php

namespace App\Entity;

use App\Repository\MembershipsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MembershipsRepository::class)]
class Memberships
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToMany(mappedBy: 'memberships', targetEntity: MembershipTypes::class)]
    private Collection $fk_membership_type_id;

    #[ORM\Column(length: 36)]
    private ?string $membership_number = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $contact_phone_number = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $contact_phone_number2 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $contact_email = null;

    #[ORM\Column(length: 255)]
    private ?string $street = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $streets_reference = null;

    #[ORM\Column(length: 5, nullable: true)]
    private ?string $postcode = null;

    #[ORM\Column(length: 2)]
    private ?string $country_code = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $suburb = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $state = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $external_number = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $internal_number = null;

    #[ORM\Column(length: 255)]
    private ?string $references = null;

    #[ORM\Column]
    private ?bool $status = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updated_at = null;

/*
    #[ORM\OneToMany(inversedBy: 'fk_membership_id')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Partners $partners = null;

    #[ORM\ManyToOne(inversedBy: 'fk_payment_type_id')]
    #[ORM\JoinColumn(nullable: false)]
    private ?HistoryPayments $historyPayments = null;
*/
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $province_name = null;

    public function __construct()
    {
        $this->fk_membership_type_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, MembershipTypes>
     */
    public function getFkMembershipTypeId(): Collection
    {
        return $this->fk_membership_type_id;
    }

    public function addFkMembershipTypeId(MembershipTypes $fkMembershipTypeId): static
    {
        if (!$this->fk_membership_type_id->contains($fkMembershipTypeId)) {
            $this->fk_membership_type_id->add($fkMembershipTypeId);
            $fkMembershipTypeId->setMemberships($this);
        }

        return $this;
    }

    public function removeFkMembershipTypeId(MembershipTypes $fkMembershipTypeId): static
    {
        if ($this->fk_membership_type_id->removeElement($fkMembershipTypeId)) {
            // set the owning side to null (unless already changed)
            if ($fkMembershipTypeId->getMemberships() === $this) {
                $fkMembershipTypeId->setMemberships(null);
            }
        }

        return $this;
    }

    public function getMembershipNumber(): ?string
    {
        return $this->membership_number;
    }

    public function setMembershipNumber(string $membership_number): static
    {
        $this->membership_number = $membership_number;

        return $this;
    }

    public function getContactPhoneNumber(): ?string
    {
        return $this->contact_phone_number;
    }

    public function setContactPhoneNumber(?string $contact_phone_number): static
    {
        $this->contact_phone_number = $contact_phone_number;

        return $this;
    }

    public function getContactPhoneNumber2(): ?string
    {
        return $this->contact_phone_number2;
    }

    public function setContactPhoneNumber2(?string $contact_phone_number2): static
    {
        $this->contact_phone_number2 = $contact_phone_number2;

        return $this;
    }

    public function getContactEmail(): ?string
    {
        return $this->contact_email;
    }

    public function setContactEmail(?string $contact_email): static
    {
        $this->contact_email = $contact_email;

        return $this;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(string $street): static
    {
        $this->street = $street;

        return $this;
    }

    public function getStreetsReference(): ?string
    {
        return $this->streets_reference;
    }

    public function setStreetsReference(?string $streets_reference): static
    {
        $this->streets_reference = $streets_reference;

        return $this;
    }

    public function getPostcode(): ?string
    {
        return $this->postcode;
    }

    public function setPostcode(?string $postcode): static
    {
        $this->postcode = $postcode;

        return $this;
    }

    public function getCountryCode(): ?string
    {
        return $this->country_code;
    }

    public function setCountryCode(string $country_code): static
    {
        $this->country_code = $country_code;

        return $this;
    }

    public function getSuburb(): ?string
    {
        return $this->suburb;
    }

    public function setSuburb(?string $suburb): static
    {
        $this->suburb = $suburb;

        return $this;
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function setState(?string $state): static
    {
        $this->state = $state;

        return $this;
    }

    public function getExternalNumber(): ?string
    {
        return $this->external_number;
    }

    public function setExternalNumber(?string $external_number): static
    {
        $this->external_number = $external_number;

        return $this;
    }

    public function getInternalNumber(): ?string
    {
        return $this->internal_number;
    }

    public function setInternalNumber(?string $internal_number): static
    {
        $this->internal_number = $internal_number;

        return $this;
    }

    public function getReferences(): ?string
    {
        return $this->references;
    }

    public function setReferences(string $references): static
    {
        $this->references = $references;

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

    public function getPartners(): ?Partners
    {
        return $this->partners;
    }

    public function setPartners(?Partners $partners): static
    {
        $this->partners = $partners;

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

    public function getProvinceName(): ?string
    {
        return $this->province_name;
    }

    public function setProvinceName(?string $province_name): static
    {
        $this->province_name = $province_name;

        return $this;
    }
    public function findAll()
    {
        return $this;
    }
}
