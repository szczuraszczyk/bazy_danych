<?php
if(isset($_REQUEST['id'])){
    $id = $_REQUEST['id'];
    $db = new mysqli('localhost', 'root', '', 'bibliateka');
    $sql = "DELETE FROM ksiazki WHERE id = $id";
    $db->query($sql);
    //header przekierowuje na inną stronę
    header('Location: index.php');
}

?>