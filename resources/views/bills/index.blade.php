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
						<a href="#deleteEmployeeModal" class="btn btn-danger" data-toggle="modal"><i class="material-icons">&#xE15C;</i> <span>Supprimer</span></a>
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
							<span class="custom-checkbox">
								<input type="checkbox" id="selectAll">
								<label for="selectAll"></label>
							</span>
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
				<tbody>
					<tr>
						<td>
							<span class="custom-checkbox">
								<input type="checkbox" id="checkbox1" name="options[]" value="1">
								<label for="checkbox1"></label>
							</span>
							@foreach ($bills as $bill)
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
			{{ $products->links() }}
			<div class="clearfix">
				<div class="hint-text">Affichage de <b>5</b> entrées sur <b>25 </div>
				<ul class="pagination">
					<li class="page-item disabled"><a href="#">précédent</a></li>
					<li class="page-item"><a href="#" class="page-link">1</a></li>
					<li class="page-item"><a href="#" class="page-link">2</a></li>
					<li class="page-item active"><a href="#" class="page-link">3</a></li>
					<li class="page-item"><a href="#" class="page-link">4</a></li>
					<li class="page-item"><a href="#" class="page-link">5</a></li>
					<li class="page-item"><a href="#" class="page-link">suivant</a></li>
				</ul>
			</div>
		</div>
	</div>        
</div>
<!-- Add Modal HTML -->
					@if ($errors->any())
						<div class="alert alert-danger">
							<strong>Whoops!</strong> There were some problems with your input.<br><br>
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
						<select class="selectpicker" data-width='100%' name="Supplier_name" id="Supplier_name">
                            <option value="">--Sélectionner le fournisseur--</option>
                            <option value="">AAA</option>
                            <option value="">AAB</option>
                            <option value="">AAC</option>
                            <option value="">ABA</option>
                            <option value="">ABB</option>
                            <option value="">ABC</option>
                        </select>                        
					</div>
                    <div class="form-group">
						<label>N°Facture</label>
						<input type="text" class="form-control" required>
					</div>
                    <div class="form-group">
						<label>Montant</label>
						<input type="text" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Date Facture</label>
						<input id="datepicker" width="100%">
                            <script>
                                $('#datepicker').datepicker({
                                    uiLibrary: 'bootstrap4'
                                });
                            </script>
					</div>
					<div class="form-group">
						<label>Date Dépot</label>
						<input id="datepicker2" width="100%">
                            <script>
                                $('#datepicker2').datepicker({
                                    uiLibrary: 'bootstrap4'
                                });
                            </script>
					</div>
                    <div class="form-group">
                        <label>Service</label>
						<select class="selectpicker" data-width='100%' name="fournisseur" id="select-fournisseur">
                            <option value="">--Sélectionner le service--</option>
                            <option value="">AAA</option>
                            <option value="">AAB</option>
                            <option value="">AAC</option>
                            <option value="">ABA</option>
                            <option value="">ABB</option>
                            <option value="">ABC</option>
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
<!-- Edit Modal HTML -->
<div id="editEmployeeModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form>
				<div class="modal-header">						
					<h4 class="modal-title">Edit Employee</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">					
					<div class="form-group">
                        <label>Fournisseur</label>
						<select class="selectpicker" data-width='100%' name="fournisseur" id="select-fournisseur">
                            <option value="">--Sélectionner le fournisseur--</option>
                            <option value="">AAA</option>
                            <option value="">AAB</option>
                            <option value="">AAC</option>
                            <option value="">ABA</option>
                            <option value="">ABB</option>
                            <option value="">ABC</option>
                        </select>                        
					</div>
                    <div class="form-group">
						<label>N°Facture</label>
						<input type="text" class="form-control" required>
					</div>
                    <div class="form-group">
						<label>Montant</label>
						<input type="text" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Date Facture</label>
						<input id="datepicker3" width="100%">
                            <script>
                                $('#datepicker3').datepicker({
                                    uiLibrary: 'bootstrap4'
                                });
                            </script>
					</div>
					<div class="form-group">
						<label>Date Dépot</label>
						<input id="datepicker4" width="100%">
                            <script>
                                $('#datepicker4').datepicker({
                                    uiLibrary: 'bootstrap4'
                                });
                            </script>
					</div>
					<div class="form-group">
						<label>Date Echéance</label>
						<input id="datepicker5" width="100%">
                            <script>
                                $('#datepicker5').datepicker({
                                    uiLibrary: 'bootstrap4'
                                });
                            </script>
					</div>
                    <div class="form-group">
                        <label>Service</label>
						<select class="selectpicker" data-width='100%' name="fournisseur" id="select-fournisseur">
                            <option value="">--Sélectionner le service--</option>
                            <option value="">AAA</option>
                            <option value="">AAB</option>
                            <option value="">AAC</option>
                            <option value="">ABA</option>
                            <option value="">ABB</option>
                            <option value="">ABC</option>
                        </select>                        
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
			<form>
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
