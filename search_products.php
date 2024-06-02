<?php

include_once "include/conn.php";

$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$limit = 12;

// Calculate offset for the current page
$offset = ($page - 1) * $limit;

// Fetch products matching the search keyword from the database with pagination
$stmt = $pdo->prepare("SELECT * FROM products WHERE product_name LIKE ? LIMIT ?, ?");
$stmt->execute(["%$keyword%", $offset, $limit]);
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($products);
