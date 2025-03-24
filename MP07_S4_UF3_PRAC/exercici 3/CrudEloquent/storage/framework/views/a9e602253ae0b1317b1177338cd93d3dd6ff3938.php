<h1>Afegir Usuari</h1>

<form action="<?php echo e(route('usuaris.store')); ?>" method="POST">
    <?php echo csrf_field(); ?>
    <label>Nom: <input type="text" name="nom" required></label>
    <label>Email: <input type="email" name="email" required></label>
    <label>Edat: <input type="number" name="edat" required></label>
    <button type="submit">Guardar</button>
</form>

<a href="<?php echo e(route('usuaris.index')); ?>">Tornar</a>
<?php /**PATH C:\xampp\htdocs\exercicis MP07\UF3\MP07_S4_UF3_PRAC\exercici 3\CrudEloquent\resources\views/usuaris/create.blade.php ENDPATH**/ ?>