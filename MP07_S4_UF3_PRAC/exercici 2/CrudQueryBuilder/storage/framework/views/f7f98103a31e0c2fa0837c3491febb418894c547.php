<!-- resources/views/usuaris/show.blade.php -->

<h1>Detalls de l'Usuari</h1>

<?php if(session('error')): ?>
    <div class="alert alert-danger"><?php echo e(session('error')); ?></div>
<?php endif; ?>

<p><strong>Nom:</strong> <?php echo e($usuari->nom); ?></p>
<p><strong>Email:</strong> <?php echo e($usuari->email); ?></p>
<p><strong>Edat:</strong> <?php echo e($usuari->edat); ?></p>

<a href="<?php echo e(route('usuaris.index')); ?>">Tornar a la llista d'usuaris</a>
<a href="<?php echo e(route('usuaris.edit', $usuari->id)); ?>">Editar</a>
<form action="<?php echo e(route('usuaris.destroy', $usuari->id)); ?>" method="POST" style="display:inline;">
    <?php echo csrf_field(); ?>
    <?php echo method_field('DELETE'); ?>
    <button type="submit">Eliminar</button>
</form>
<?php /**PATH C:\xampp\htdocs\exercicis MP07\UF3\MP07_S4_UF3_PRAC\exercici 2\CrudQueryBuilder\resources\views/usuaris/show.blade.php ENDPATH**/ ?>