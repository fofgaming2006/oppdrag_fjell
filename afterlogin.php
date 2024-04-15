<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <title>Welcome</title>
    <style>
        .container {
            margin-top: 50px;
        }
        .status-button {
            margin-top: 20px;
        }
    </style>
</head>
<body>

  <!-- Logg Ut Knapp -->
  <a href="../LOGINSYSTEM/login.php" class="btn btn-primary">Logg Ut</a>

<div class="container text-center">
    <h1>Velkommen Til Siden!</h1>
    <p class="lead">Her kan du sjekke status og lage din egen beskrivelse til problemet </p>
    <!-- Knapper for å sende deg til status -->
    <a href="../TEMPLATES/status.php" class="btn btn-primary status-button">Sjekk Status </a>
    <a href="../TEMPLATES/beskrivelse.php" class="btn btn-success status-button">Legg til Henvendelse</a>
</div>

<!-- Bootstrap JS-->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js" integrity="sha384-ZzWQbP+T6ABK1K3/6AZPnloj3oVJpXjNPAZ+L9T7I0OU5uee3Vo6+PFJ8T8DJwuI" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8F6eKJ6QlXnAD/eKgBdfLEMWu5Vfv8PcH8T26c" crossorigin="anonymous"></script>

</body>
</html>
