
 @extends('pdf.app')

 @section('content_pdf')
   
     <h1 style="color: rgb(90, 136, 236); text-align:center;" class="fw-bold">Liste de vehicules</h1>

    {{-- {{ $title }} --}}
    <span>Date: {{ $date }}</span>
    <
    <table class="conducteur-table">
    <thead>
        <tr>
            <th>Immatriculation</th>
            <th>Marque</th>
            <th>Modele</th>
            <th>Date d'achat</th>
            <th>Kilometrage</th>
            <th>Type Carburant</th>
            {{-- <th>Tel</th> --}}
        </tr>
    </thead>
    <tbody>
      @foreach ($users as $item)
         <tr>
             
             <td>{{ $item->immatriculation }}</td>
             <td>{{ $item->marque }}</td>
             <td>{{ $item->modele }}</td>
             <td>{{ date('d-m-y', strtotime($item->date_achat)) }}</td>
             <td>{{ $item->kilometrage }}</td>
             <td>{{ $item->type_carburant }}</td>
             {{-- <td>{{ $item->telephone }}</td> --}}
        </tr>
     @endforeach
    </tbody>
</table>
 @endsection

