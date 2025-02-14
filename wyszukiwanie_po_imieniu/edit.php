<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edytuj książkę</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <?php
        // Pobieramy ID z linku
        $id = $_REQUEST['id'];

        // Budujemy zapytanie
        $sql = "SELECT 
                    ksiazki.id,
                    CONCAT(autorzy.imie, ' ', autorzy.nazwisko) AS autor, 
                    ksiazki.tytul AS tytul 
                FROM ksiazki 
                LEFT JOIN autorzy ON autorzy.id = ksiazki.id_autor
                WHERE ksiazki.id = $id";

        // Łączenie z bazą
        $db = new mysqli('localhost', 'root', '', 'bibliateka');
        $result = $db->query($sql);
        $row = $result->fetch_assoc(); // Pobieramy dane

        // Pobieramy dane z bazy
        $author = $row['autor'];
        $title = $row['tytul'];
    ?>

    <form action="save.php" method="post">
        <input type="hidden" name="id" value="<?php echo $id; ?>">

        <label for="author">Autor:</label>
        <input type="text" name="author" id="author" value="<?php echo $author; ?>" readonly>

        <label for="title">Tytuł:</label>
        <input type="text" name="title" id="title" value="<?php echo $title; ?>">

        <input type="submit" value="Zapisz" class="btn btn-primary">
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
