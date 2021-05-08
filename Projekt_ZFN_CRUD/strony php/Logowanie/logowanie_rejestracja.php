<!DOCTYPE html>
<html lang="pl">

<head>
   <meta charset="UTF-8">
   <title>Logowanie</title>
   <link rel="stylesheet" href="../../style.css">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta http-equiv="x-ua-compatible" content="ie=edge">
<style>
  a:link {color: green;}
  a:visited {color: green;}
  a:active {color: violet;}
</style>
</head>

<body>
  <div class="naglowek"><h2>Zwierzoluby z Fajną Nazwą</h2></div>
      <article>
        <form id="zaloguj" method="post" action="logowanie.php">
          <p>Nick: <input id="nick" type="text" name="nick" 
              placeholder="Nick:" value="Tala"></p>
          <p>Hasło: <input id="haslo" type="password" name="haslo" 
            placeholder="hasło:"  value="tala"></p>        
          <input id="przycisk" type="submit" value="Zaloguj">
        </form>
        <p> Nie masz jeszcze konta? <a href="rejestracja.php">Zarejestruj Się</a></p>
      </article>
    </section>

    <footer>
      <p> © Natalia Koć</p>
    </footer>
</body>
</html>