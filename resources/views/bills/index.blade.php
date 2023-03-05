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
						<a href="{{ route('export_bill') }}" class="btn btn-info"><i class="material-icons">&#xE8AD;</i> <span>Imprimer</span></a>
						<a href="#addsuppliermodal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Ajouter un fournisseur</span></a>
						<a href="#addservicemodal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Ajouter un service</span></a>	
							<form class="form-inline" method="GET" role="search" >
								<input class="form-control py-2 border-right-0 border" name="term" type="search" value="" id="example-search-input">
								<span class="input-group-append">
									<button class="btn btn-outline-secondary border-left-0 border" type="button">
										<i class="fa fa-search"></i>
									</button>
								  </span></form>
							
						</div>
							
					</div>
				</div>
			</div>
			<p class="search_input" style="text-align: center;">
                De :
                <input type="date" placeholder="From Date" id="post_at" name="start_date"  value="" class="input-control" /> à:
                <input type="date" placeholder="To Date" id="post_at_to_date" name="end_date"   value="" class="input-control"  />		 
                <a href="" class="btn btn-info" data-toggle="modal"><span>Rechercher</span></a>
              </p>
			
			@include('bills.table',$bills)
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
@foreach ($bills as $bill)
<x-bill-edit id="{{ 'edit-bill-' . $bill->id }}" :bill="$bill"  :services="$services"  :suppliers="$suppliers"/> 
@endforeach

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
<div class="modal-dialog">ƒ
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
							@foreach ($suppliers as $supplier)
								<option value="{{$supplier->id}}">{{$supplier->Supplier_name}}</option>								
							@endforeach
                        </select>                        
					</div>
                    <div class="form-group">
						<label>N°Facture</label>
						<input type="text" name="Bill_number" class="form-control" required>
					</div>
                    <div class="form-group">
						<label>Montant</label>
						<input type="number" name="Amount" class="form-control" required>
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
						<select class="selectpicker" data-width='100%' name="Service_name">
                            <option value="">--Sélectionner le service--</option>
							@foreach ($services as $service)
								<option value="{{$service->id}}">{{$service->Service_name}}</option>								
							@endforeach
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
<input type="text" name="Service_name" class="form-control" required>
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

<!-- Delete Modal HTML -->
@foreach ($bills as $bill)
	<x-bill-delete id="{{ 'delete-bill-' . $bill->id }}" :bill="$bill" />
@endforeach

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
