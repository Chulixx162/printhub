<?php
// include '../../conexion.php';
// include '../../modelo/clientes_m.php';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Cuenta - JYS</title>
    <link rel="icon" href="../../IMAGENES/Logotipo_sinsombrapng_Mesa de trabajo 1-02.png">
    <link rel="stylesheet" href="../../libs/bootstrap-icons-1.11.3/a/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../../libs/bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(to right, #1CB5E0, #000046);
            color: #fff;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Segoe UI', sans-serif;
        }

        .register-box {
            background: linear-gradient(to right, #0ED2F7, #B2FEFA);
            border-radius: 20px;
            padding: 40px;
            max-width: 500px;
            width: 100%;
            color: #000;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
        }

        .register-box h2 {
            text-align: center;
            margin-bottom: 30px;
            font-weight: bold;
            color: #017C86;
        }

        .form-control,
        .form-select {
            background-color: #e0f7f9;
            border: 2px solid #017C86;
            color: #000;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #009CA6;
            box-shadow: 0 0 0 0.2rem rgba(0, 156, 166, 0.25);
        }

        .btn-custom {
            background-color: #017C86;
            color: white;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .btn-custom:hover {
            background-color: #009CA6;
            transform: translateY(-2px);
        }

        .logo {
            display: block;
            margin: 0 auto 20px;
            width: 50%;
        }
    </style>
</head>

<body>

    <div class="register-box mt-5 mb-5">
        <!-- <img src="../../IMAGENES/Logotipo_sinsombrapng_Mesa de trabajo 1-02.png" alt="Logo JYS" class="logo"> -->
        <h2><i class="bi bi-person-plus-fill"></i> Crear Cuenta</h2>
        <form action="../../controlador/clientes_c.php?accion=registrar" method="POST" autocomplete="on">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre completo:</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Tu nombre completo" required autocomplete="name">
                </div>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Correo electrónico:</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
                    <input type="email" class="form-control" id="email" name="email" placeholder="nombre@ejemplo.com" required autocomplete="email">
                </div>
            </div>
            <div class="mb-3">
                <label for="tipo_documento" class="form-label">Tipo de Documento:</label>
                <select class="form-select" name="tipo_documento" id="tipo_documento" required>
                    <option value="">Selecciona...</option>
                    <option value="CC">Cédula de Ciudadanía</option>
                    <option value="PASAPORTE">Pasaporte</option>
                    <option value="CE">Cédula de Extranjería</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="numero_documento" class="form-label">Número de Documento:</label>
                <input type="text" class="form-control" id="numero_documento" name="numero_documento" placeholder="Número de Documento" required>
            </div>
            <div class="mb-3">
                <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento:</label>
                <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required>
            </div>
            <div class="mb-3">
                <label for="contacto1" class="form-label">Contacto 1:</label>
                <input type="number" class="form-control" id="contacto1" name="contacto1" placeholder="3123456789" required>
                <small class="form-text text-muted">Formato: 3XXXXXXXXX</small>
            </div>
            <div class="mb-3">
                <label for="contacto2" class="form-label">Contacto 2 (opcional):</label>
                <input type="number" class="form-control" id="contacto2" name="contacto2" placeholder="3213456789">
            </div>
            <div class="mb-3">
                <label for="direccion" class="form-label">Dirección:</label>
                <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Teruel, Cra 3e# 5-13" autocomplete="address-line1">
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Contraseña:</label>
                <input
                    type="password"
                    class="form-control"
                    id="password"
                    name="clave"
                    placeholder="Crea una contraseña"
                    required
                    autocomplete="new-password">
                <ul class="mt-2" id="passwordRequirements" style="list-style: none; padding-left: 0;">
                    <li id="length" class="text-danger">❌ Mínimo 8 caracteres</li>
                    <li id="lowercase" class="text-danger">❌ Al menos una letra minúscula</li>
                    <li id="uppercase" class="text-danger">❌ Al menos una letra mayúscula</li>
                    <li id="number" class="text-danger">❌ Al menos un número</li>
                    <li id="special" class="text-danger">❌ Al menos un carácter especial (!@#$%^&*)</li>
                </ul>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-lg btn-custom">
                    <i class="bi bi-check-circle-fill"></i> Registrarse
                </button>
            </div>
            <div class="mt-3 text-center">
                <a href="../login.php" class="text-decoration-none" style="color: #017C86;">
                    <i class="bi bi-box-arrow-in-right"></i> ¿Ya tienes cuenta? - Inicia sesión
                </a>
            </div>
        </form>
    </div>

    <script src="../../libs/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
    <small id="passwordHelp" class="text-muted"></small>

    <script>
        const passwordInput = document.getElementById('password');

        const rules = {
            length: {
                regex: /.{8,}/,
                element: document.getElementById('length')
            },
            lowercase: {
                regex: /[a-z]/,
                element: document.getElementById('lowercase')
            },
            uppercase: {
                regex: /[A-Z]/,
                element: document.getElementById('uppercase')
            },
            number: {
                regex: /[0-9]/,
                element: document.getElementById('number')
            },
            special: {
                regex: /[\W_]/,
                element: document.getElementById('special')
            }
        };

        passwordInput.addEventListener('input', () => {
            const value = passwordInput.value;

            for (const key in rules) {
                const {
                    regex,
                    element
                } = rules[key];
                if (regex.test(value)) {
                    element.classList.remove('text-danger');
                    element.classList.add('text-success');
                    element.innerHTML = '✅ ' + element.textContent.slice(2);
                } else {
                    element.classList.remove('text-success');
                    element.classList.add('text-danger');
                    element.innerHTML = '❌ ' + element.textContent.slice(2);
                }
            }
        });
    </script>

</body>

</html>