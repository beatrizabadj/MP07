<h1>Editar Usuari</h1>

<form action="<?php echo e(route('usuaris.update', $usuari->id)); ?>" method="POST">
    <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
    <label>Nom: <input type="text" name="nom" value="<?php echo e($usuari->nom); ?>" required></label>
    <label>Email: <input type="email" name="email" value="<?php echo e($usuari->email); ?>" required></label>
    <label>Edat: <input type="number" name="edat" value="<?php echo e($usuari->edat); ?>" required></label>
    <button type="submit">Actualizar</button>
</form>

<a href="<?php echo e(route('usuaris.index')); ?>">Tornar</a>
<?php /**PATH C:\xampp\htdocs\exercicis MP07\UF3\MP07_S4_UF3_PRAC\exercici 3\CrudEloquent\resources\views/usuaris/edit.blade.php ENDPATH**/ ?>