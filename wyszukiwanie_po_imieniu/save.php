<?php
// Pobieramy dane z formularza
$id = $_POST['id'] ?? '';
$title = $_POST['title'] ?? '';

// Sprawdzamy, czy dane są puste
if ($id && $title) {
    // Łączenie z bazą danych
    $db = new mysqli('localhost', 'root', '', 'bibliateka');

    // Sprawdzamy, czy połączenie z bazą jest poprawne
    if ($db->connect_error) {
        die("Błąd połączenia z bazą danych: " . $db->connect_error);
    }

    // Przygotowanie zapytania do zaktualizowania rekordu
    $sql = "UPDATE ksiazki SET tytul = '$title' WHERE id = $id";

    // Wykonanie zapytania
    if ($db->query($sql) === TRUE) {
        // Przekierowanie na stronę główną po zapisaniu
        header("Location: index.php");
        exit;
    } else {
        echo "Błąd podczas zapisywania danych: " . $db->error;
    }

    // Zamknięcie połączenia z bazą
    $db->close();
} else {
    echo "Brak danych do zapisania.";
}
?>
