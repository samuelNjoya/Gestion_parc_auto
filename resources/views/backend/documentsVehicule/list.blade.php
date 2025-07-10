@section('styles')
    <style>
   
        .lien_pdf{
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .lien_pdf > i{
            /* display: block;
             width: 30px!important;
             height: 30px!important; */
             color: red;
            
          }
     
    </style>
@endsection

@extends('backend.layouts.app')
@section('content')
 
        <div class="row">
            <div class="col-md-12">
                @include('_message')

                 <div class=" mb-2">
                    <div class="card-body">
                        <h5 class="card-title">Filtres</h5>
                         <form action="" method="get">
                              <div class="filter-row row">
                            <div class="form-group col-sm-4 col-md-3 col-lg-2 ">
                                <label for="filter-vehicle">Id</label>
                                <input type="text"  value="{{ Request::get('id') }}" placeholder="ID" name="id">
                            </div>

                            <div class="form-group col-sm-4 col-md-3 col-lg-2 ">
                                <label for="filter-vehicle">immatriculation</label>
                                <input type="text"  value="{{ Request::get('immatriculation') }}" placeholder="immatriculation" name="immatriculation">
                            </div>

                             <div class="form-group col-sm-4 col-md-3 col-lg-2 ">
                                <label for="filter-vehicle">marque</label>
                                <input type="text"  value="{{ Request::get('marque') }}" placeholder="marque" name="marque">
                            </div>

                            <div class="form-group col-sm-4 col-md-3 col-lg-2 ">
                                <label for="filter-vehicle">type</label>
                                <input type="text"  value="{{ Request::get('type') }}" placeholder="type" name="type">
                            </div>

                            {{-- <div class="form-group col-sm-4 col-md-3 col-lg-2 ">
                                <label for="filter-vehicle">Address</label>
                                <input type="text"  value="{{ Request::get('address') }}" placeholder="address" name="address">
                            </div> --}}


                            <div class="form-group col-sm-4 col-md-3 col-lg-2">
                                <label for="filter-status">Statut</label>
                                    <select id="filter-status" name="statut">
                                        <option value="">Select</option>
                                        <option {{ (Request::get('statut') == '1') ? 'selected' : '' }} value="1">Valide</option>
                                        <option {{ (Request::get('statut') == '100') ? 'selected' : '' }} value="100">Expiré</option>
                                    </select>
                            </div>
                           
                            <div class="form-group col-sm-4 col-md-3 col-lg-2">
                                <label class=""></label>
                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-primary" >Filtrer</button>
                                    <a class="btn btn-secondary" href="{{url('panel/documentsVehicule')}}" > Réinitialiser</a>
                                </div>
                            </div>
                        </div>
                         </form>
                    </div>
                </div>

                <div class="">

                    <div class="d-flex justify-content-between mb-1">
                        <h3 class="">liste des documents du vehicule</h3>
                        <a href="{{url('panel/documentsVehicule/create')}}" class="btn btn-primary pull-rigth d-block"><i class="fas fa-plus me-1"></i>Ajouter un document</a>
                    </div>

                      <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                  
                                        <th>#<button class="btn btn-link p-0" onclick="sortTable(0)"><i class="fas fa-sort"></i></button></th>
                                        <th>Immatriculation <button class="btn btn-link p-0" onclick="sortTable(1)"><i class="fas fa-sort"></i></button></th>
                                        <th>Marque <button class="btn btn-link p-0" onclick="sortTable(2)"><i class="fas fa-sort"></i></button></th>
                                        <th>Type<button class="btn btn-link p-0" onclick="sortTable(3)"><i class="fas fa-sort"></i></button></th>
                                        <th>date dernière MAJ <button class="btn btn-link p-0" onclick="sortTable(4)"><i class="fas fa-sort"></i></button></th>
                                        <th>date expiration<button class="btn btn-link p-0" onclick="sortTable(5)"><i class="fas fa-sort"></i></button></th>
                                        <th>scan pdf<button class="btn btn-link p-0" onclick="sortTable(6)"><i class="fas fa-sort"></i></button></th>
                                        <th>Statut</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="TriTableBody">
                                @forelse ($getRecords as $item)  
                                    <tr >
                                            <td >{{$item->id}}</td>
                                            <td >{{$item->getVehicule->immatriculation}}</td>
                                            <td >{{$item->getVehicule->marque}}</td>
                                            <td >{{$item->type}} </td>
                                            <td >{{ date('d-m-y', strtotime($item->date_derniere_mise_ajour)) }}</td>
                                            {{-- <td >{{ date('d-m-y', strtotime($item->date_expiration)) }}</td> --}}
                                            <td>{{ $item->date_expiration ? \Carbon\Carbon::parse($item->date_expiration)->format('d/m/Y') : '' }}</td>
                                            <td >
                                                @if (!empty($item->getDocumentVehiculeScan()))
                                                    {{-- <img style="border-radius: 50%" width="60px" height="60px"  src="{{ $item->getDocumentVehiculeScan() }}" alt=""> --}}
                                                     {{-- <iframe src="{{ $item->getDocumentVehiculeScan() }}" width="60px" height="60px"></iframe> --}}
                                                      <small><a class="lien_pdf display-6" href="{{ $item->getDocumentVehiculeScan() }}" target="_blank"><i class="fas fa-file-pdf"></i></a></small>
                                                @endif
                                            </td>
                                              <td >
                                                @if ($item->statut == 1)
                                                    <span class="label label-success">Valide</span>
                                                @else
                                                    <span class="label label-danger">Expiré</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ url('panel/documentsVehicule/edit', $item->id) }}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                                                <a href="{{ url('panel/documentsVehicule/delete', $item->id) }}" onclick="return confirm('Est vous sur de vouloir supprimé ?');" class="btn btn-danger  btn-sm" ><i class="fas fa-trash"></i></a>
                                            </td>
                                        </tr> 
                                @empty
                                          <tr>
                                              <td colspan="100%">Pas de donnée</td>
                                          </tr>
                                 @endforelse
                                </tbody>
                            </table>
                       </div>
                                                              

            </div>
            <span class="pull-right"> {{$getRecords->links()}}</span>
            {{-- <span class="pull-right"> {{$getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links()}}</span> H:i A--}}
         </div>                                
        </div>
  

     
 @endsection  
