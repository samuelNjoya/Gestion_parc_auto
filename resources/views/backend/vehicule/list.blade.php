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
                                <label for="filter-vehicle">Immatriculation</label>
                                <input type="text"  value="{{ Request::get('immatriculation') }}" placeholder="immatriculation" name="immatriculation">
                            </div>

                            <div class="form-group col-sm-4 col-md-3 col-lg-2 ">
                                <label for="filter-vehicle">Marque</label>
                                <input type="text"  value="{{ Request::get('marque') }}" placeholder="marque" name="marque">
                            </div>

                             <div class="form-group col-sm-4 col-md-3 col-lg-2 ">
                                <label for="filter-vehicle">Modèle</label>
                                <input type="text"  value="{{ Request::get('modele') }}" placeholder="modele" name="modele">
                            </div>

                            <div class="form-group col-sm-4 col-md-3 col-lg-2 ">
                                <label for="filter-vehicle">Type caburant</label>
                                <input type="text"  value="{{ Request::get('type_caburant') }}" placeholder="type_caburant" name="type_caburant">
                            </div>

                            <div class="form-group col-sm-4 col-md-3 col-lg-2 ">
                                <label for="filter-vehicle">departement</label>
                                <input type="text"  value="{{ Request::get('departement') }}" placeholder="departement" name="departement">
                            </div>

                            <div class="form-group col-sm-4 col-md-3 col-lg-2">
                                <label for="filter-status">Statut</label>
                                    <select id="filter-status" name="statut">
                                        <option value="">Select</option>
                                        <option {{ (Request::get('statut') == '1') ? 'selected' : '' }} value="1">En service</option>
                                        <option {{ (Request::get('statut') == '100') ? 'selected' : '' }} value="100">Inactif</option>
                                    </select>
                            </div>
                           
                            <div class="form-group col-sm-4 col-md-3 col-lg-2">
                                <label class=""></label>
                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-primary" >Filtrer</button>
                                    <a class="btn btn-secondary" href="{{url('panel/vehicule')}}" > Réinitialiser</a>
                                </div>
                            </div>
                        </div>
                         </form>
                    </div>
                </div>

                <div class="">

                    <div class="d-flex justify-content-between mb-1">
                        <h3 class="">liste des vehicules</h3>
                        {{-- <a href="{{url('panel/vehicule/create')}}" class="btn btn-primary pull-rigth d-block"><i class="fas fa-plus me-1"></i>Ajouter vehicule</a> --}}
                        <div class="pull-right">
                            <a href="{{url('panel/vehicule/users_pdf')}}" class="btn btn-danger "><i class="fas fa-file-pdf me-1"></i>Print</a>
                            <a href="{{url('panel/vehicule/users_excel')}}" class="btn btn-info "><i class="fas fa-print me-1"></i>Excel</a>
                            <a href="{{url('panel/vehicule/create')}}" class="btn btn-primary "><i class="fas fa-plus me-1"></i>Ajouter conducteur</a>
                       </div>
                    </div>

                      <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                  
                                        <th>#<button class="btn btn-link p-0" onclick="sortTable(0)"><i class="fas fa-sort"></i></button></th>
                                        <th>Photo</th>
                                        <th>Marque <button class="btn btn-link p-0" onclick="sortTable(1)"><i class="fas fa-sort"></i></button></th>
                                        <th>Modèle <button class="btn btn-link p-0" onclick="sortTable(2)"><i class="fas fa-sort"></i></button></th>
                                        <th>kilometrage <button class="btn btn-link p-0" onclick="sortTable(3)"><i class="fas fa-sort"></i></button></th>
                                        <th>Type caburant <button class="btn btn-link p-0" onclick="sortTable(4)"><i class="fas fa-sort"></i></button></th>
                                        <th>Departement <button class="btn btn-link p-0" onclick="sortTable(5)"><i class="fas fa-sort"></i></button></th>
                                        <th>Statut <button class="btn btn-link p-0" onclick="sortTable(6)"><i class="fas fa-sort"></i></button></th>
                                        <th>Created Date</th>
                                        <th>Actions</th>
                                        
                                    </tr>
                                </thead>
                                <tbody id="TriTableBody">
                                @forelse ($getRecords as $item)  
                                    <tr >
                                            <td >{{$item->immatriculation}}</td>
                                            <td >
                                                @if (!empty($item->getPhotoVoiture()))
                                                    <img style="border-radius: 50%" width="60px" height="60px"  src="{{ $item->getPhotoVoiture() }}" alt="">
                                                @endif
                                            </td>
                                            <td >{{$item->marque}}</td>
                                            <td >{{$item->modele}}</td>
                                            <td >{{$item->kilometrage}} KM</td>
                                            <td >{{$item->type_carburant}}</td>
                                            <td >{{$item->departement}}</td>
                                            <td >
                                                @if ($item->statut == 1)
                                                    <span class="label label-success">En service</span>
                                                @else
                                                    <span class="label label-danger">Inactif</span>
                                                @endif
                                            </td>
                                            <td >{{ date('d-m-y H:i A', strtotime($item->created_at)) }}</td>
                                            <td>
                                                <a href="{{ url('panel/vehicule/view', $item->id) }}" class="btn btn-success btn-sm"><i class="fa-regular fa-eye"></i></a>
                                                <a href="{{ url('panel/vehicule/edit', $item->id) }}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                                                <a href="{{ url('panel/vehicule/delete', $item->id) }}" onclick="return confirm('Are you sure do you want to delete ?');" class="btn btn-danger  btn-sm" ><i class="fas fa-trash"></i></a>
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
            {{-- <span class="pull-right"> {{$getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links()}}</span> --}}
         </div>                                
        </div>
  

     
 @endsection  
