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
                                <label for="filter-vehicle">date_conso</label>
                                <input type="date"  value="{{ Request::get('date_conso') }}" placeholder="date_conso" name="date_conso">
                            </div>

                            <div class="form-group col-sm-4 col-md-3 col-lg-2 ">
                                <label for="filter-vehicle">quantite_conso</label>
                                <input type="text"  value="{{ Request::get('quantite_conso') }}" placeholder="quantite_conso" name="quantite_conso">
                            </div>

                            <div class="form-group col-sm-4 col-md-3 col-lg-2 ">
                                <label for="filter-vehicle">cout_conso</label>
                                <input type="text"  value="{{ Request::get('cout_conso') }}" placeholder="cout_conso" name="cout_conso">
                            </div>

                            {{-- <div class="form-group col-sm-4 col-md-3 col-lg-2 ">
                                <label for="filter-vehicle">Prestataire</label>
                                <input type="text"  value="{{ Request::get('fournisseur_id') }}" placeholder="address" name="fournisseur_id">
                            </div> --}}

                            {{-- <div class="form-group col-sm-4 col-md-3 col-lg-2">
                                <label for="filter-status">Station</label>
                                    <select id="filter-status" name="statut">
                                        <option value="">Select</option>
                                        <option {{ (Request::get('statut') == '1') ? 'selected' : '' }} value="1">Actif</option>
                                        <option {{ (Request::get('statut') == '100') ? 'selected' : '' }} value="100">Inactif</option>
                                    </select>
                            </div> --}}
                           
                            <div class="form-group col-sm-4 col-md-3 col-lg-2">
                                <label class=""></label>
                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-primary" >Filtrer</button>
                                    <a class="btn btn-secondary" href="{{url('panel/conso_carburant')}}" > Réinitialiser</a>
                                </div>
                            </div>
                        </div>
                         </form>
                    </div>
                </div>

                <div class="">

                    <div class="d-flex justify-content-between mb-1">
                        <h3 class="">liste des conso_carburants</h3>
                        
                        <div class="pull-right">
                            <a href="{{url('panel/conso_carburant/users_pdf')}}" class="btn btn-danger "><i class="fas fa-file-pdf me-1"></i>Print</a>
                            {{-- <a href="{{url('panel/conso_carburant/users_excel')}}" class="btn btn-info "><i class="fas fa-print me-1"></i>Excel</a> --}}
                           <a href="{{url('panel/conso_carburant/create')}}" class="btn btn-primary"><i class="fas fa-plus me-1"></i>Ajouter conso_carburant</a>
                       </div>
                    </div>


                      <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                  
                                        <th>#<button class="btn btn-link p-0" onclick="sortTable(0)"><i class="fas fa-sort"></i></button></th>
                                        <th>immatriculation <button class="btn btn-link p-0" onclick="sortTable(1)"><i class="fas fa-sort"></i></button></th>
                                        <th>Marque <button class="btn btn-link p-0" onclick="sortTable(2)"><i class="fas fa-sort"></i></button></th>
                                        <th>date<button class="btn btn-link p-0" onclick="sortTable(3)"><i class="fas fa-sort"></i></button></th>
                                         <th>quantité <button class="btn btn-link p-0" onclick="sortTable(3)"><i class="fas fa-sort"></i></button></th>
                                        <th>cout<button class="btn btn-link p-0" onclick="sortTable(4)"><i class="fas fa-sort"></i></button></th>
                                        <th>kilometrage_plein<button class="btn btn-link p-0" onclick="sortTable(5)"><i class="fas fa-sort"></i></button></th>
                                        <th>Prestataire</th>
                                        <th>Actions</th>
                                        
                                    </tr>
                                </thead>
                                <tbody id="TriTableBody">
                                @forelse ($getRecords as $item)  
                                    <tr >
                                            <td >{{$item->id}}</td>
                                            <td >{{$item->getVehicule->immatriculation}}</td>
                                            <td >{{$item->getVehicule->marque}}</td>
                                            <td >{{ date('d-m-y', strtotime($item->date_conso)) }}</td>
                                            <td >{{$item->quantite_conso}} l</td>
                                            <td >{{$item->cout_conso}} fcfa</td>
                                            <td >{{$item->kilometrage_plein}} km</td>
                                            <td >{{$item->getFournisseur->nom}}</td>    
                                            <td>
                                                <a href="{{ url('panel/conso_carburant/edit', $item->id) }}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                                                <a href="{{ url('panel/conso_carburant/delete', $item->id) }}" onclick="return confirm('Est vous sur de vouloir supprimé ?');" class="btn btn-danger  btn-sm" ><i class="fas fa-trash"></i></a>
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
