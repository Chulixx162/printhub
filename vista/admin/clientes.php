<?php include('header.php'); ?>
<style>
  .main-content {
    padding: 1rem;
  }

  /* Contenedor con scroll solo en móviles */
  .table-container {
    width: 100%;
    overflow-x: auto;
  }

  table {
    width: 100%;
    border-collapse: collapse;
  }

  th,
  td {
    word-wrap: break-word;
    text-align: center;
    vertical-align: middle;
  }

  /* Estilos para pantallas pequeñas */
  @media (max-width: 576px) {
    .table {
      font-size: 0.75rem;
    }

    .btn {
      font-size: 0.7rem;
      padding: 0.25rem 0.4rem;
    }

    h2 {
      font-size: 1rem;
    }

    .navbar .form-control {
      font-size: 0.75rem;
    }

    .modal-dialog {
      margin: 0.5rem;
      width: 95% !important;
    }

    /* en móviles, damos un ancho mínimo para que aparezca el scroll */
    table {
      min-width: 800px;
    }
  }

  /* Tablets */
  @media (min-width: 577px) and (max-width: 991px) {
    .table {
      font-size: 0.85rem;
    }

    .btn {
      font-size: 0.75rem;
      padding: 0.3rem 0.6rem;
    }

    h2 {
      font-size: 1.2rem;
    }

    .modal-dialog {
      width: 90% !important;
    }

    table {
      min-width: 900px;
    }
  }

  /* Escritorio */
  @media (min-width: 992px) {
    .table {
      font-size: 0.9rem;
    }

    .btn {
      font-size: 0.8rem;
      padding: 0.35rem 0.75rem;
    }

    .modal-dialog {
      max-width: 800px;
    }

    /* En escritorio NO forzamos min-width → se adapta sin scroll */
    table {
      min-width: unset;
    }
  }
</style>


<body>
  <?php
  include '../../conexion.php';
  include '../../modelo/clientes_m.php';
  $clientes = obtenerClientes($conn);
  ?>

  <div class="d-flex flex-column flex-lg-row">
    <?php include('sidebar.php'); ?>

    <div class="flex-grow-1">
      <!-- Navbar -->
      <nav class="navbar navbar-dark" style="background-color: #0077b6;">
        <div class="container-fluid">
          <span class="navbar-brand text-white">Gestión de Clientes</span>
          <div class="dataTables_filter ms-auto">
            <input type="search" id="buscar" class="form-control form-control-sm" placeholder="Buscar...">
          </div>
        </div>
      </nav>

      <!-- Contenido principal -->
      <div class="main-content">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4">
          <h2 class="mb-3 mb-md-0 mt-4">Clientes</h2>
        </div>

        <!-- Tabla responsive -->
        <div class="table-container">
          <table class="table table-striped table-hover align-middle">
            <thead class="table-dark text-center">
              <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Tipo Doc.</th>
                <th>Número</th>
                <th>Nacimiento</th>
                <th>Registro</th>
                <th>Correo</th>
                <th>Contacto 1</th>
                <th>Contacto 2</th>
                <th>Dirección</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($clientes as $cliente): ?>
                <tr>
                  <td><?= $cliente['id'] ?></td>
                  <td><?= $cliente['nombre'] ?></td>
                  <td><?= $cliente['tipo_documento'] ?></td>
                  <td><?= $cliente['numero_documento'] ?></td>
                  <td><?= $cliente['fecha_nacimiento'] ?></td>
                  <td><?= $cliente['fecha_registro'] ?></td>
                  <td><?= $cliente['correo'] ?></td>
                  <td>
                    <a href="https://wa.me/57<?= preg_replace('/\D/', '', $cliente['contacto_1']) ?>" target="_blank">
                      <?= $cliente['contacto_1'] ?>
                    </a>
                  </td>
                  <td>
                    <a href="https://wa.me/57<?= preg_replace('/\D/', '', $cliente['contacto_2']) ?>" target="_blank">
                      <?= $cliente['contacto_2'] ?>
                    </a>
                  </td>
                  <td><?= $cliente['direccion'] ?></td>
                  <td>
                    <button class="btn btn-sm btn-outline-primary m-2" data-bs-toggle="modal"
                      data-bs-target="#modalEditar<?= $cliente['id'] ?>">
                      <i class="fas fa-edit"></i>
                    </button>
                    <button class="btn btn-sm btn-outline-danger"
                      onclick="eliminar(event, <?= $cliente['id'] ?>)">
                      <i class="fas fa-trash-alt"></i>
                    </button>
                  </td>
                </tr>

                <!-- Modal Editar Cliente -->
                <div class="modal fade" id="modalEditar<?= $cliente['id'] ?>" tabindex="-1">
                  <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                      <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Editar Cliente</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                      </div>
                      <div class="modal-body">
                        <form action="../../controlador/clientes_c.php?accion=actualizar" method="POST">
                          <input type="hidden" name="id" value="<?= $cliente['id'] ?>" />

                          <!-- Formulario en grid -->
                          <div class="row g-3">
                            <div class="col-sm-6">
                              <label class="form-label">Nombre</label>
                              <input type="text" class="form-control" name="nombre" value="<?= $cliente['nombre'] ?>">
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label">Tipo Doc.</label>
                              <select class="form-select" name="tipo_documento">
                                <?php
                                $tipos = ["CC" => "Cédula de Ciudadanía", "PASAPORTE" => "Pasaporte", "CE" => "Cédula de Extranjería"];
                                foreach ($tipos as $clave => $texto):
                                  $selected = $cliente['tipo_documento'] == $clave ? 'selected' : '';
                                  echo "<option value=\"$clave\" $selected>$texto</option>";
                                endforeach;
                                ?>
                              </select>
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label">Número Documento</label>
                              <input type="number" class="form-control" name="numero_documento" value="<?= $cliente['numero_documento'] ?>">
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label">Nacimiento</label>
                              <input type="date" class="form-control" name="fecha_nacimiento" value="<?= $cliente['fecha_nacimiento'] ?>">
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label">Correo</label>
                              <input type="email" class="form-control" name="correo" value="<?= $cliente['correo'] ?>">
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label">Contacto 1</label>
                              <input type="number" class="form-control" name="contacto1" value="<?= $cliente['contacto_1'] ?>">
                            </div>
                            <div class="col-sm-6">
                              <label class="form-label">Contacto 2</label>
                              <input type="number" class="form-control" name="contacto2" value="<?= $cliente['contacto_2'] ?>">
                            </div>
                            <div class="col-12">
                              <label class="form-label">Dirección</label>
                              <input type="text" class="form-control" name="direccion" value="<?= $cliente['direccion'] ?>">
                            </div>
                          </div>

                          <!-- Contraseña opcional -->
                          <details>
                            <summary>Nueva contraseña (opcional)</summary>
                            <div class="mb-3 mt-4">
                              <label for="contrasena_<?= $cliente['id'] ?>">Contraseña:</label>
                              <input
                                type="password"
                                class="form-control"
                                id="contrasena_<?= $cliente['id'] ?>"
                                name="cambiarClave"
                                placeholder="Llena este campo si deseas cambiar la contraseña"
                                autocomplete="new-password">
                              <ul class="mt-2" id="passwordRequirements_<?= $cliente['id'] ?>">
                                <li id="length_<?= $cliente['id'] ?>" class="text-danger">❌ Mínimo 8 caracteres</li>
                                <li id="lowercase_<?= $cliente['id'] ?>" class="text-danger">❌ Al menos una letra minúscula</li>
                                <li id="uppercase_<?= $cliente['id'] ?>" class="text-danger">❌ Al menos una letra mayúscula</li>
                                <li id="number_<?= $cliente['id'] ?>" class="text-danger">❌ Al menos un número</li>
                                <li id="special_<?= $cliente['id'] ?>" class="text-danger">❌ Al menos un carácter especial (!@#$%^&*)</li>
                              </ul>

                            </div>
                          </details>
                          <script>
                            (function() {
                              const id = <?= $cliente['id'] ?>;
                              const form = document.querySelector(`#modalEditar<?= $cliente['id'] ?> form`);
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
                          <div class="modal-footer mt-3">
                            <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <?php include('footer.php'); ?>
  <script>
    async function eliminar(event, id) {
      event.preventDefault();
      const confirmarSalida = await confirmar(
        '¿Estás seguro de que deseas eliminar a este CLIENTE?',
        'SÍ', 'No', 'warning'
      );

      if (confirmarSalida) {
        window.location.href = `../../controlador/clientes_c.php?accion=eliminar&id=${id}`;
      }
    }

    // Filtro búsqueda
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
