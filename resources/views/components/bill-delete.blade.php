<!-- Delete Modal HTML -->
<div id="{{ $id }}" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="{{ route('bills.destroy', $bill) }}" method="POST">
				@csrf
				@method('DELETE')
				<div class="modal-header">						
					<h4 class="modal-title">Supprimer Facture</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">					
					<p>Voulez-vous vraiment supprimer ces factures ?</p>
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Annuler">
					<input type="submit" class="btn btn-danger" value="Supprimer">
				</div>
			</form>
		</div>
	</div>
</div>
