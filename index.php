<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Details</title>
    <link rel="stylesheet" href="style.css">
</head>
<body style="font-family: sans-serif; margin: 20px; padding: 10px; display: flex; flex-direction: column; align-items: flex-start; background: #f4f4f9;">
    <h2 style="color: #4b0082;">Book Details</h2>
    <a href="../form.php">
        <button style="padding: 10px 20px;
         background-color: #28a745; color: white; border: none;
          margin-bottom: 20px;">Add New Book</button>
    </a>

    <?php
    include 'database.php';

    // Load the book data
    $stmt = $connect->prepare("SELECT * FROM books");
    $stmt->execute();
    $books = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Check for delete request
    if (isset($_GET['confirm_delete'])) {
        $deleteIndex = $_GET['confirm_delete'];
        $stmt = $connect->prepare("DELETE FROM books WHERE id = :id");
        $stmt->bindParam(':id', $deleteIndex);
        if ($stmt->execute()) {
            header("Location: index.php");
            exit();
        } else {
            echo "<p style='color: red;'>Error deleting book.</p>";
        }
    }

    // Check for a delete action request to show confirmation message
    if (isset($_GET['delete'])) {
        $deleteIndex = $_GET['delete'];
        echo "<p style='color: red;'>Are you sure you want to delete the book titled '" . htmlspecialchars($books[$deleteIndex]['title']) . "'?</p>";
        echo "<a href='index.php?confirm_delete=$deleteIndex' style='color: white; background-color: #d9534f; padding: 5px 10px; text-decoration: none;'>Confirm Delete</a> ";
        echo "<a href='index.php' style='padding: 5px 10px; background-color: #5bc0de; color: white; text-decoration: none;'>Cancel</a>";
    }

    // Display the book table if there are books
    if (!empty($books)) {
        echo "<table border='1' style='width: 100%; text-align: left;'>";
        echo "<tr style='background-color: #4b0082; color: white;'><th>Title</th><th>Author</th><th>Action</th></tr>";
        foreach ($books as $book) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($book['title']) . "</td>";
            echo "<td>" . htmlspecialchars($book['author']) . "</td>";
            echo "<td><a href='index.php?delete=" . $book['id'] . "' style='color: white; background-color: #d9534f; padding: 5px 10px; text-decoration: none;'>Delete</a></td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No books available.</p>";
    }
    ?>
</body>
</html>
