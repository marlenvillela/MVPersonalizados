<h1>Crear Cuenta</h1>
// alerta de regiter
<?php if (!empty($error)): ?>
<p style="color:red;"><?php echo $error; ?></p>
<?php endif; ?>

<form method="POST">
    <label>Usuario</label><br>
    <input type="text" name="username"><br><br>

    <label>Contraseña</label><br>
    <input type="password" name="password"><br><br>

    <button type="submit">Registrar</button>
</form>
