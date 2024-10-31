<?php
include 'database.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST["Add Book"])){
        $bookname = $_POST['name'];
        $author = $_POST['author'];
        $price = $_POST['price'];
        $stock = $_POST['stock'];
        $isbn = $_POST['isbn'];

        $query = <<<SQL
        INSERT INTO books (isbn, title, author, stock, price)
        VALUES (:isbn, :title, :author, :stock :price)
        SQL;
        $statement = $db->prepare($query);
        $params = [
            'isbn' => $isbn,
            'title' => $bookname,
            'author' => $author,
            'stock' => $stock,
            'price' => $price
        ];
        $statement->execute($params);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Book</title>
</head>
<body style="font-family: sans-serif; margin: 20px;">

<h2 style="color: #00ff7f;">Add a New Book</h2>

<!-- Form to add new book with inline styling -->
<form action="form.php" method="post" style="max-width: 400px;">
    <label for="name" style="display: block; margin-bottom: 8px;">Book Name:</label>
    <input type="text" id="name" name="title" required style="width: 100%; padding: 10px; margin-bottom: 20px; border: 1px solid;">

    <label for="author" style="display: block; margin-bottom: 8px;">Author:</label>
    <input type="text" id="author" name="author" required style="width: 100%; padding: 10px; margin-bottom: 20px; border: 1px solid;">

    <label for="price" style="display: block; margin-bottom: 8px;">Price:</label>
    <input type="number" id="price" name="pages" step="0.01" required style="width: 100%; padding: 10px; margin-bottom: 20px; border: 1px solid">

    <label for="stock" style="display: block; margin-bottom: 8px;">Stock:</label>
    <input type="number" id="stock" name="stock" required style="width: 100%; padding: 10px; margin-bottom: 20px; border: 1px solid;">

    <label for="isbn" style="display: block; margin-bottom: 8px;">ISBN:</label>
    <input type="text" id="isbn" name="isbn" required style="width: 100%; padding: 10px; margin-bottom: 20px; border: 1px solid;">

    <input type="submit" value="Add Book" style="background-color: #007bff; color: white; padding: 10px 20px; border: none;">
</form>

<!-- Button to navigate back to index.php -->
<br>
<a href="index.php">
    <button style="padding: 10px 20px; background-color: #17a2b8; color: white; border: none;">Back to Book List</button>
</a>
</body>
</html>