<h1>Iniciar Sesión</h1>
//Juan revisa esto, porfa
<?php if (!empty($error)): ?>
<p style="color:red;"><?php echo $error; ?></p>
<?php endif; ?>

<form method="POST">
    <label>Usuario</label><br>
    <input type="text" name="username"><br><br>

    <label>Contraseña</label><br>
    <input type="password" name="password"><br><br>

    <button type="submit">Ingresar</button>
</form>

<p>¿No tienes cuenta? <a href="/?page=security/register">Registrarse</a></p>
