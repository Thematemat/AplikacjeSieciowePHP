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
        $arr = mysqli_fetch_row($result);
        $funkcja = $arr[3];
        $user = $arr[1];

        if ($login == $arr[1] && $haslo == $arr[2]) {
            echo "<h3 style=text-align:right><a href =loginScreen.php>Wyloguj</a><br></h3>";
            echo "Zalogowano jako: $arr[1] <br>";
            echo "Bardzo dobra robota!";


            if ($funkcja == "pracownik") {
                echo "Ups automatyczne przekierowanie nie zadziałało użyj Przejdź do serwisu, by kontynuować logowanie.";
                echo "<h3><a href =workerView.php>Przejdź do serwisu</a><br></h3>";
                $redirectUrl = 'workerView.php';
                header('Location: ' . $redirectUrl);
                echo $funkcja;
            }

            elseif ($funkcja == "czytelnik") {
                $redirectUrl = 'readerView.php?user='. urlencode($user);
                header('Location: ' . $redirectUrl);
                echo $funkcja;
                echo "Ups automatyczne przekierowanie nie zadziałało użyj Przejdź do serwisu, by kontynuować logowanie.";
            }
        }
    elseif ($j == $i) {
                echo "Wprowadzono złe dane!<br>";
                echo "<a href =loginScreen.php>Powrót</a><br>";
            }
            echo "<br>";
        }
    }
?>
</body>
</html>