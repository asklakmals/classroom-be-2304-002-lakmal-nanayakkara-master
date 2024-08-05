<?php

namespace OnlineStoreProject\Entities;

class Cart extends A_Entities
{
    const DB_TABLE_NAME = "cart";

    const DB_TABLE_FIELD_ID = "id";
    const DB_TABLE_FIELD_USERID = "user_id";
    const DB_TABLE_FIELD_PRODUCT = "product_id";
    const DB_TABLE_FIELD_QNT = "qnt";
    const DB_TABLE_FIELD_PAYMENT_METHOD_ID = "payment_method_id";
    const DB_TABLE_FIELD_IS_PAYED = "is_payed";

    public int $id;
    public int $userId;
    public int $productId;
    public int $qnt;
    public int $paymentMethodId;
    public bool $isPayed;

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

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    public function getProductId(): int
    {
        return $this->productId;
    }

    public function setProductId(int $productId): void
    {
        $this->productId = $productId;
    }

    public function getQnt(): int
    {
        return $this->qnt;
    }

    public function setQnt(int $qnt): void
    {
        $this->qnt = $qnt;
    }

    public function isPayed(): bool
    {
        return $this->isPayed;
    }

    public function setIsPayed(bool $isPayed): void
    {
        $this->isPayed = $isPayed;
    }

    public function getPaymentMethodId(): int
    {
        return $this->paymentMethodId;
    }

    public function setPaymentMethodId(int $paymentMethodId): void
    {
        $this->paymentMethodId = $paymentMethodId;
    }

    public function insert(array $values): bool
    {
        $conn = self::$connection;
        $stmt = $conn->prepare(
            "INSERT INTO " . self::DB_TABLE_NAME . " (user_id, product_id, qnt) VALUES (:user_id, :product_id, :qnt)"
        );
        $stmt->bindParam(":user_id", $values[self::DB_TABLE_FIELD_USERID]);
        $stmt->bindParam(":product_id", $values[self::DB_TABLE_FIELD_PRODUCT]);
        $stmt->bindParam(":qnt", $values[self::DB_TABLE_FIELD_QNT]);
        $result = $stmt->execute();
        return $result;
    }

    public function updateCartItemAsChekedout(int $id): bool
    {
        $conn = self::$connection;
        $stmt = $conn->prepare("UPDATE " . self::DB_TABLE_NAME . " SET is_payed='1' WHERE id=:id");
        $stmt->bindParam(":id", $id);
        $result = $stmt->execute();
        return $result;
    }

    public function findAllByUserId(int $userId): array
    {
        $conn = self::$connection;
        $stmt = $conn->prepare("SELECT * FROM " . self::DB_TABLE_NAME . " WHERE is_payed='0' AND user_id=" . $userId);
        $result = [];
        $stmt->execute();
        foreach ($stmt as $row) {
            $result[] = $row;
        }
        return $result;
    }

    public function findAllByUserIdJoinWithProducts(int $userId): array
    {
        $conn = self::$connection;
        $stmt = $conn->prepare(
            "SELECT * FROM " .
                self::DB_TABLE_NAME .
                " JOIN products ON cart.product_id=products.id WHERE is_payed='0' AND user_id=" .
                $userId
        );
        $result = [];
        $stmt->execute();
        foreach ($stmt as $row) {
            $result[] = $row;
        }
        return $result;
    }

    public function deleteByProductId(int $id): bool
    {
        $conn = self::$connection;
        $stmt = $conn->prepare(
            "DELETE FROM " . self::DB_TABLE_NAME . " WHERE product_id=:product_id AND user_id=:user_id"
        );
        $stmt->bindParam(":product_id", $id);
        $stmt->bindParam(":user_id", $_SESSION["user"]["id"]);
        $result = $stmt->execute();
        return $result;
    }
}