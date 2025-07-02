
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
            
             <th>Date </th>
             {{-- <th>Coût</th> --}}
             <th>Coût total</th>
            <th>Prochain</th>
            {{-- <th>Duree Immobilisation</th> --}}
            <th>Prestataire</th>
        </tr>
    </thead>
    <tbody>
      @foreach ($users as $item)
         <tr>
             <td>{{$item->getVehicule->immatriculation}}-{{$item->getVehicule->marque}}</td>
             <td>{{ $item->type }}</td>
             <td>{{ $item->titre }}</td>
             
             <td>{{ date('d-m-y', strtotime($item->date)) }}</td>
             {{-- <td>{{ $item->cout }}</td> --}}
             <td>{{ number_format($item->cout_total, 0, ',', ' ') }} fcfa</td>
             <td>{{ $item->prochaine_date ? \Carbon\Carbon::parse($item->prochaine_date)->format('d-m-Y') : '' }}</td>
              {{-- <td>{{ date('d-m-y', strtotime($item->prochaine_date)) }}</td> --}}
             {{-- <td>{{ $item->duree_imobilisation }}</td> --}}
             <td>{{ $item->getFournisseur->nom }}</td>
        </tr>
     @endforeach
    </tbody>
</table>

 @endsection