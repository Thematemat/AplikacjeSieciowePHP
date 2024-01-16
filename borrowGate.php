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
<h3>Czy złożyć zamówienie?</h3>
<form method="post">
    <input type="submit" name="button1" class="buttonowanieFormularzowe" value="Złóż zamówienie" />
    <input type="submit" name="button2" class="buttonowanieFormularzowe" value="Powrót" />
</form>
<?php
    $book = $_GET['book'];
    $reader = $_GET['reader'];
    $user = $_GET['user'];
    $currentDate = date("Y-m-d");
    $newDate = date("Y-m-d", strtotime($currentDate . " +30 days"));


$db_lnk = mysqli_connect('localhost', 'root', '', 'imbiblio');
$query = "SELECT * FROM ksiazki WHERE id = '{$book}'";
$result = mysqli_query($db_lnk, $query);
$liczba_rekordow = mysqli_num_rows($result);
echo '<table><tr><th>Tytuł</th><th>Autor</th><th>Rok Wydania</th><th>Data Wypożyczenia</th><th>Data Zwrotu</th><tr/>';
for ($i = 0; $i < $liczba_rekordow; $i++) {
    $arr = mysqli_fetch_row($result);

    echo "<tr>";
    echo "<td>$arr[1]</td>";
    echo "<td>$arr[2]</td>";
    echo "<td>$arr[3]</td>";
    echo "<td>$currentDate</td>";
    echo "<td>$newDate</td>";
    echo "</tr>";
}
echo '</table>';



if(array_key_exists('button1', $_POST)) {
    button1($book,$reader,$currentDate,$newDate,$user);
}
        function button1($book,$reader,$currentDate,$newDate,$user) {
            $db_lnk = mysqli_connect('localhost', 'root', '', 'imbiblio');
             $query = "INSERT INTO `wypozyczenia` ( `id_ksiazki`, `id_reader`, `dataWypozyczenia`, `dataZwrotu`, `status`) VALUES ( '{$book}', '{$reader}', '{$currentDate}', '{$newDate}', 'zamówiona')";
             mysqli_query($db_lnk, $query);

             $query2 = "SELECT id FROM wypozyczenia WHERE id_ksiazki = '{$book}'";
             $result = mysqli_query($db_lnk, $query2);
             $liczba_rekordow = mysqli_num_rows($result);
             for ($i = 0; $i < $liczba_rekordow; $i++) {
                 $arr = mysqli_fetch_row($result);
             }
             $query3 = "UPDATE ksiazki SET id_wypozyczenia = '{$arr[0]}' WHERE id = '{$book}'";
            mysqli_query($db_lnk, $query3);

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