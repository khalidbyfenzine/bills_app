@extends('bills.layout')

@section('content')



<div class="container-xxl">
	<div class="table-responsive">
		<div class="table-wrapper">
			<div class="table-title">
				<div class="row">
					<div class="col-sm-3">
						<h2>Gestion <b>des factures</b></h2>
					</div>
					<div class="col-sm-9">
						<a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Ajouter une facture</span></a>
						<a href="#deletebillsModal" id="deleteAllSelectedItems" class="btn btn-danger" data-toggle="modal"><i class="material-icons">&#xE15C;</i> <span>Supprimer</span></a>
						<a href="#deleteEmployeeModal" class="btn btn-info" data-toggle="modal"><i class="material-icons">&#xE8AD;</i> <span>Imprimer</span></a>
						<div class="input-group col-sm-8">
								<input class="form-control py-2 border-right-0 border" type="search" value="" id="example-search-input">
								<span class="input-group-append">
									<button class="btn btn-outline-secondary border-left-0 border" type="button">
										<i class="fa fa-search"></i>
									</button>
								  </span>
							</div>
						</div>
						<a href="#addsuppliermodal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Ajouter un fournisseur</span></a>
						<a href="#addservicemodal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Ajouter un service</span></a>		
					</div>
				</div>
			</div>
			<p class="search_input" style="text-align: center;">
                De :
                <input type="date" placeholder="From Date" id="post_at" name="start_date"  value="" class="input-control" /> à:
                <input type="date" placeholder="To Date" id="post_at_to_date" name="end_date"   value="" class="input-control"  />		 
                <a href="" class="btn btn-info" data-toggle="modal"><span>Rechercher</span></a>
              </p>
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th>
							<input type="checkbox" id="chkcheckall" />
						</th>
						<th>N°Facture</th>
                        <th>Fournisseur</th>
						<th>Date Facture</th>
						<th>Date Dépot</th>
						<th>Date Echéance</th>
                        <th>Service</th>
						<th>Montant</th>
                        <th>Action</th>
					</tr>
				</thead>
				<tbody>@foreach ($bills as $bill)
					<tr id="sid{{ $bill->id }}">
						<td>
						<input type="checkbox" name="ids" class="checkBoxClass" value="{{ $bill->id }}"/>	
						</td>
						<td>{{ $bill->Bill_number }}</td>
						<td>{{ $bill->Supplier_name }}</td>
						<td>{{ $bill->Bill_date }}</td>
						<td>{{ $bill->Deposit_date }}</td>
                        <td>{{ $bill->Due_date }}</td>
                        <td>{{ $bill->Service_name }}</td>
                        <td>{{ $bill->Amount }}</td>
						<td>
							<a href="#editEmployeeModal" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Modifier">&#xE254;</i></a>
							<a href="#deleteEmployeeModal" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Supprimer">&#xE872;</i></a>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
			{{ $bills->links() }}
		</div>
	</div>        
</div>

<script>
	$(function(e){
		$("#chkcheckall").click(function(){
			$(".checkBoxClass").prop('checked',$(this).prop('checked'));
		});
	
	$("#deleteAllSelectedItems").click(function(e){
		e.preventDefault();
		var allids = [];

		$("input:checkbox[name=ids]:checked").each(function(){
			allids.push($(this).val());
		});
		$.ajax({
			url:"{{ route('bill.deleteSelected') }}",
			type:"DELETE",
			data:{
				_token:$("input[name=_token]").val(),
				ids:allids
			},
			success:function(response){
				$.each(allids,function(key,val){
					$("#sid"+val).remove();
				})
			}
		});
	})
	});
</script>
<!-- Add Modal HTML -->
					@if ($errors->any())
						<div class="alert alert-danger">
							<strong>Whoops!</strong> Il y a eu quelques problèmes avec votre entrée.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif
<div id="addEmployeeModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="{{ route('bills.store') }}" method="POST">
				@csrf
				<div class="modal-header">						
					<h4 class="modal-title">Ajouter Facture</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">
                    					
					<div class="form-group">
                        <label>Fournisseur</label>
						<select class="selectpicker" data-width='100%' name="Supplier_name">
                            <option value="">--Sélectionner le fournisseur--</option>
                            <option value="AAA">AAA</option>
                            <option value="AAB">AAB</option>
                            <option value="AAC">AAC</option>
                            <option value="ABA">ABA</option>
                            <option value="ABB">ABB</option>
                            <option value="ABC">ABC</option>
                        </select>                        
					</div>
                    <div class="form-group">
						<label>N°Facture</label>
						<input type="text" name="Bill_number" class="form-control" required>
					</div>
                    <div class="form-group">
						<label>Montant</label>
						<input type="text" name="Amount" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Date Facture</label>
						<input type="date" class="form-control" name="Bill_date">
					</div>
					<div class="form-group">
						<label>Date Dépot</label>
						<input type="date" class="form-control" name="Deposit_date">
					</div>
                    <div class="form-group">
                        <label>Service</label>
						<select class="selectpicker" name="Service_name" data-width='100%' id="select-fournisseur">
                            <option value="">--Sélectionner le service--</option>
                            <option value="AAA">AAA</option>
                            <option value="AAB">AAB</option>
                            <option value="AAC">AAC</option>
                            <option value="ABA">ABA</option>
                            <option value="ABB">ABB</option>
                            <option value="ABC">ABC</option>
                        </select>                        
					</div>						
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Annuler">
					<input type="submit" class="btn btn-success" value="Ajouter">
				</div>
			</form>
					
		</div>
	</div>
</div>
<!-- Add Supplier Modal HTML -->
@if ($errors->any())
<div class="alert alert-danger">
	<strong>Whoops!</strong> Il y a eu quelques problèmes avec votre entrée.<br><br>
	<ul>
		@foreach ($errors->all() as $error)
			<li>{{ $error }}</li>
		@endforeach
	</ul>
</div>
@endif
<div id="addsuppliermodal" class="modal fade">
<div class="modal-dialog">
<div class="modal-content">
<form action="{{ route('supplier.store') }}" method="POST">
@csrf
<div class="modal-header">						
<h4 class="modal-title">Ajouter Fournisseur</h4>
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
</div>
<div class="modal-body">
				
<div class="form-group">
<label>Nom de Fournisseur</label>
<input type="text" name="Supplier_name" class="form-control" required>
</div>		
</div>
<div class="modal-footer">
<input type="button" class="btn btn-default" data-dismiss="modal" value="Annuler">
<input type="submit" class="btn btn-success" value="Ajouter">
</div>
</form>

</div>
</div>
</div>
<!-- Add Service Modal HTML -->
@if ($errors->any())
<div class="alert alert-danger">
	<strong>Whoops!</strong> Il y a eu quelques problèmes avec votre entrée.<br><br>
	<ul>
		@foreach ($errors->all() as $error)
			<li>{{ $error }}</li>
		@endforeach
	</ul>
</div>
@endif
<div id="addservicemodal" class="modal fade">
<div class="modal-dialog">
<div class="modal-content">
<form action="{{ route('service.store') }}" method="POST">
@csrf
<div class="modal-header">						
<h4 class="modal-title">Ajouter Service</h4>
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
</div>
<div class="modal-body">
				
<div class="form-group">
<label>Nom de Service</label>
<input type="text" name="Bill_number" class="form-control" required>
</div>		
</div>
<div class="modal-footer">
<input type="button" class="btn btn-default" data-dismiss="modal" value="Annuler">
<input type="submit" class="btn btn-success" value="Ajouter">
</div>
</form>

</div>
</div>
</div>
<!-- Edit Modal HTML -->
@if ($errors->any())
						<div class="alert alert-danger">
							<strong>Whoops!</strong> Il y a eu quelques problèmes avec votre entrée.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif
<div id="editEmployeeModal" class="modal fade">
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
						<input type="text" value="{{ $bill->Amount }}" name="Amount" class="form-control" required>
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
<!-- Delete Modal HTML -->
<div id="deleteEmployeeModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="{{ route('bills.destroy',$bill->id) }}" method="POST">
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

<!-- Delete bills HTML -->
<div id="deletebillsModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form>
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


@endsection
