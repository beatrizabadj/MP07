<?php
require_once "connexio.php";

$sql = "SELECT * FROM usuaris";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

// processament del formulari 
if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['id'])) {
    $id = $_POST['id'] ?? '';
    $nom = $_POST['nom'] ?? '';
    $email = $_POST['email'] ?? '';
    $edat = $_POST['edat'] ?? 0;

    if(!empty($id) && !empty($nom) && !empty($email) && !empty($edat)) {
        
        // valors del usuari
        $stmt = $pdo->prepare("SELECT * FROM usuaris WHERE id = ?");
        $stmt -> execute([$id]);
        $usuari = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // comprovem si s'ha modificat cap camp
        if($usuari && ($usuari['nom'] != $nom || $usuari['email'] != $email || $usuari['edat'] != $edat)){
            
            try{
                // consulta sql
                $stmt = $pdo->prepare("UPDATE usuaris SET nom = ?, email = ?, edat = ? WHERE id = ?");
                $stmt->execute([$nom, $email, $edat,$id]);
                $msg = "<p class='msg'>Usuari modificat correctament.</p>";

                // mostrar usuaris un cop s'ha modificat
                $stmt = $pdo -> prepare("SELECT * FROM usuaris");
                $stmt -> execute();
                $results = $stmt-> fetchAll(PDO::FETCH_ASSOC);                
    
            }catch(PDOException $e){
                $msg = "<p class='msg'>Error: " . $e->getMessage() . "</p>";
        }
            }else{
                 $msg = "<p class='msg'>Sembla que no has canviat res.</p>";
            }
    } else {
        $msg = "<p class='msg'>T'has deixat algun camp sense omplir.</p>";    }
        
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
    <h1>Modificar usuaris</h1>
    <h2>Consulta amb PDO</h2>

    <!-- clase per mostrar el missatge -->
    <?php if(!empty($msg)): ?>
        <div id ="msg"><?=$msg?></div>
    <?php endif; ?>

    <!-- iterem pel llistat d'usuaris  -->
    <?php foreach($results as $row): ?>

        <form method="POST" action="" style="display:flex;flex-direction:column;align-items:center;">
            <p style="font-weight:bold;background-color:green;">Usuari amb id: <?= htmlspecialchars($row['id']) ?></p>
            <input type="hidden" name="id" value="<?= htmlspecialchars($row['id']) ?>">

            <label for="nom">Nom:</label>
            <input type="text" name="nom" value="<?= htmlspecialchars($row['nom'])?>">

            <label for="email">Email:</label>
            <input type="email" name="email" value="<?= htmlspecialchars($row['email'])?>"><br>

            <label for="edat">Edat:</label>
            <input type="number" name="edat" value="<?= htmlspecialchars($row['edat'])?>"><br>

            <button type="submit">Modificar usuari</button>
    </form>
        <?php endforeach; ?>
        
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