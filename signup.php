<?php
$error = ""; // Initialize a variable for error messages

include("../TEMPLATES/connect.php");

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    // Sjekk om passordene matcher
    if ($password !== $confirmPassword) {
        $error = "Passordene matcher ikke.";
    } else {

        // Sjekk om brukernavnet eller eposten allerede er registrert
        $checkQuery = "SELECT * FROM users WHERE username=? OR email=?";
        $stmt = $con->prepare($checkQuery);
        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $error = "Brukernavn eller epost er allerede i bruk.";
        } else {
            // Ingen eksisterende bruker funnet, fortsett med registrering
            $insertQuery = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
            $stmt = $con->prepare($insertQuery);
            $stmt->bind_param("sss", $username, $email, $hashedPassword);

            if ($stmt->execute()) {
                // Registrering vellykket, omdiriger til login siden
                header("Location: login.php");
                exit;
            } else {
                $error = "En feil oppstod under registreringen.";
            }
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Register</title>
</head>
<body class="bg-light">

<div class="container my-5">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h1 class="card-title text-center">Lag en bruker</h1>
                    <!-- Setter opp error melding -->
                    <?php if (!empty($error)): ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $error; ?>
                        </div>
                    <?php endif; ?>
                    <!--Form for Signup side-->
                    <form method="post" id="signup">
                        <div class="form-group">
                            <label for="username">Brukernavn</label>
                            <input class="form-control" type="text" id="username" name="username" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input class="form-control" type="email" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Passord</label>
                            <input class="form-control" type="password" id="password" name="password" required>
                        </div>
                        <div class="form-group">
                            <label for="confirmPassword">Confirm Passord</label>
                            <input class="form-control" type="password" id="confirmPassword" name="confirmPassword" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block" name="submit">Create</button>
                    </form>
                    <p class="mt-3">
                        Allerede har en bruker? <a href="login.php">Log in</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap js -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
