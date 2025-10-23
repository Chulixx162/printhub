 <div class="modal fade" id="abonarCompraModal<?php echo $compra['id']; ?>" tabindex="-1" aria-labelledby="abonarCompraLabel" aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content">
             <form method="POST" action="../../controlador/abonos_c.php?accion=registrar" enctype="multipart/form-data">
                 <div class="modal-header bg-success text-white">
                     <h5 class="modal-title" id="abonarCompraLabel">Realizar Abono</h5>
                     <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                 </div>
                 <div class="modal-body">
                     <input type="hidden" name="id_venta" value="<?= $compra['id'] ?>">
                     <div class="mb-3">
                         <label>Monto a abonar (Saldo pendiente: $<?php echo number_format($saldoPendiente, 0, ',', '.'); ?>)</label>
                         <input type="number" class="form-control" name="monto" max="<?php echo $saldoPendiente; ?>" min="1" required>
                     </div>
                     <div class="mb-3">
                         <label>Medio de pago</label>
                         <input type="text" name="metodo_pago" class="form-control" readonly value="Transferencia">
                     </div>
                     <div class="mb-3">
                        <label for="">Tipo de Transferencia</label>
                        <input type="text" name="tipo_transferencia" class="form-control" placeholder="Ejemplo: Nequi, Daviplata, Bancolombia..." required>
                     </div>
                     <div class="mb-3">
                        <label for="">Adjuntar comprobante de pago</label>
                         <input type="file" class="form-control" name="comprobante" accept="image/*,pdf" required>
                     </div>
                     <div class="mb-3">
                         <label>Observaciones (opcional)</label>
                         <textarea class="form-control" name="observaciones" rows="2"></textarea>
                     </div>
                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                     <button type="submit" class="btn btn-success">Abonar</button>
                 </div>
             </form>
         </div>
     </div>
 </div>