<?php

class ProductModel
{
    // Dòng 4 - 7: Định nghĩa rõ kiểu dữ liệu cho các Property
    private int $ID;
    private string $Name;
    private string $Description;
    private float $Price;

    // Dòng 9: Định nghĩa type cho tham số đầu vào của Constructor
    public function __construct(int $ID, string $Name, string $Description, float $Price)
    {
        $this->ID = $ID;
        $this->Name = $Name;
        $this->Description = $Description;
        $this->Price = $Price;
    }

    // Các hàm Getter để lấy dữ liệu (Thêm kiểu dữ liệu trả về)
    public function getID(): int
    {
        return $this->ID;
    }

    public function getName(): string
    {
        return $this->Name;
    }

    public function getDescription(): string
    {
        return $this->Description;
    }

    public function getPrice(): float
    {
        return $this->Price;
    }

    // Dòng 18: Thêm type cho hàm setID
    public function setID(int $ID): void
    {
        $this->ID = $ID;
    }

    // Dòng 21: Thêm type cho hàm setName
    public function setName(string $Name): void
    {
        $this->Name = $Name;
    }

    // Dòng 24: Thêm type cho hàm setDescription
    public function setDescription(string $Description): void
    {
        $this->Description = $Description;
    }

    // Dòng 27: Thêm type cho hàm setPrice
    public function setPrice(float $Price): void
    {
        $this->Price = $Price;
    }
}