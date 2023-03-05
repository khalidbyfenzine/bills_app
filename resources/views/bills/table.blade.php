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
                <a class="edit" data-toggle="modal" data-target="#{{ 'edit-bill-' . $bill->id }}"><i class="material-icons" data-toggle="tooltip" title="Modifier">&#xE254;</i></a>
                <a  class="delete" data-toggle="modal" data-target="#{{ 'delete-bill-' . $bill->id }}"><i class="material-icons" data-toggle="tooltip" title="Supprimer">&#xE872;</i></a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{ $bills->links() }}