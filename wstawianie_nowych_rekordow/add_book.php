<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dodaj Książkę</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <h1>Dodaj Nową Książkę</h1>
        <form action="save_book.php" method="POST">
            <div class="mb-3">
                <label for="title" class="form-label">Tytuł książki:</label>
                <input type="text" class="form-control" name="title" id="title" required>
            </div>

            <div class="mb-3">
                <label for="author" class="form-label">Wybierz autora:</label>
                <select class="form-select" name="author" id="author" required>
                    <?php
                    // Łączenie z bazą danych
                    $db = new mysqli('localhost', 'root', '', 'bibliateka');

                    // Sprawdzamy połączenie
                    if ($db->connect_error) {
                        die("Błąd połączenia z bazą danych: " . $db->connect_error);
                    }

                    // Pobieramy listę autorów z bazy
                    $sql = "SELECT id, CONCAT(imie, ' ', nazwisko) AS autor FROM autorzy";
                    $result = $db->query($sql);

                    // Sprawdzamy, czy są jacyś autorzy
                    if ($result->num_rows > 0) {
                        // Wyświetlamy autorów w polu select
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row['id'] . "'>" . $row['autor'] . "</option>";
                        }
                    } else {
                        echo "<option disabled>Brak autorów w bazie</option>";
                    }

                    // Zamknięcie połączenia
                    $db->close();
                    ?>
                </select>
            </div>

            <button type="submit" action="save_book.php">Zapisz książkę</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
