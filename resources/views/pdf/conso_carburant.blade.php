
 @extends('pdf.app')

 @section('content_pdf')
   
     <h1 style="color: rgb(90, 136, 236); text-align:center;" class="fw-bold">Liste de consommation en carburant</h1>

    {{-- {{ $title }} --}}
    <span>Date: {{ $date }}</span>
    <
    <table class="conducteur-table">
    <thead>
        <tr>
            <th>Immatriculation</th>
            <th>Marque</th>
            <th>quantité</th>
            <th>Date </th>
            <th>Coût</th>
            <th>Prestataire</th>
            {{-- <th>Tel</th> --}}
        </tr>
    </thead>
    <tbody>
      @foreach ($users as $item)
         <tr>
             
             <td>{{$item->getVehicule->immatriculation}}</td>
             <td>{{$item->getVehicule->marque}}</td>
             <td>{{ $item->quantite_conso }} L</td>
             <td>{{ date('d-m-y', strtotime($item->date_conso)) }}</td>
             <td>{{ $item->cout_conso}} FCFA</td>
             <td>{{ $item->getFournisseur->nom }}</td>
             {{-- <td>{{ $item->telephone }}</td> --}}
        </tr>
     @endforeach
    </tbody>
</table>
 @endsection

