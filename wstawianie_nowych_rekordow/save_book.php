<?php
// Pobieramy dane z formularza
$title = $_POST['title'] ?? '';
$author_id = $_POST['author'] ?? '';

// Sprawdzamy, czy dane są prawidłowe
if ($title && $author_id) {
    // Łączenie z bazą danych
    $db = new mysqli('localhost', 'root', '', 'bibliateka');

    // Sprawdzamy, czy połączenie jest poprawne
    if ($db->connect_error) {
        die("Błąd połączenia z bazą danych: " . $db->connect_error);
    }

    // Tworzymy zapytanie SQL 
    $sql = "INSERT INTO ksiazki (tytul, id_autor) VALUES ('$title', $author_id)";

    // Wykonanie zapytania
    if ($db->query($sql) === TRUE) {
        // Jeśli dodano książkę, przekierowanie na stronę główną
        header("Location: add_book.php");
        exit;
    } else {
        echo "Błąd podczas zapisywania książki: " . $db->error;
    }

    // Zamknięcie połączenia z bazą danych
    $db->close();
} else {
    echo "Brak wymaganych danych do zapisania.";
}
?>

