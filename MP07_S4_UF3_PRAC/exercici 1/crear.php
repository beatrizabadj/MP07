<?php
session_start(); //per poder emmagatzemar dades

require_once 'connexio.php';

// consulta sql
if($_SERVER["REQUEST_METHOD"] === "POST") {
    $nom = $_POST['nom'] ?? '';
    $email = $_POST['email'] ?? '';
    $edat = $_POST['edat'] ?? 0;

    if(!empty($nom) && !empty($email) && !empty($edat)){

        try{
            // consulta sql per insertar l'usuari
            $stmt = $pdo->prepare("INSERT INTO usuaris (nom, email, edat) VALUES (?,?,?)");
            $stmt->execute([$nom, $email, $edat]);
            
            // emmagatzem el missatge
            $_SESSION['msg'] = "<p class='msg'>Usuari inserit correctament.</p>";
            
            // redirigir usuari
            header('Location: index.php');
            exit;

        }catch(PDOException $e){

            $_SESSION['msg'] = "<p class='msg'>Error " . $e ->getMessage() . "</p>";
        }
    }else{
        $_SESSION['msg'] = "<p class='msg'> T'has deixat algun camp sense omplir. </p>";
    }
}

 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
        <h1>Inserta un usuari</h1>
        <h2>Consulta amb PDO</h2>

        <!-- mostrar missatge -->
        <?php if (isset($_SESSION['msg'])): ?>
            <div id="msg"><?= $_SESSION['msg']; ?></div>
            <?php unset($_SESSION['msg']); ?>
        <?php endif; ?>

        <!-- formulari per crear l'usuari -->
        <form method="POST" action="">
        <label for="nom">Nom:</label>
        <input type="text" name="nom" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" required><br>

        <label for="edat">Edat:</label>
        <input type="number" name="edat" required><br>

        <button type="submit">Insertar usuari</button>
    </form>

    <!-- tornar al llistat -->
    <p><a href="index.php">Tornar al llistat d'usuaris</a></p> 
    <script>

            setTimeout(()=> {
                let msg = document.getElementById('msg');
                if(msg) {
                    msg.remove(); // quitar el mensaje
                }
            }, 3000);

        </script>
</body>
</html>