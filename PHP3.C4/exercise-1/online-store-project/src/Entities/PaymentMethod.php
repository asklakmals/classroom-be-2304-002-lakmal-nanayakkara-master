<?php
namespace OnlineStoreProject\Entities;

class PaymentMethods extends A_Entities
{
    public int $id;
    public string $name;
    public bool $isActive;

    public function findById(int $id): array
    {
    }

    public function findAllById(int $id): array
    {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function isActive(): bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): void
    {
        $this->isActive = $isActive;
    }

    public function insert(array $values): bool
    {
    }
}