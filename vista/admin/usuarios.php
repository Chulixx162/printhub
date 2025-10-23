<?php include('header.php');
if ($_SESSION['rol'] !== 'ADMIN') {
  header("Location: vista_general.php");
  exit();
}
?>
<style>
  .main-content {
    padding: 1rem;
  }

  .table-container {
    width: 100%;
    overflow-x: auto;
    overflow-y: hidden;
  }

  table {
    min-width: 100%;
  }

  th,
  td {
    overflow-wrap: break-word;
    min-width: 120px;
    text-align: left;
    vertical-align: middle;
  }

  @media (max-width: 768px) {
    .table {
      font-size: 0.85rem;
    }

    .btn {
      font-size: 0.75rem;
      padding: 0.25rem 0.5rem;
    }
  }

  @media (min-width: 768px) {
    .table {
      font-size: 0.85rem;
    }

    .btn {
      font-size: 0.75rem;
      padding: 0.25rem 0.5rem;
    }
  }
</style>

<body>
  <?php include '../../conexion.php';
  include '../../modelo/usuarios_m.php';
  $usuarios = obtenerUsuarios($conn); ?>
  <div class="d-flex flex-column flex-lg-row">

    <?php include('sidebar.php'); ?>

    <!-- Contenido principal -->
    <div class="flex-grow-1">
      <nav class="navbar navbar-dark">
        <div class="container-fluid">
          <span class="navbar-brand">Gestión de USUARIOS</span>
          <div class="dataTables_filter">
            <input type="search" id="buscar" class="form-control form-control-sm" placeholder="Buscar...">
          </div>
        </div>
      </nav>

      <div class="main-content">
        <div class="d-flex justify-content-between align-items-center mb-4">
          <h2 class="mb-0 mt-4">USUARIOS</h2>
          <?php if ($_SESSION['rol'] == 'ADMIN'): ?>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalusuarios">
              <i class="fas fa-plus me-2"></i>Nuevo Usuario
            </button>
          <?php endif; ?>
        </div>

        <!-- Tabla -->
        <div class="table-container">
          <table class="table table-striped table-hover align-middle">
            <thead class="table-dark">
              <tr>
                <th><i class="fas fa-id-badge"></i> ID</th>
                <th><i class="fas fa-user"></i> Nombre</th>
                <th><i class="fas fa-envelope"></i> Correo</th>
                <th><i class="fas fa-user-tag"></i> Rol</th>
                <?php if ($_SESSION['rol'] == 'ADMIN'): ?>
                  <th><i class="fas fa-phone"></i> Contacto_1</th>
                  <th><i class="fas fa-mobile-alt"></i> Contacto_2</th>
                  <th><i class="fas fa-cogs"></i> Acciones</th>
                <?php endif; ?>
              </tr>
            </thead>

            <?php foreach ($usuarios as $usuario): ?>

              <tbody>

                <tr>
                  <td><?= $usuario['id'] ?></td>
                  <td><?= $usuario['nombre'] ?></td>
                  <td><?= $usuario['correo'] ?></td>
                  <td><?= $usuario['rol'] ?></td>
                  <?php if ($_SESSION['rol'] == 'ADMIN'): ?>
                    <td>
                      <a href="https://wa.me/57<?= preg_replace('/\D/', '', $usuario['contacto_1']) ?>" target="_blank">
                        <?= $usuario['contacto_1'] ?>
                      </a>
                    </td>

                    <td>
                      <a href="https://wa.me/57<?= preg_replace('/\D/', '', $usuario['contacto_2']) ?>" target="_blank">
                        <?= $usuario['contacto_2'] ?>
                      </a>
                    </td>
                  <?php endif; ?>
                  <?php if ($_SESSION['rol'] == 'ADMIN'): ?>
                    <td>
                      <button class="btn btn-sm btn-outline-primary me-2" data-bs-toggle="modal"
                        data-bs-target="#modalEditar<?= $usuario['id'] ?>"><i class="fas fa-edit"></i></button>
                      <!-- <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash-alt"></i></button> -->

                      <button class="btn btn-sm btn-outline-danger"
                        onclick="eliminar(event, <?= $usuario['id'] ?>)"><i class="fas fa-trash-alt"></i>
                      </button>



                    </td>
                  <?php endif; ?>
                </tr>

                <!-- Más usuarios aquí -->

              </tbody>


              <!--Modal editar Usuario -->
              <div class="modal fade" id="modalEditar<?= $usuario['id'] ?>" tabindex="-1" aria-labelledby="modalEditarLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                      <h5 class="modal-title" id="modalEditarLabel">Editar Usuario</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>
                    <div class="modal-body">
                      <form action="../../controlador/usuarios_c.php?accion=actualizar" method="POST">
                        <input type="hidden" name="id" value="<?= $usuario['id'] ?>" />
                        <!-- <div class="mb-3">
                        <label for="contacto1usuarios" class="form-label">Imagen</label>
                        <input type="file" id="imagen" name="imagen" accept="image/*" class="form-control" />
                      </div> -->
                        <div class="mb-3">
                          <label for="nombreusuarios" class="form-label">Nombre</label>
                          <input type="text" class="form-control" name="nombre" value="<?= $usuario['nombre'] ?>" />
                        </div>

                        <div class="mb-3">
                          <label for="correousuarios" class="form-label">Correo</label>
                          <input type="email" class="form-control" name="UserEmail" value="<?= $usuario['correo'] ?>" />
                        </div>
                        <?php if ($_SESSION['rol'] == 'ADMIN'): ?>
                          <div class="mb-3">
                            <label for="rolusuario<?= $usuario['id'] ?>" class="form-label">Rol</label>
                            <select class="form-select" name="rolUsuario" id="rolusuario<?= $usuario['id'] ?>">
                              <option value="ADMIN" <?= $usuario['rol'] == "ADMIN" ? 'selected' : '' ?>>Administrador</option>
                              <option value="AGENTE" <?= $usuario['rol'] == "AGENTE" ? 'selected' : '' ?>>Agente</option>
                              <option value="ATENCION_CLIENTE" <?= $usuario['rol'] == "ATENCION_CLIENTE" ? 'selected' : '' ?>>Atención al Cliente</option>
                            </select>
                          </div>
                        <?php endif; ?>

                        <div class="mb-3">
                          <label for="contacto1usuarios" class="form-label">Contacto_1</label>
                          <input type="number" class="form-control" name="contacto1" value="<?= $usuario['contacto_1'] ?>" />
                        </div>
                        <div class="mb-3">
                          <label for="contacto2usuarios" class="form-label">Contacto_2</label>
                          <input type="number" class="form-control" name="contacto2" value="<?= $usuario['contacto_2'] ?>" />
                        </div>
                        <?php if ($_SESSION['rol'] == 'ADMIN'): ?>
                          <details>
                            <summary>Nueva contraseña (opcional)</summary>
                            <div class="mb-3 mt-4">
                              <label for="contrasena_<?= $usuario['id'] ?>">Contraseña:</label>
                              <input
                                type="password"
                                class="form-control"
                                id="contrasena_<?= $usuario['id'] ?>"
                                name="cambiarClave"
                                placeholder="Llena este campo si deseas cambiar la contraseña"
                                autocomplete="new-password">
                              <ul class="mt-2" id="passwordRequirements_<?= $usuario['id'] ?>">
                                <li id="length_<?= $usuario['id'] ?>" class="text-danger">❌ Mínimo 8 caracteres</li>
                                <li id="lowercase_<?= $usuario['id'] ?>" class="text-danger">❌ Al menos una letra minúscula</li>
                                <li id="uppercase_<?= $usuario['id'] ?>" class="text-danger">❌ Al menos una letra mayúscula</li>
                                <li id="number_<?= $usuario['id'] ?>" class="text-danger">❌ Al menos un número</li>
                                <li id="special_<?= $usuario['id'] ?>" class="text-danger">❌ Al menos un carácter especial (!@#$%^&*)</li>
                              </ul>

                            </div>
                          </details>

                          <script>
                            (function() {
                              const id = <?= $usuario['id'] ?>;
                              const form = document.querySelector(`#modalEditar<?= $usuario['id'] ?> form`);
                              const passwordInput = document.getElementById('contrasena_' + id);

                              const rules = {
                                length: {
                                  regex: /.{8,}/,
                                  element: document.getElementById('length_' + id)
                                },
                                lowercase: {
                                  regex: /[a-z]/,
                                  element: document.getElementById('lowercase_' + id)
                                },
                                uppercase: {
                                  regex: /[A-Z]/,
                                  element: document.getElementById('uppercase_' + id)
                                },
                                number: {
                                  regex: /[0-9]/,
                                  element: document.getElementById('number_' + id)
                                },
                                special: {
                                  regex: /[\W_]/,
                                  element: document.getElementById('special_' + id)
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

                              form.addEventListener('submit', (e) => {
                                const value = passwordInput.value.trim();

                                // Solo validar si se quiere cambiar la contraseña
                                if (value !== "") {
                                  const requisitosCumplidos = Object.values(rules).every(rule => rule.regex.test(value));

                                  if (!requisitosCumplidos) {
                                    e.preventDefault(); // Evita el envío del formulario
                                    informar2('Tu contraseña debe cumplir todos los requisitos:\n- Mínimo 8 caracteres\n- Una mayúscula\n- Una minúscula\n- Un número\n- Un carácter especial (!@#$%^&*)', 'Ok');
                                    // Mostrar alerta personalizada

                                  }
                                }
                              });
                            })();

                            function informar2(texto, icono) {
                              Swal.fire({
                                title: texto,
                                icon: icono,
                                draggable: true
                              });
                            }
                          </script>
                        <?php endif; ?>
                        <div class="modal-footer">
                          <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                          <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>

                      </form>
                    </div>

                  </div>

                </div>

              </div>
            <?php endforeach; ?>
          </table>
        </div>
      </div>
    </div>
  </div>



  <!-- Modal de nuevo usuarios -->

  <div class="modal fade" id="modalusuarios" tabindex="-1" aria-labelledby="modalusuariosLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title" id="modalusuariosLabel">Nuevo Usuario</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
          <form action='../../controlador/usuarios_c.php?accion=registrar' method="POST">
            <!-- <div class="mb-3">
              <label for="contacto1usuarios" class="form-label">Imagen</label>
              <input type="file" id="imagen" name="imagen" accept="image/*" class="form-control" />
            </div> -->
            <div class="mb-3">
              <label for="nombreusuarios" class="form-label">Nombre</label>
              <input type="text" class="form-control" name="nombre" id="nombreusuarios" required />
            </div>
            <div class="mb-3">
              <label for="correousuarios" class="form-label">Correo</label>
              <input type="email" class="form-control" name="UserEmail" id="correousuarios" required />
            </div>
            <div class="mb-3">
              <label for="rolusuarios" class="form-label">Rol</label>

              <select class="form-select" name="rolUsuario" id="rolusuarios" required>
                <option value="ADMIN">Administrador</option>
                <option value="AGENTE">Agente</option>
                <option value="ATENCION_CLIENTE">Atención al Cliente</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="contacto1usuarios" class="form-label">Contacto_1</label>
              <input type="number" name="contacto1" class="form-control" id="contacto1usuarios" required />
            </div>
            <div class="mb-3">
              <label for="contacto2usuarios" class="form-label">Contacto_2</label>
              <input type="number" name="contacto2" class="form-control" id="contacto2usuarios" />
            </div>
            <div class="mb-3">
              <label for="claveusuario" class="form-label">CLAVE</label>
              <input type="password" name="clave" class="form-control" id="claveusuario" required />
            </div>

            <div class="modal-footer">
              <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
              <button class="btn btn-primary" type="submit">Guardar</button>
            </div>
          </form>
        </div>

      </div>
    </div>
  </div>

  <?php include('footer.php'); ?>
  <script>
    async function eliminar(event, id) {
      event.preventDefault();
      const confirmarSalida = await confirmar(
        '¿Estás seguro de que deseas eliminar a este USUARIO?',
        'SÍ', 'No', 'warning'
      );

      if (confirmarSalida) {
        window.location.href = `../../controlador/usuarios_c.php?accion=eliminar&id=${id}`;
      }
    }

    // Filtro de búsqueda
    document.getElementById("buscar").addEventListener("keyup", function() {
      const filtro = this.value.toLowerCase();
      const filas = document.querySelectorAll(".table-container tbody tr");

      filas.forEach(fila => {
        const textoFila = fila.textContent.toLowerCase();
        fila.style.display = textoFila.includes(filtro) ? "" : "none";
      });
    });
  </script>

  <script src="../../libs/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>