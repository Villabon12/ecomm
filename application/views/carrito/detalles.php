<div class="row" style="margin:20px;">

	<div class="card">
		<div class="card-body">
			<div class="row">
				<div class="col-xs-12">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>Producto</th>
								<th>Cantidad</th>
								<th>Precio</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($dt_td as $dt): ?>
								<tr>
									<td>
										<?php echo $dt->producto; ?>
									</td>
									<td>
										<?php echo $dt->cantidad; ?>
									</td>
									<td> $
										<?= number_format($dt->precio, 0) ?>
									</td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>


	<center>
		<div class="col" style="margin-top:2rem;">
			<?php if ($perfil->tipo == "Comercio") { ?>
				<?php if ($datos->estado == 2) { ?>
					Ya esta confirmado el pedido
				<?php } else { ?>
					<button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
						data-bs-target="#compra<?= $id ?>">confirmar</button>
					<button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
						data-bs-target="#cancelar<?= $id ?>">Anular</button>
				<?php } ?>
				<?php if ($datos->qr == null) { ?>
					<form action="<?= base_url() ?>Proceso/generaQRin/<?= $id ?>" method="get">
						<button type="submit" class="btn btn-primary btn-sm">Generar QR</button>
					</form>
				<?php } else { ?>
					<div class="col-5" style="margin-top:2rem;">
						<img src="<?= base_url() . $datos->qr ?>" width="50%" height="50%" alt="">
					</div>
				<?php } ?>
			<?php } else { ?>
			<?php } ?>

		</div>
	</center>

</div>
<div class="modal fade" id="compra<?= $id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title fs-5" id="exampleModalLabel">Confirmacion
				</h1>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" action="<?= base_url() ?>Proceso/aceptaCompraNego/<?= $id ?>">
				<div class="modal-body">
					¿Esta seguro que ya despacho el pedido?
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
					<button type="submit" class="btn btn-primary">Aceptar</button>
				</div>
			</form>
		</div>
	</div>
</div>
<div class="modal fade" id="cancelar<?= $id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title fs-5" id="exampleModalLabel">Anular el pedido
				</h1>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" action="<?= base_url() ?>Proceso/rechazarPedido/<?= $id ?>">
				<div class="modal-body">
					¿Esta seguro que desea cancelar este pedido?
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary  btn-sm" data-bs-dismiss="modal">Cerrar</button>
					<button type="submit" class="btn btn-primary  btn-sm">Aceptar</button>
				</div>
			</form>
		</div>
	</div>
</div>