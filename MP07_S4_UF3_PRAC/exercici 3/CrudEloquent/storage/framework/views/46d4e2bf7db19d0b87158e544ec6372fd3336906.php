<h1>Llista d'usuaris</h1>

<?php if(session('success')): ?>
    <div><?php echo e(session('success')); ?></div>
<?php endif; ?>

<a href="<?php echo e(route('usuaris.create')); ?>">Afegir Usuari</a>

<ul>
    <?php $__currentLoopData = $usuaris; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $usuari): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li>
            <?php echo e($usuari->nom); ?> - <?php echo e($usuari->email); ?> - <?php echo e($usuari->edat); ?> anys
            <a href="<?php echo e(route('usuaris.show', $usuari->id)); ?>">Veure</a>
            <a href="<?php echo e(route('usuaris.edit', $usuari->id)); ?>">Editar</a>
            <form action="<?php echo e(route('usuaris.destroy', $usuari->id)); ?>" method="POST" style="display:inline;">
                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                <button type="submit">Eliminar</button>
            </form>
        </li>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</ul>
<?php /**PATH C:\xampp\htdocs\exercicis MP07\UF3\MP07_S4_UF3_PRAC\exercici 3\CrudEloquent\resources\views/usuaris/index.blade.php ENDPATH**/ ?>