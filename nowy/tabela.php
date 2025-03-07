<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autorzy na A i ich książki</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="tabela">
    <?php
$db = new mysqli('localhost', 'root', '', 'bibliateka');
$db->set_charset('utf8mb4'); 
$sql = "SELECT ksiazki.id AS 'ID', CONCAT(autorzy.imie, ' ', autorzy.nazwisko) AS 'Author', ksiazki.tytul AS 'Title' 
        FROM ksiazki
        LEFT JOIN autorzy ON autorzy.id = ksiazki.id_autor
        WHERE autorzy.imie LIKE 'A%'";

$result = $db->query($sql);

echo "<table>";
echo "<tr><th>ID</th><th>Autor</th><th>Tytuł</th></tr>";

while($row = $result->fetch_assoc()) {
    echo "<tr><td>{$row['ID']}</td><td>{$row['Author']}</td><td>{$row['Title']}</td></tr>";
}

echo "</table>";

$db->close();
?>
</div>
    
</body>
</html>