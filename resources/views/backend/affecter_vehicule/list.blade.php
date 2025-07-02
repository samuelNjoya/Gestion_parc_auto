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
                                <label for="filter-vehicle">Nom conducteur</label>
                                <input type="text"  value="{{ Request::get('nom') }}" placeholder="nom" name="nom">
                            </div>

                             <div class="form-group col-sm-4 col-md-3 col-lg-2 ">
                                <label for="filter-vehicle">Prenom conducteur</label>
                                <input type="text"  value="{{ Request::get('prenom') }}" placeholder="prenom" name="prenom">
                            </div>

                            <div class="form-group col-sm-4 col-md-3 col-lg-2 ">
                                <label for="filter-vehicle">immatriculation</label>
                                <input type="text"  value="{{ Request::get('immatriculation') }}" placeholder="immatriculation" name="immatriculation">
                            </div>

                            {{-- <div class="form-group col-sm-4 col-md-3 col-lg-2 ">
                                <label for="filter-vehicle">Address</label>
                                <input type="text"  value="{{ Request::get('address') }}" placeholder="address" name="address">
                            </div> --}}

                            <div class="form-group col-sm-4 col-md-3 col-lg-2">
                                <label for="filter-status">Statut</label>
                                    <select id="filter-status" name="statut">
                                        <option value="">Select</option>
                                        <option {{ (Request::get('statut') == '1') ? 'selected' : '' }} value="1">Actif</option>
                                        <option {{ (Request::get('statut') == '100') ? 'selected' : '' }} value="100">Inactif</option>
                                    </select>
                            </div>
                           
                            <div class="form-group col-sm-4 col-md-3 col-lg-2">
                                <label class=""></label>
                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-primary" >Filtrer</button>
                                    <a class="btn btn-secondary" href="{{url('panel/affecter_vehicule')}}" > Réinitialiser</a>
                                </div>
                            </div>
                        </div>
                         </form>
                    </div>
                </div>

                <div class="">

                    <div class="d-flex justify-content-between mb-1">
                        <h3 class="">liste des Attributions de vehicule</h3>
                        <a href="{{url('panel/affecter_vehicule/create')}}" class="btn btn-primary pull-rigth d-block"><i class="fas fa-plus me-1"></i>Affecter un vehicule</a>
                    </div>

                      <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                  
                                        <th>#<button class="btn btn-link p-0" onclick="sortTable(0)"><i class="fas fa-sort"></i></button></th>
                                        <th>conducteur <button class="btn btn-link p-0" onclick="sortTable(1)"><i class="fas fa-sort"></i></button></th>
                                        <th>Vehicule <button class="btn btn-link p-0" onclick="sortTable(2)"><i class="fas fa-sort"></i></button></th>
                                        <th>date debut<button class="btn btn-link p-0" onclick="sortTable(3)"><i class="fas fa-sort"></i></button></th>
                                         <th>date fin<button class="btn btn-link p-0" onclick="sortTable(3)"><i class="fas fa-sort"></i></button></th>
                                        <th>Description<button class="btn btn-link p-0" onclick="sortTable(4)"><i class="fas fa-sort"></i></button></th>
                                        <th>Date d'affectation<button class="btn btn-link p-0" onclick="sortTable(5)"><i class="fas fa-sort"></i></button></th>
                                        <th>statut</th>
                                        <th>Actions</th>
                                        
                                    </tr>
                                </thead>
                                <tbody id="TriTableBody">
                                @forelse ($getRecords as $item)  
                                    <tr >
                                            <td >{{$item->id}}</td>
                                            <td >{{$item->getConducteur->nom}}-{{$item->getConducteur->prenom}}</td>
                                            <td >{{$item->getVehicule->immatriculation}}-{{$item->getVehicule->marque}}</td>
                                            <td >{{ date('d-m-y', strtotime($item->date_debut)) }}</td>
                                            <td >{{ date('d-m-y', strtotime($item->date_fin)) }}</td>
                                             <td >{{$item->description}}</td>
                                            <td >{{ date('d-m-y', strtotime($item->created_at)) }}</td>
                                            <td >
                                                 @if ($item->statut == 1)
                                                    <span class="label label-success">Actif</span>
                                                @else
                                                    <span class="label label-danger">Inactif</span>
                                                @endif
                                            </td> 
                                            <td>
                                                <a href="{{ url('panel/affecter_vehicule/edit', $item->id) }}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                                                <a href="{{ url('panel/affecter_vehicule/delete', $item->id) }}" onclick="return confirm('Est vous sur de vouloir supprimé ?');" class="btn btn-danger  btn-sm" ><i class="fas fa-trash"></i></a>
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
