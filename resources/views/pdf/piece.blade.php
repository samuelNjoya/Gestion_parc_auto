
 @extends('pdf.app')

 @section('content_pdf')
     

     <h1 style="color: rgb(90, 136, 236); text-align:center;" class="fw-bold">Liste des pièces</h1>

    {{-- {{ $title }} --}}
    <span>Date: {{ $date }}</span>
    <
    <table class="conducteur-table">
    <thead>
        <tr>
            <th>#</th>
            <th>Titre</th>
            <th>Nom</th>
            <th>Reference</th>
            <th>Date inst</th>
            <th>Date exp</th>
            <th>CU</th>
            <th>Q</th>
            <th>CT</th>
        </tr>
    </thead>
    <tbody>
      @foreach ($users as $item)
         <tr>
            <td >{{$item->id}}</td> 
            <td >{{$item->getInterventionTechnique->titre}} - ({{$item->getInterventionTechnique->getVehicule->immatriculation}})</td>
            <td >{{$item->nom}}</td>
            <td >{{$item->reference}}</td>
            <td >{{ date('d-m-y', strtotime($item->date_installation)) }}</td>
            <td >{{ date('d-m-y', strtotime($item->date_expiration)) }}</td>
            <td >{{$item->cout_unitaire}} fcfa</td>
            <td >{{$item->quantite}}</td>
            <td >{{$item->cout_unitaire*$item->quantite}} fcfa</td>
            {{-- <td >{{$item->kilometrage_installation}} km</td> --}}
        </tr>
     @endforeach
    </tbody>
</table>
 @endsection

