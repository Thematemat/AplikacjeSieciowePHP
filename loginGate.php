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
$login = $_POST['login'];
$haslo = $_POST['haslo'];

$db_lnk = mysqli_connect('localhost', 'root', '', 'imbiblio');
$query = 'SELECT * FROM users';

if (!$result = mysqli_query($db_lnk, $query))
{
    echo 'Wystąpił błąd - nieprawidłowe zapytanie!';
}
else {
    $liczba_rekordow = mysqli_num_rows($result);
    $j = $liczba_rekordow - 1;
    for ($i = 0; $i < $liczba_rekordow; $i++) {
        $arr=mysqli_fetch_row($result);
    if($login == $arr[1] && $haslo == $arr[2]){
        echo "<h3 style=text-align:right><a href =loginScreen.php>Wyloguj</a><br></h3>";
        echo "Zalogowano jako: $arr[1] <br>";
        echo "Bardzo dobra robota!";
        break;
    }
    elseif($j == $i){
        echo "Wprowadzono złe dane!<br>";
        echo "<a href =loginScreen.php>Powrót</a><br>";
    }
    echo "<br>";
    }

}
?>
</body>
</html>