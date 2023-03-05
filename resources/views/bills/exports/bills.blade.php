<table>
    <thead>
    <tr>
        <th>N°Facture</th>
        <th>Fournisseur</th>
        <th>Date Facture</th>
        <th>Date Dépot</th>
        <th>Date Echéance</th>
        <th>Service</th>
        <th>Montant</th>
    </tr>
    </thead>
    <tbody>
    @foreach($bills as $bill)
        <tr>
            <td>{{ $bill->Bill_number }}</td>
            <td>{{ $bill->Supplier_name }}</td>
            <td>{{ $bill->Bill_date }}</td>
            <td>{{ $bill->Deposit_date }}</td>
            <td>{{ $bill->Due_date }}</td>
            <td>{{ $bill->Service_name }}</td>
            <td>{{ $bill->Amount }}</td>
        </tr>
    @endforeach
    </tbody>
</table>