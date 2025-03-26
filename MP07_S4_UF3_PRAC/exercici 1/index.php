<?php
session_start(); //per poder emmagatzemar dades

require_once "connexio.php";

$sql = "SELECT * FROM usuaris";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

// processament del formulari 
if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['id'])) {
    $id = $_POST['id'] ?? '';

    if(!empty($id)) {
        try{
            // consulta sql
            $stmt = $pdo->prepare("DELETE FROM usuaris WHERE id = ?");
            $stmt->execute([$id]);
            $_SESSION['msg'] = "<p class='msg'>Usuari esborrat correctament.</p>";
            
            // redirigir usuari
            header('Location: index.php');
            exit;
        }catch(PDOException $e){

            $_SESSION['msg'] = "<p class='msg'>Error: " . $e->getMessage() . "</p>";
        }
    } else {

        $_SESSION['msg'] = "<p class='msg'>Aquest usuari no existeix.</p>";    }
}

// actualitzar llista despres de l'eliminació

$sql = "SELECT * FROM usuaris";
$stmt = $pdo ->prepare($sql);
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Llista d'usuaris</h1>
    <h2>Consulta amb PDO</h2>
        <!-- mostrar missatge -->
        <?php if (isset($_SESSION['msg'])): ?>
            <div id="msg"><?= $_SESSION['msg']; ?></div>
            <?php unset($_SESSION['msg']); ?>
        <?php endif; ?>

    <ul>
        <!-- iterem pels users -->
        <?php foreach($results as $row): ?>
            <li>Usuari: <?= htmlspecialchars($row['id']) ?> </li>
            <li>Nom: <?= htmlspecialchars($row['nom']) ?> </li>
            <li>Email: <?= htmlspecialchars($row['email']) ?> </li>
            <li>Edat: <?= htmlspecialchars($row['edat']) ?> </li>
            
            <!-- formulari per esborrar -->
            <form method="POST">
                <input type="hidden" name="id" value="<?=$row['id'] ?>">
                <button type="submit">Esborrar</button>
            </form>
            <br><br>
        <?php endforeach; ?>
    </ul>
    <script>
            // eliminacio del missatge al cap de 3s
            setTimeout(()=> {
                let msg = document.getElementById('msg');
                if(msg) {
                    msg.remove(); 
                }
            }, 3000);

        </script>
</body>
</html>