<!DOCTYPE html>
<html lang="pl">
  <head>
    <title>ZFN rejestracja</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../style.CSS">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
  </head>
  <body>
    <section>
      <div class="naglowek"><h2>Zwierzoluby z Fajną Nazwą</h2></div>
      <article>
         <form action="dodajDoBazy.php" method="post" enctype="multipart/form-data">
          <p>Nick: <input id="nick" type="text" name="nick" placeholder="nick"></p>
          <p>Hasło: <input id="haslo" type="password" name="haslo" placeholder="hasło"></p>
          <p>Imie: <input id="imie" type="text" name="imie" placeholder="Imie"></p>
          <p>Nazwisko: <input id="nazwisko" type="text" name="nazwisko" placeholder="nazwisko"></p>
          <p>Telefon: <input id="telefon" type="text" name="telefon" placeholder="telefon"></p>
          <p>Miasto: <input id="miasto" type="text" name="miasto" placeholder="miasto"></p>
          <p>Ulica: <input id="ulica" type="text" name="ulica" placeholder="ulica"></p>
          <p>nr_domu: <input id="dom" type="text" name="dom" placeholder="nr_domu"></p>
          <p>nr_mieszkania: <input id="mieszkanie" type="text" name="mieszkanie" placeholder="nr_mieszkania"></p><br>

          <input id="przycisk" type="submit" name="submit" value="Zarejestruj sie">
        </form>
        <form action="logowanie_rejestracja.php" style="text-align: left">
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