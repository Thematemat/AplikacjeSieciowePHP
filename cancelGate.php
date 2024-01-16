<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel="stylesheet" href="./style.css">
    <title>ImBiblio</title>
    <h1>ImBiblio</h1>
    <h2>System Biblioteki Imperialnej</h2>
    <hr>
</head>
<body>
<h3>Czy anulować zamówienie?</h3>
<form method="post">
    <input type="submit" name="button1" class="buttonowanieFormularzowe" value="Anuluj zamówienie" />
    <input type="submit" name="button2" class="buttonowanieFormularzowe" value="Powrót" />
</form>

<?php
    $idKsiazki = $_GET['idKsiazki'];
    $idWyp = $_GET['idWyp'];
    $user = $_GET['user'];

    $db_lnk = mysqli_connect('localhost', 'root', '', 'imbiblio');
    $query = "SELECT * FROM ksiazki WHERE id = '{$idKsiazki}'";
    $result = mysqli_query($db_lnk, $query);
    $liczba_rekordow = mysqli_num_rows($result);
    echo '<table><tr><th>Tytuł</th><th>Autor</th><th>Rok Wydania</th><tr/>';
    for ($i = 0; $i < $liczba_rekordow; $i++) {
        $arr = mysqli_fetch_row($result);

        echo "<tr>";
        echo "<td>$arr[1]</td>";
        echo "<td>$arr[2]</td>";
        echo "<td>$arr[3]</td>";
        echo "</tr>";
    }
    echo '</table>';


if(array_key_exists('button1', $_POST)) {
    button1($idKsiazki, $idWyp, $user);
}
function button1($idKsiazki, $idWyp, $user) {
    $db_lnk = mysqli_connect('localhost', 'root', '', 'imbiblio');
    $query = "UPDATE `ksiazki` SET `id_wypozyczenia` = NULL WHERE `ksiazki`.`id` = '{$idKsiazki}'";
    $query2 = "DELETE FROM wypozyczenia WHERE `wypozyczenia`.`id` = '{$idWyp}'";
    mysqli_query($db_lnk, $query);
    mysqli_query($db_lnk, $query2);
    $redirectUrl = 'readerView.php?user='. urlencode($user);
    header('Location: ' . $redirectUrl);
}

if(array_key_exists('button2', $_POST)) {
    button2($user);
}
function button2($user) {
    $redirectUrl = 'readerView.php?user='. urlencode($user);
    header('Location: ' . $redirectUrl);
}
?>
<hr>
<br>
<h2>Czarne Imperium</h2>
<img src = "CzarneImperium.png" width="100" height="100">
</body>
</html>