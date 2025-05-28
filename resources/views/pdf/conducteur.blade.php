
 @extends('pdf.app')

 @section('content_pdf')
     

     <h1 style="color: rgb(90, 136, 236); text-align:center;" class="fw-bold">Liste de conducteurs</h1>

    {{-- {{ $title }} --}}
    <span>Date: {{ $date }}</span>
    <
    <table class="conducteur-table">
    <thead>
        <tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Email</th>
            <th>Date de naissance</th>
            <th>No Permis</th>
            <th>Type Permis</th>
            <th>Tel</th>
        </tr>
    </thead>
    <tbody>
      @foreach ($users as $item)
         <tr>
             
             <td>{{ $item->nom }}</td>
             <td>{{ $item->prenom }}</td>
             <td>{{ $item->email }}</td>
             <td>{{ date('d-m-y', strtotime($item->date_naiss)) }}</td>
             <td>{{ $item->num_permis }}</td>
             <td>{{ $item->type_permis }}</td>
             <td>{{ $item->telephone }}</td>
        </tr>
     @endforeach
    </tbody>
</table>
 @endsection

