
 @extends('pdf.app')
 @section('content_pdf')
  
  
     <h1 style="color: rgb(90, 136, 236); text-align:center;" class="fw-bold">Liste d'intervention techniques</h1>

    {{-- {{ $title }} --}}
    <span>Date: {{ $date }}</span>
    <
    <table class="conducteur-table">
    <thead>
        <tr>
            <th>Vehicule</th>
            <th>Type</th>
            <th>Titre</th>
            <th>Prestataire</th>
             <th>Date </th>
             <th>Coût</th>
            <th>Prochain</th>
            <th>Duree Immobilisation</th>
        </tr>
    </thead>
    <tbody>
      @foreach ($users as $item)
         <tr>
             <td>{{$item->getVehicule->immatriculation}}-{{$item->getVehicule->marque}}</td>
             <td>{{ $item->type }}</td>
             <td>{{ $item->titre }}</td>
             <td>{{ $item->getFournisseur->nom }}</td>
             <td>{{ date('d-m-y', strtotime($item->date)) }}</td>
             <td>{{ $item->cout }}</td>
             <td>{{ $item->prochaine_date ? \Carbon\Carbon::parse($item->prochaine_date)->format('d-m-Y') : '' }}</td>
              {{-- <td>{{ date('d-m-y', strtotime($item->prochaine_date)) }}</td> --}}
             <td>{{ $item->duree_imobilisation }}</td>
        </tr>
     @endforeach
    </tbody>
</table>

 @endsection