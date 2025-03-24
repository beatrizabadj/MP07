<!-- resources/views/usuaris/create.blade.php -->

<h1>Crear Usuari</h1>

<?php if(session('error')): ?>
    <div class="alert alert-danger"><?php echo e(session('error')); ?></div>
<?php endif; ?>

<form action="<?php echo e(route('usuaris.store')); ?>" method="POST">
    <?php echo csrf_field(); ?>
    <div>
        <label for="nom">Nom:</label>
        <input type="text" name="nom" id="nom" required>
    </div>
    <div>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>
    </div>
    <div>
        <label for="edat">Edat:</label>
        <input type="number" name="edat" id="edat" required>
    </div>
    <button type="submit">Crear Usuari</button>
</form>

<a href="<?php echo e(route('usuaris.index')); ?>">Tornar a la llista d'usuaris</a>
<?php /**PATH C:\xampp\htdocs\exercicis MP07\UF3\MP07_S4_UF3_PRAC\exercici 2\CrudQueryBuilder\resources\views/usuaris/create.blade.php ENDPATH**/ ?>