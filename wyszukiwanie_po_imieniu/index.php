<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!--<link rel="stylesheet" href="style.css">-->
</head>

<body>

    <h1>wyszukiwanie wg. autora</h1>
    <form action="index.php" method="post">
        <div class="row">
        <label for="name" class="col form-label">Nazwisko autora:</label>
        <input type="text" name="name" id="name" class="col form-control">
        <input type="submit" value="Szukaj" class="col btn btn-primary">
        </div>
    </form>
    
    <?php
    $name = "%";
    if (isset($_POST['name'])) {
        $name = "%" . $_POST['name'] . "%";
    }
    $sql = "SELECT 
        ksiazki.id AS book,
        CONCAT(autorzy.imie, ' ', autorzy.nazwisko) AS autor, 
        ksiazki.tytul AS tytul FROM ksiazki 
        LEFT JOIN autorzy ON autorzy.id = ksiazki.id_autor 
        WHERE autorzy.nazwisko LIKE '" . $name . "' 
        OR autorzy.imie LIKE '" . $name . "'";

    $db = new mysqli('localhost', 'root', '', 'bibliateka');
    $result = $db->query($sql);
    
    echo '<table class="table">';
    echo "<tr><th>ID</th><th>Autor</th><th>Tytuł</th><th>Edycja</th><th>Usunięcie</th></tr>";
    while ($row = $result->fetch_assoc()) {
        $id = $row['book'];
        $author = $row['autor'];
        $title = $row['tytul'];
        $editLink = '<a href="edit.php?id='.$id.'">Edytuj</a>';
        $removeLink = '<a href="remove.php?id='.$id.'">Usuń</a>';

        echo "<tr><td>$id</td><td>$author</td><td>$title</td><td>$editLink</td><td>$removeLink</td></tr>";
    }
    echo "</table>";
    ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>