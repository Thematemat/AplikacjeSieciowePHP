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
<button class="buttonowanie" type=button><a class="buttonowanie" href =loginScreen.php>Wyloguj</a><br></button>

<?php
    //echo "SERWIS dla czytelnika";
$user = $_GET['user'];

$db_lnk = mysqli_connect('localhost', 'root', '', 'imbiblio');
$query = "SELECT * FROM ksiazki WHERE id_wypozyczenia is NULL";
$result = mysqli_query($db_lnk, $query);

$query2 = "SELECT id, id_reader FROM users WHERE login = '{$user}'";
$result2 = mysqli_query($db_lnk, $query2);

$liczba_rekordow = mysqli_num_rows($result2);
for ($i = 0; $i < $liczba_rekordow; $i++) {
    $arrUSER = mysqli_fetch_row($result2);
    //$arrUSER[0] zawiera ID Użytkownika $arrUSER[1] zawiera ID Czytelnika
}



$query3 = "SELECT imie, nazwisko FROM czytelnicy WHERE id_user ='{$arrUSER[0]}'";
$result3 = mysqli_query($db_lnk, $query3);


$liczba_rekordow = mysqli_num_rows($result3);
    for ($i = 0; $i < $liczba_rekordow; $i++) {
        $arr = mysqli_fetch_row($result3);
       echo "Zalogowano jako: "; echo $arr[0]; echo " "; echo $arr[1];
    }
    $query4 = "SELECT ksiazki.id, id_wypozyczenia, tytuł, autor, rokWydania,gatunek, ISBN, dataWypozyczenia, dataZwrotu, status FROM ksiazki INNER JOIN wypozyczenia ON ksiazki.id_wypozyczenia = wypozyczenia.id WHERE id_reader = '{$arrUSER[1]}'";
$result4 = mysqli_query($db_lnk, $query4);

echo "<h2>Wypożyczone książki</h2>";
$liczba_rekordow = mysqli_num_rows($result4);
echo '<table><tr><th>Tytuł</th><th>Autor</th><th>Rok Wydania</th><th>Gatunek</th><th>ISBN</th><th>Data wypożyczenia</th><th>Data zwrotu</th><th>Status</th><tr/>';
for ($i = 0; $i < $liczba_rekordow; $i++) {
    $arr = mysqli_fetch_row($result4);


    echo "<tr>";
    echo "<td>$arr[2]</td>";
    echo "<td>$arr[3]</td>";
    echo "<td>$arr[4]</td>";
    echo "<td>$arr[5]</td>";
    echo "<td>$arr[6]</td>";
    echo "<td>$arr[7]</td>";
    echo "<td>$arr[8]</td>";
    echo "<td>$arr[9]</td>";


    if($arr[9] == "zamówiona"){
        echo "<td><a href = cancelGate.php?idKsiazki=$arr[0]&idWyp=$arr[1]&user=$user> Anuluj zamówienie </a></td>";
    }
    else{
        echo "<td></td>";
    }

    echo "</tr>";
}
echo '</table>';




    echo '<table><tr><th>Numer</th><th>Tytuł</th><th>Autor</th><th>Rok Wydania</th><th>Gatunek</th><th>ISBN</th><tr/>';
    $liczba_rekordow = mysqli_num_rows($result);
    echo "<h2>Katalog książek</h2>";
    for ($i = 0; $i < $liczba_rekordow; $i++) {
        $arra = mysqli_fetch_row($result);
        echo "<tr>";
        echo "<td>$arra[0]</td>";
        echo "<td>$arra[1]</td>";
        echo "<td>$arra[2]</td>";
        echo "<td>$arra[3]</td>";
        echo "<td>$arra[4]</td>";
        echo "<td>$arra[5]</td>";
        echo "<td><a href = borrowGate.php?book=$arra[0]&reader=$arrUSER[1]&user=$user> Złóż zamówienie </a>";
        echo "</tr>";
    }
    echo '</table>';




?>
<hr>
<br>
<h2>Czarne Imperium</h2>
<img src = "CzarneImperium.png" width="100" height="100">
</body>
</html>