<?php
// Inkluderer database tilkobling
include("../TEMPLATES/connect.php");
session_start(); // Starter session for å lagre brukerdata

$error = ''; // Gir error melding

if (isset($_POST['submit'])) {
    $username = trim($_POST['username']); // Trim whitespace
    $password = trim($_POST['password']);

    if (empty($username) || empty($password)) {
        // Sjekker om feltet er tomt
        $error = "Brukernavn og passord er nødvendige.";
    } else {
        // BRuker Prepared Statements for å forhinde SQL-Injeksjon
        $query = "SELECT * FROM users WHERE Username = ?";
        $stmt = $con->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user_data = $result->fetch_assoc();
            // Verifiserer passord
            if (password_verify($password, $user_data['Password'])) {
                $_SESSION['ID'] = $user_data['ID'];
                $_SESSION['username'] = $user_data['Username'];
                header('Location: afterlogin.php'); // Redirect to after login page on successful login
                exit;
            } else {
                $error = "Feil brukernavn eller passord.";
            }
        } else {
            $error = "Feil brukernavn eller passord.";
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
    <title>Log In</title>
</head>
<body class="bg-light">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card my-5">
                <div class="card-body">
                    <h1 class="card-title text-center">Log-In</h1>
                    <?php if (!empty($error)): ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo htmlspecialchars($error); ?>
                        </div>
                    <?php endif; ?>

                    <!--Form for Login side-->
                    <form method="post" action="">
                        <div class="form-group">
                            <label for="username">Brukernavn</label>
                            <input class="form-control" type="text" id="username" name="username" placeholder="Username" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Passord</label>
                            <input class="form-control" type="password" id="password" name="password" placeholder="Password" required>
                        </div>
                        <button type="submit" class="btn btn-primary" name="submit">LogIn</button>
                    </form>
                    <p class="mt-3">
                        <a href="signup.php">Har ikke en bruker? Signup nå</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
