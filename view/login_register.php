<div class="container1" id="container">
    <div class="form-container sing-up" >
        <form action="index.php?controller=user&action=register" method="POST">
            <h1>Crear usuario</h1>
            <span>Por favor, elige un nombre de usuario único y crea una contraseña segura. ¡Bienvenido a nuestro servicio!</span>
            <input type="text" name="username" placeholder = "Usuario" required>
            <input type="password" name="password" placeholder = "Contraseña" required>
            <input class="btn btn-primary" type="submit" value="Registrarse"/>
        </form>
    </div>
    <div class="form-container sing-in">
        <form action="index.php?controller=user&action=login" method="POST">
            <h1>Iniciar Sessión</h1>
            <span>Ingrese su usuario y contraseña.</span>
            <input type="text" name="username" placeholder = "Usuario" required>
            <input type="password" name="password" placeholder = "Contraseña" required>
            <input type="submit" value="Iniciar sesión" class="btn btn-primary "/>
        </form>
    </div>
    <div class="toggle-container">
        <div class="toggle">
            <div class="toggle-panel toggle-left">
                <h1>¡Bienvenido de nuevo!</h1>
                <p>Ingresa tus datos personales para utilizar todas las funciones del sitio.</p>
                <button class="hidden" id="login">Iniciar Sesión</button>

            </div>
            <div class="toggle-panel toggle-right">
                <h1>¡Hola, Amigo!</h1>
                <p>¡Descubre todo lo que nuestro sitio tiene para ofrecer! Regístrate y disfruta de todas las funciones disponibles.</p>
                <button class="hidden" id="register">Registrarse</button>

            </div>
        </div>
    </div>
</div>

<script>
    const container = document.getElementById('container');
    const registerBtn = document.getElementById('register');
    const loginBtn = document.getElementById('login');

    registerBtn.addEventListener('click', () => {
        container.classList.add("active");
    });

    loginBtn.addEventListener('click', () => {
        container.classList.remove("active");
    });
</script>
