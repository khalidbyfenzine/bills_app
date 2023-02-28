<div id="{{$id}}" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="{{ route('bills.update',$bill->id) }}" method="POST">
				@csrf
				@method('PUT')
				<div class="modal-header">						
					<h4 class="modal-title">Modifier Facture</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">					
					<div class="form-group">
						<label>Fournisseur</label>
						<input type="text" value="{{ $bill->Supplier_name }}" name="Supplier_name" class="form-control" required>
					</div>
                    <div class="form-group">
						<label>N°Facture</label>
						<input type="text" value="{{ $bill->Bill_number }}" name="Bill_number" class="form-control" required>
					</div>
                    <div class="form-group">
						<label>Montant</label>
						<input type="number" value="{{ $bill->Amount }}" name="Amount" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Date Facture</label>
						<input type="date" value="{{ $bill->Bill_date }}" class="form-control" name="Bill_date">
					</div>
					<div class="form-group">
						<label>Date Dépot</label>
						<input type="date" value="{{ $bill->Deposit_date }}" class="form-control" name="Deposit_date">
					</div>
					<div class="form-group">
						<label>Date Echéance</label>
						<input type="date" value="{{ $bill->Due_date }}" class="form-control" name="Due_date">
					</div>
                    <div class="form-group">
						<label>Service</label>
						<input type="text" value="{{ $bill->Service_name }}" name="Service_name" class="form-control" required>
					</div>								
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<input type="submit" class="btn btn-info" value="Save">
				</div>
			</form>
		</div>
	</div>
</div>