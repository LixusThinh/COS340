<?php
require_once 'app/models/ProductModel.php';

class ProductController
{
    private array $products = [];

    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (isset($_SESSION['products'])) {
            $this->products = $_SESSION['products'];
        }
    }

    public function index(): void
    {
        $this->list();
    }

    public function list(): void
    {
        $products = $this->products;
        include 'app/views/product/list.php';
    }

    public function add(): void
    {
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'] ?? '';
            $description = $_POST['description'] ?? '';
            $price = $_POST['price'] ?? 0;

            if (empty($name)) {
                $errors[] = 'Tên sản phẩm là bắt buộc.';
            } elseif (strlen($name) < 10 || strlen($name) > 100) {
                $errors[] = 'Tên sản phẩm phải có từ 10 đến 100 ký tự.';
            }

            if (!is_numeric($price) || $price <= 0) {
                $errors[] = 'Giá phải là một số dương lớn hơn 0.';
            }

            if (empty($errors)) {
                $id = count($this->products) + 1;
                $product = new ProductModel($id, $name, $description, (float)$price);
                $this->products[] = $product;
                $_SESSION['products'] = $this->products;
                header('Location: /project1/Product/list');
                exit();
            }
        }
        include 'app/views/product/add.php';
    }

    // Fix lỗi thiếu type thông tin cho $id và bóc tách biến $product rõ ràng cho View
    public function edit(int $id): void
    {
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            foreach ($this->products as $key => $product) {
                if ($product->getID() == $id) {
                    $this->products[$key]->setName($_POST['name'] ?? '');
                    $this->products[$key]->setDescription($_POST['description'] ?? '');
                    $this->products[$key]->setPrice((float)($_POST['price'] ?? 0));
                    break;
                }
            }
            $_SESSION['products'] = $this->products;
            header('Location: /project1/Product/list');
            exit();
        }

        // Tìm kiếm sản phẩm lưu ra biến độc lập để Intelephense không báo Undefined
        $currentProduct = null;
        foreach ($this->products as $product) {
            if ($product->getID() == $id) {
                $currentProduct = $product;
                break;
            }
        }

        if ($currentProduct === null) {
            die('Product not found');
        }

        // Biến này sẽ được dùng trực tiếp trong file edit.php
        $product = $currentProduct; 
        include 'app/views/product/edit.php';
    }

    // Fix lỗi thiếu type thông tin cho $id
    public function delete(int $id): void
    {
        foreach ($this->products as $key => $product) {
            if ($product->getID() == $id) {
                unset($this->products[$key]);
                break;
            }
        }
        $this->products = array_values($this->products);
        $_SESSION['products'] = $this->products;
        header('Location: /project1/Product/list');
        exit();
    }
}