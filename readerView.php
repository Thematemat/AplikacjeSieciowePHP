<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>ImBiblio</title>
    <h1>ImBiblio</h1>
    <h2>System Biblioteki Imperialnej</h2>
    <hr>
</head>
<body>
<?php
    echo "<h3 style=text-align:right><a href =loginScreen.php>Wyloguj</a><br></h3>";
    //echo "SERWIS dla czytelnika";
$user = $_GET['user'];

$db_lnk = mysqli_connect('localhost', 'root', '', 'imbiblio');
$query = "SELECT * FROM ksiazki";
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
$query4 = "SELECT id_wypozyczenia, tytuł, autor, rokWydania,gatunek, ISBN, dataWypozyczenia, dataZwrotu FROM ksiazki, wypozyczenia WHERE id_reader ='{$arrUSER[1]}'";
$result4 = mysqli_query($db_lnk, $query4);

echo "<h2>Wypożyczone książki</h2>";
echo '<table><tr><th>Numer</th><th>Tytuł</th><th>Autor</th><th>Rok Wydania</th><th>Gatunek</th><th>ISBN</th><th>Data wypożyczenia</th><th>Data zwrotu</th><tr/>';
for ($i = 0; $i < $liczba_rekordow; $i++) {
    $arr = mysqli_fetch_row($result4);
    echo "<tr>";
    echo "<td>$arr[0]</td>";
    echo "<td>$arr[1]</td>";
    echo "<td>$arr[2]</td>";
    echo "<td>$arr[3]</td>";
    echo "<td>$arr[4]</td>";
    echo "<td>$arr[5]</td>";
    echo "<td>$arr[6]</td>";
    echo "<td>$arr[7]</td>";
    echo "</tr>";
}
echo '</table>';




    echo '<table><tr><th>Numer</th><th>Tytuł</th><th>Autor</th><th>Rok Wydania</th><th>Gatunek</th><th>ISBN</th><tr/>';
    $liczba_rekordow = mysqli_num_rows($result);
    echo "<h2>Katalog książek</h2>";
    for ($i = 0; $i < $liczba_rekordow; $i++) {
        $arr = mysqli_fetch_row($result);
        echo "<tr>";
        echo "<td>$arr[0]</td>";
        echo "<td>$arr[1]</td>";
        echo "<td>$arr[2]</td>";
        echo "<td>$arr[3]</td>";
        echo "<td>$arr[4]</td>";
        echo "<td>$arr[5]</td>";
        echo "<td><a href = TuDajeszŚcieżkeDoZamówień!> Złóż zamówienie </a>";
        echo "</tr>";
    }
    echo '</table>';
?>
</body>
</html>