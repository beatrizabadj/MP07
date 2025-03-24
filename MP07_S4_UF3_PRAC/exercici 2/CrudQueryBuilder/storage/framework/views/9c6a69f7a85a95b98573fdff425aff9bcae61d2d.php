<!-- resources/views/usuaris/edit.blade.php -->

<h1>Edita Usuari</h1>

<?php if(session('error')): ?>
    <div class="alert alert-danger"><?php echo e(session('error')); ?></div>
<?php endif; ?>

<!-- Formulario para editar -->
<form action="<?php echo e(route('usuaris.update', $usuari->id)); ?>" method="POST">
    <?php echo csrf_field(); ?>
    <?php echo method_field('PUT'); ?>
    
    <div>
        <label for="nom">Nom:</label>
        <input type="text" name="nom" id="nom" value="<?php echo e(old('nom', $usuari->nom)); ?>" required>
        <?php $__errorArgs = ['nom'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <div class="alert alert-danger"><?php echo e($message); ?></div>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
    
    <div>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="<?php echo e(old('email', $usuari->email)); ?>" required>
        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <div class="alert alert-danger"><?php echo e($message); ?></div>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
    
    <div>
        <label for="edat">Edat:</label>
        <input type="number" name="edat" id="edat" value="<?php echo e(old('edat', $usuari->edat)); ?>" required>
        <?php $__errorArgs = ['edat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <div class="alert alert-danger"><?php echo e($message); ?></div>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
    
    <button type="submit">Actualizar Usuari</button>
</form>

<a href="<?php echo e(route('usuaris.index')); ?>">Tornar a la llista d'usuaris</a>
<?php /**PATH C:\xampp\htdocs\exercicis MP07\UF3\MP07_S4_UF3_PRAC\exercici 2\CrudQueryBuilder\resources\views/usuaris/edit.blade.php ENDPATH**/ ?>