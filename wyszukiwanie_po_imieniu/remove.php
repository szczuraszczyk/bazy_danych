<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Potwierdzenie usunięcia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!--<link rel="stylesheet" href="style.css">-->
</head>
<body>
<?php

$id = $_REQUEST['id'];

$sql = "SELECT ksiazki.id, ksiazki.tytul AS tytul, CONCAT(autorzy.imie, ' ', autorzy.nazwisko) AS autor
        FROM ksiazki
        LEFT JOIN autorzy ON autorzy.id = ksiazki.id_autor
        WHERE ksiazki.id = $id
        LIMIT 1";

$db = new mysqli('localhost', 'root', '', 'bibliateka');
$result = $db->query($sql);

// Sprawdzamy, czy zapytanie zwróciło wynik
if ($result->num_rows > 0) {
    $book = $result->fetch_assoc();
    echo "Czy jesteś pewien, że chcesz usunąć poniższą książkę?: <br>";
    echo $book['tytul'] . ' - ' . $book['autor'];
    echo "<br><a href='delete.php?id=" . $id . "'>Tak</a><br>";
    echo "<a href='index.php'>Nie</a>";
} else {
    echo "Nie znaleziono książki o podanym ID.";
}

$db->close();

?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>