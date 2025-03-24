<h1>Detalls de l'usuari</h1>

<p><strong>Nom:</strong> <?php echo e($usuari->nom); ?></p>
<p><strong>Email:</strong> <?php echo e($usuari->email); ?></p>
<p><strong>Edat:</strong> <?php echo e($usuari->edat); ?></p>

<a href="<?php echo e(route('usuaris.index')); ?>">Tornar</a>
<?php /**PATH C:\xampp\htdocs\exercicis MP07\UF3\MP07_S4_UF3_PRAC\exercici 3\CrudEloquent\resources\views/usuaris/show.blade.php ENDPATH**/ ?>