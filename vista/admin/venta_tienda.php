<?php
session_start();
include '../../conexion.php';
include '../../modelo/ventaentienda_m.php';
$productos = obtenerProductosconCategoria($conn)
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Venta en Tienda - JYS</title>

  <link rel="icon" href="../../IMAGENES/Logotipo_sinsombrapng_Mesa de trabajo 1-02.png">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="../../libs/bootstrap-5.3.3-dist/css/bootstrap.min.css">

  <!-- Font Awesome (local) -->
  <link rel="stylesheet" href="../../libs/fontawesome-free-6.7.2-web/css/all.min.css">

  <style>
    body {
      background: #1488CC;
      /* fallback for old browsers */
      background: -webkit-linear-gradient(to right, #2B32B2, #1488CC);
      /* Chrome 10-25, Safari 5.1-6 */
      background: linear-gradient(to right, #2B32B2, #1488CC);
      /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

    }

    .table thead {
      background-color: #007B8A;
      color: white;
    }



    .btn-primary:hover {
      background-color: rgb(0, 55, 255);
    }

    .btn-danger {
      background-color: #ff6b6b;
      border: none;
    }

    .btn-danger:hover {
      background-color: #e74c3c;
    }

    .resumen {
      background-color: white;
      border-radius: 10px;
      padding: 20px;
      box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
    }
  </style>
</head>

<body>
  <script src="../alertas/funcionesalert.js"></script>
  <div class="container py-5">
    <h2 class="mb-4 text-center text-light"><i class="fas fa-shopping-cart me-2"></i>Venta en Tienda</h2>
    <div class="mb-4">
      <form method="POST" action="../../controlador/ventaentienda_c.php?accion=agregar" class="row g-3 align-items-center">
        <div class="col-md-4">
          <select name="id_producto" class="form-select" required>
            <option value="">-- Selecciona un producto --</option>
            <?php foreach($productos as $producto): ?>
              <option value="<?php echo $producto['id']; ?>">
                <?php echo $producto['nombre'] . " (Cat: " . ($producto['nombre_categoria'] ?? 'Sin categoría') . ") - $" . number_format($producto['precio'], 0, ',', '.'); ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="col-md-2">
          <input type="number" name="cantidad" class="form-control" value="1" min="1" required>
        </div>

        <div class="col-md-2">
          <button type="submit" class="btn btn-info w-100">
            <i class="fas fa-plus"></i> Agregar
          </button>
        </div>
      </form>

    </div>


    <div class="row">
      <!-- Tabla de productos -->
      <div class="col-lg-8 mb-4">
        <div class="table-responsive">
          <table class="table align-middle">
            <thead>
              <tr style="text-align: center;">
                <th>Producto</th>
                <th>Categoría</th>
                <th>Precio Unit</th>
                <th>Cantidad</th>
                <th>Total</th>
                <th>Acción</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $total = 0;
              if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) {
                foreach ($_SESSION['carrito'] as $index => $item) {
                  $subtotal = $item['precio'] * $item['cantidad'];
                  $total += $subtotal;
              ?>
                  <tr style="text-align: center;">
                    <td><strong><?php echo $item['nombre']; ?></strong></td>
                    <td><?php echo $item['categoria'] . '(' . $item['id_categoria'] . ')'; ?></td>
                    <td>$<?php echo number_format($item['precio'], 0, ',', '.'); ?></td>
                    <td>
                      <form method='POST' action='../../controlador/ventaentienda_c.php?accion=actualizar' class='d-inline'>
                        <input type='hidden' name='index' value='<?php echo $index; ?>'>
                        <input type='number' name='cantidad' class='form-control w-50 d-inline' value='<?php echo $item['cantidad']; ?>' min='1'>
                        <button type='submit' class='btn btn-sm btn-success ms-1' title='Actualizar cantidad'>
                          <i class='fas fa-sync-alt'></i>
                        </button>
                      </form>
                    </td>
                    <td>$<?php echo number_format($subtotal, 0, ',', '.'); ?></td>
                    <td>
                      <button
                        type='button'
                        class='btn btn-danger btn-sm'
                        onclick='confirmarEliminacion(<?php echo $index; ?>)'>
                        <i class='fas fa-trash-alt'></i>
                      </button>
                    </td>
                  </tr>
              <?php
                }
              } else {
                echo "<tr><td colspan='5' class='text-center'>Tu carrito está vacío</td></tr>";
              }
              ?>

            </tbody>
            <tfoot>
              <tr>
                <td colspan="3" class="text-end"><strong>Total:</strong></td>
                <td colspan="2"><strong>$<?php echo number_format($total, 0, ',', '.'); ?></strong></td>
              </tr>
            </tfoot>

          </table>
        </div>
      </div>

      <!-- Resumen de compra -->
      <div class="col-lg-4">
        <div class="resumen">
          <?php

          $totalFinal = $total;
          ?>
          <h4 class="mb-3"><i class="fas fa-receipt"></i> Resumen</h4>
          <ul class="list-unstyled">
            <li class="d-flex justify-content-between">
              <span>Subtotal:</span>
              <strong>$<?php echo number_format($total, 0, ',', '.'); ?></strong>
            </li>
            <li class="d-flex justify-content-between">
              <span>Total:</span>
              <strong>$<?php echo number_format($totalFinal, 0, ',', '.'); ?></strong>
            </li>
          </ul>
          <hr>

          <button type="btn" class="btn btn-primary w-100" onclick="confirmarSolicitud();">
            <i class="fas fa-credit-card me-2"></i>Finalizar Solicitud de Compra
          </button>

        </div>
      </div>
    </div>
  </div>
  <!-- Botón flotante para regresar -->
  <button onclick="window.history.back();"
    title="Volver"
    style="
        position: fixed;
        bottom: 20px;
        left: 20px;
        z-index: 9999;
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 50%;
        font-size: 18px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.3);
        cursor: pointer;
        transition: all 0.3s ease;
    "
    onmouseover="this.style.backgroundColor='#0056b3'; this.style.transform='scale(1.1)';"
    onmouseout="this.style.backgroundColor='#007bff'; this.style.transform='scale(1)';">
    <i class="fas fa-arrow-left"></i>
</button>


<script src="../../libs/SweetAlert2/sweetalert2.all.min.js"></script>
<script src="../../vista/alertas/funcionesalert.js"></script>
  <script>
    function confirmarEliminacion(index) {
      confirmar('¿Estás seguro de eliminar este producto del carrito?', 'Sí, eliminar', 'Cancelar', 'warning')
        .then((confirmado) => {
          if (confirmado) {
            // Crear y enviar el formulario manualmente
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '../../controlador/ventaentienda_c.php?accion=eliminar';

            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'index';
            input.value = index;

            form.appendChild(input);
            document.body.appendChild(form);
            form.submit();
          }
        });
    }

    function carrito(texto, opcion_si, opcion_no, redireccion, icono) {
      Swal.fire({
        title: texto,
        icon: icono,
        showCancelButton: true,
        confirmButtonText: opcion_si,
        cancelButtonText: opcion_no,
        allowOutsideClick: false,
        allowEscapeKey: false,
        allowEnterKey: false,
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = redireccion;
        }
      });
    }

    function confirmarSolicitud() {
      Swal.fire({
        title: 'Actualice las cantidades antes de continuar <br> <hr> Datos del comprador:',
        icon: 'warning',
        html:
          '<input id="swal-nombre" name="comprador" class="swal2-input" placeholder="Nombre completo" required>' +
          '<input id="swal-telefono" name="telefono" class="swal2-input" placeholder="Número de teléfono" required>' +
          '<input id="swal-direccion" name="direccion" class="swal2-input" placeholder="Dirección">',
        focusConfirm: false,
        showCancelButton: true,
        confirmButtonText: 'Finalizar compra',
        cancelButtonText: 'Cancelar',
        preConfirm: () => {
          const nombre = document.getElementById('swal-nombre').value.trim();
          const telefono = document.getElementById('swal-telefono').value.trim();
          const direccion = document.getElementById('swal-direccion').value.trim();

          if (!nombre || !telefono || !direccion) {
            Swal.showValidationMessage('Por favor, complete todos los campos');
            return false;
          }

          return { nombre, telefono, direccion };
        }
      }).then((result) => {
        if (result.isConfirmed) {
          // Crear un formulario dinámico y enviarlo al controlador
          const form = document.createElement('form');
          form.method = 'POST';
          form.action = '../../controlador/ventaentienda_c.php?accion=finalizar';

          const inputNombre = document.createElement('input');
          inputNombre.type = 'hidden';
          inputNombre.name = 'comprador';
          inputNombre.value = result.value.nombre;

          const inputTelefono = document.createElement('input');
          inputTelefono.type = 'hidden';
          inputTelefono.name = 'telefono';
          inputTelefono.value = result.value.telefono;

          const inputDireccion = document.createElement('input');
          inputDireccion.type = 'hidden';
          inputDireccion.name = 'direccion';
          inputDireccion.value = result.value.direccion;

          form.appendChild(inputNombre);
          form.appendChild(inputTelefono);
          form.appendChild(inputDireccion);

          document.body.appendChild(form);
          form.submit();
        }
      });
    }


  </script>

</body>

</html>