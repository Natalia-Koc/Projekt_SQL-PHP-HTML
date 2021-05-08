<?php 
session_start()
?>
<!DOCTYPE html>
<html lang="pl">
  <head>
    <title>ZFN</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../style.CSS">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
  </head>
  <body>
    <section>
      <div class="naglowek"><h2>Zwierzoluby z Fajną Nazwą</h2></div>
      <article>
        <form action='dodaj_zwierzaka_bazaDanych.php' method='post' enctype='multipart/form-data'>
          <input type='file' name='fileToUpload' id='fileToUpload'><br>
          <p>Imie: <input id='nazwa' type='text' name='nazwa'></p>
          <p>Gatunek - <input id='gatunek' type='text' name='gatunek'>
            Rasa - <input id='rasa' type='text' name='rasa'>
            Płeć - <input id='plec' type='text' name='plec'></p>
          <p>Data urodzenia: <input id='data_urodzenia' type='date' name='data_urodzenia'></p>
          <p>Opis: <br><textarea style='width:60%' name='opis'></textarea></p>
          <input id='przycisk' type='submit' name='submit' value='Zapisz'>
        </form>
        <form action="moje_konto.php" style="text-align: left">
          <input id="przycisk" type="submit" name="submit" value="powrót">
        </form>
      </article>
    </section>

    <footer>
      <p> © Natalia Koć</p>
    </footer>

  </body>
</html>

</body>
</html>