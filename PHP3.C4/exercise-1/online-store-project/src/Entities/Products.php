<?php
namespace OnlineStoreProject\Entities;

class Products extends A_Entities
{
    const DB_TABLE_NAME = "products";

    public int $id;
    public string $name;
    public float $price;
    public string $image;
    public string $description;

    public function findById(int $id): array
    {
        $conn = self::$connection;
        $stmt = $conn->prepare("SELECT * FROM " . self::DB_TABLE_NAME . " WHERE id=:id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);

        return $result;
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

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function setImage(string $image): void
    {
        $this->image = $image;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function insert(array $values): bool
    {
    }

    public function findMaximalId(): int
    {
        $conn = self::$connection;
        $stmt = $conn->prepare("SELECT MAX(id) as id FROM " . self::DB_TABLE_NAME);
        $stmt->execute();
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);

        return $result["id"];
    }
}