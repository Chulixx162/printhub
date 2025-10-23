<?php
session_start();
if (!isset($_SESSION['id_cliente'])) {
  header("Location: ../login");
  exit();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Carrito de Compras | PRINT HUB</title>

  <link rel="icon" href="../../IMAGENES/LogoPrint_b.png">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="../../libs/bootstrap-5.3.3-dist/css/bootstrap.min.css">

  <!-- Font Awesome (local) -->
  <link rel="stylesheet" href="../../libs/fontawesome-free-6.7.2-web/css/all.min.css">

  <style>
    body {
      background: #1488CC;
      background: -webkit-linear-gradient(to right, #2B32B2, #1488CC);
      background: linear-gradient(to right, #2B32B2, #1488CC);
      min-height: 100vh;
      font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
    }

    /* Improved table container with card design */
    .table-container {
      background-color: white;
      border-radius: 16px;
      padding: 24px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
      overflow: hidden;
    }

    /* Enhanced table styling */
    .table {
      margin-bottom: 0;
    }

    .table thead {
      background-color: #007B8A;
      color: white;
    }

    .table thead th {
      border: none;
      padding: 16px 12px;
      font-weight: 600;
      font-size: 0.9rem;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    /* Better row styling with hover effect */
    .table tbody tr {
      border-bottom: 1px solid #e9ecef;
      transition: all 0.2s ease;
    }

    .table tbody tr:hover {
      background-color: #f8f9fa;
      transform: translateX(2px);
    }

    .table tbody tr:last-child {
      border-bottom: none;
    }

    .table tbody td {
      padding: 20px 12px;
      vertical-align: middle;
      font-size: 0.95rem;
    }

    /* Enhanced tfoot styling */
    .table tfoot {
      background-color: #f8f9fa;
      font-size: 1.1rem;
    }

    .table tfoot td {
      padding: 20px 12px;
      border-top: 2px solid #007B8A;
    }

    /* Improved quantity input styling */
    .quantity-input {
      width: 70px !important;
      border: 2px solid #e9ecef;
      border-radius: 8px;
      padding: 8px 10px;
      text-align: center;
      font-weight: 600;
      transition: all 0.2s ease;
    }

    .quantity-input:focus {
      border-color: #007B8A;
      box-shadow: 0 0 0 3px rgba(0, 123, 138, 0.1);
      outline: none;
    }

    /* Enhanced button styling */
    .btn-success {
      background-color: #28a745;
      border: none;
      border-radius: 8px;
      padding: 8px 12px;
      transition: all 0.2s ease;
    }

    .btn-success:hover {
      background-color: #218838;
      transform: translateY(-1px);
      box-shadow: 0 4px 8px rgba(40, 167, 69, 0.3);
    }

    .btn-primary {
      background-color: #007bff;
      border: none;
      border-radius: 10px;
      padding: 14px 24px;
      font-weight: 600;
      font-size: 1rem;
      transition: all 0.3s ease;
    }

    .btn-primary:hover {
      background-color: rgb(0, 55, 255);
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(0, 123, 255, 0.4);
    }

    .btn-danger {
      background-color: #ff6b6b;
      border: none;
      border-radius: 8px;
      padding: 8px 12px;
      transition: all 0.2s ease;
    }

    .btn-danger:hover {
      background-color: #e74c3c;
      transform: translateY(-1px);
      box-shadow: 0 4px 8px rgba(255, 107, 107, 0.3);
    }

    /* Enhanced summary card design */
    .resumen {
      background-color: white;
      border-radius: 16px;
      padding: 28px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
      position: sticky;
      top: 20px;
    }

    .resumen h4 {
      font-weight: 700;
      color: #2c3e50;
      margin-bottom: 24px;
      font-size: 1.5rem;
    }

    .resumen ul li {
      padding: 12px 0;
      font-size: 1rem;
      color: #495057;
    }

    .resumen ul li:last-child {
      font-size: 1.3rem;
      color: #2c3e50;
      padding-top: 16px;
    }

    .resumen hr {
      margin: 20px 0;
      border-top: 2px solid #e9ecef;
    }

    /* Improved floating back button */
    .btn-back {
      position: fixed;
      bottom: 30px;
      left: 30px;
      z-index: 9999;
      background-color: #007bff;
      color: white;
      border: none;
      padding: 14px 24px;
      border-radius: 50px;
      box-shadow: 0 6px 20px rgba(0, 123, 255, 0.4);
      cursor: pointer;
      transition: all 0.3s ease;
      font-weight: 600;
      font-size: 0.95rem;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .btn-back:hover {
      background-color: #0056b3;
      transform: translateY(-3px);
      box-shadow: 0 8px 25px rgba(0, 123, 255, 0.5);
    }

    /* Enhanced page title */
    .page-title {
      font-weight: 700;
      font-size: 2.2rem;
      text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
      margin-bottom: 32px;
    }

    /* Empty cart message styling */
    .empty-cart {
      padding: 40px 20px;
      text-align: center;
      color: #6c757d;
      font-size: 1.1rem;
    }

    /* Product name styling */
    .product-name {
      font-weight: 600;
      color: #2c3e50;
      font-size: 1rem;
    }

    /* Price styling */
    .price-text {
      font-weight: 600;
      color: #007B8A;
      font-size: 1rem;
    }

    /* Responsive improvements */
    @media (max-width: 991px) {
      .resumen {
        position: static;
        margin-top: 24px;
      }
      
      .btn-back {
        bottom: 20px;
        left: 20px;
        padding: 12px 20px;
        font-size: 0.9rem;
      }
    }

    @media (max-width: 768px) {
      .page-title {
        font-size: 1.8rem;
      }
      
      .table-container {
        padding: 16px;
      }
      
      .quantity-input {
        width: 60px !important;
      }
    }
  </style>
</head>

<body>
  <!-- Improved floating back button -->
  <button onclick="window.location.href='productos';" class="btn-back">
    <i class="fas fa-arrow-left"></i>
    <span>Volver</span>
  </button>

  <script src="../alertas/funcionesalert.js"></script>
  
  <div class="container py-5">
    <h2 class="page-title text-center text-light">
      <i class="fas fa-shopping-cart me-3"></i>Carrito de compras
    </h2>

    <div class="row">
      <!-- Enhanced table with card container -->
      <div class="col-lg-8 mb-4">
        <div class="table-container">
          <div class="table-responsive">
            <table class="table align-middle">
              <thead>
                <tr>
                  <th>Producto</th>
                  <th>Precio</th>
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
                    <tr>
                      <td><span class="product-name"><?php echo $item['nombre']; ?></span></td>
                      <td><span class="price-text">$<?php echo number_format($item['precio'], 0, ',', '.'); ?></span></td>
                      <td>
                        <form method='POST' action='../../controlador/carrito_c.php?accion=actualizar' class='d-inline'>
                          <input type='hidden' name='index' value='<?php echo $index; ?>'>
                          <input type='number' name='cantidad' class='form-control quantity-input d-inline' value='<?php echo $item['cantidad']; ?>' min='1'>
                          <button type='submit' class='btn btn-sm btn-success ms-2' title='Actualizar cantidad'>
                            <i class='fas fa-sync-alt'></i>
                          </button>
                        </form>
                      </td>
                      <td><span class="price-text">$<?php echo number_format($subtotal, 0, ',', '.'); ?></span></td>
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
                  echo "<tr><td colspan='5' class='empty-cart'>Tu carrito está vacío</td></tr>";
                }
                ?>
              </tbody>
              <tfoot>
                <tr>
                  <td colspan="3" class="text-end"><strong>Total:</strong></td>
                  <td colspan="2"><strong class="price-text">$<?php echo number_format($total, 0, ',', '.'); ?></strong></td>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
      </div>

      <!-- Enhanced summary card -->
      <div class="col-lg-4">
        <div class="resumen">
          <?php
          $totalFinal = $total;
          ?>
          <h4>Resumen de compra</h4>
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

  <?php include('footer.php'); ?>

  <script>
    function confirmarEliminacion(index) {
      confirmar('¿Estás seguro de eliminar este producto del carrito?', 'Sí, eliminar', 'Cancelar', 'warning')
        .then((confirmado) => {
          if (confirmado) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '../../controlador/carrito_c.php?accion=eliminar';

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
      carrito('¿Estás seguro de finalizar la solicitud de compra? <br> Antes de finalizar, actualice todas las cantidades.', 'Sí, finalizar', 'Cancelar', '../../controlador/carrito_c.php?accion=finalizar', 'question');
    };
  </script>

</body>

</html>
