<?php

//skrypt 1
$db = new mysqli('localhost', 'root', '', 'motory');

$sql = "SELECT wycieczki.nazwa, wycieczki.opis, wycieczki.poczatek, zdjecia.zrodlo FROM wycieczki LEFT JOIN zdjecia ON wycieczki.zdjecia_id = zdjecia.id;";

echo "<dl>"
$result = $db->query($sql);
while ($row = $result->fetch_assoc()) {
    $name = $row['nazwa'];
    $description = $row['opis'];
    $start = $row['poczatek'];
    $photo = $row['zrodlo'];

    echo "<dt>$name, rozpoczyna się w $start, <a href=\"$photo.jpg\">zobacz zdjecie</a></dt><br>"
    echo "<dd>$description<dd>"
}
echo "</dl>"

$db->close();

//skrypt 2
$db = new mysqli('localhost', 'root', '', 'motory');

$sql = "SELECT COUNT(*) FROM wycieczki;";

$result = $db->query($sql);

$row = $result->fetch_assoc();

$count = $row['count(*)'];
echo "<p>Wpisanych wycieczek: $count</p>";

$db->close();
?>