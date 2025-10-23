<?php
class CompraController {
    private $model;

    public function __construct($conn) {
        $this->model = new CompraModel($conn);
    }

    public function detalle($id_venta) {
        $compra = $this->model->obtenerCompraPorId($id_venta);
        $saldo = $this->model->calcularSaldoPendiente($id_venta);

        // Pasamos datos a la vista
        include '../vista/general/detalle_compra.php';
    }
}

?>