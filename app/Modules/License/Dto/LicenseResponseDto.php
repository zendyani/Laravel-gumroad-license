<?php

namespace App\Modules\License\Dto;

class LicenseResponseDto {
    public function __construct(
        private string $licenseKey,
        private string $email,
        private string $productName,
        private string $productPermalink,
        private string $productCode,
        private int $price,
        private string $recurrence,
        private string $ipCountry,
        private \DateTime $saleTimestamp,
        private int $uses,
        private ?\DateTime $subscriptionEndedAt = null,
        private ?\DateTime $subscriptionCancelledAt = null,
        private ?\DateTime $subscriptionFailedAt = null
    ) {
    }

    // Getters for each property
    public function getLicenseKey(): string {
        return $this->licenseKey;
    }
    public function getEmail(): string {
        return $this->email;
    }
    public function getProductName(): string {
        return $this->productName;
    }
    public function getProductPermalink(): string {
        return $this->productPermalink;
    }
    public function getProductCode(): string {
        return $this->productCode;
    }
    public function getPrice(): int {
        return $this->price;
    }
    public function getRecurrence(): string {
        return $this->recurrence;
    }
    public function getIpCountry(): string {
        return $this->ipCountry;
    }
    public function getSaleTimestamp(): \DateTime {
        return $this->saleTimestamp;
    }
    public function getUses(): int {
        return $this->uses;
    }
    public function getSubscriptionEndedAt(): ?\DateTime {
        return $this->subscriptionEndedAt;
    }
    public function getSubscriptionCancelledAt(): ?\DateTime {
        return $this->subscriptionCancelledAt;
    }
    public function getSubscriptionFailedAt(): ?\DateTime {
        return $this->subscriptionFailedAt;
    }
}
