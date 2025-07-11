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
                                <label for="filter-vehicle">id</label>
                                <input type="text"  value="{{ Request::get('id') }}" placeholder="id" name="id">
                            </div>

                            <div class="form-group col-sm-4 col-md-3 col-lg-2 ">
                                <label for="filter-vehicle">Immatriculation</label>
                                <input type="text"  value="{{ Request::get('immatriculation') }}" placeholder="immatriculation" name="immatriculation">
                            </div>

                            <div class="form-group col-sm-4 col-md-3 col-lg-2 ">
                                <label for="filter-vehicle">Marque</label>
                                <input type="text"  value="{{ Request::get('marque') }}" placeholder="marque" name="marque">
                            </div>

                         

                            <div class="form-group col-sm-4 col-md-3 col-lg-2 ">
                                <label for="filter-vehicle">Type</label>
                                <input type="text"  value="{{ Request::get('type') }}" placeholder="type" name="type">
                            </div>

                            

                            <div class="form-group col-sm-4 col-md-3 col-lg-2">
                                <label for="filter-status">Statut</label>
                                    <select id="filter-status" name="statut">
                                        <option value="">Select</option>
                                        <option {{ (Request::get('statut') == '1') ? 'selected' : '' }} value="1">En attente</option>
                                        <option {{ (Request::get('statut') == '100') ? 'selected' : '' }} value="100">Résolu</option>
                                    </select>
                            </div>
                           
                            <div class="form-group col-sm-4 col-md-3 col-lg-2">
                                <label class=""></label>
                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-primary" >Filtrer</button>
                                    <a class="btn btn-secondary" href="{{url('panel/panne')}}" > Réinitialiser</a>
                                </div>
                            </div>
                        </div>
                         </form>
                    </div>
                </div>

                <div class="">

                    <div class="d-flex justify-content-between mb-1">
                        <h3 class="">liste des pannes</h3>
                        {{-- <a href="{{url('panel/panne/create')}}" class="btn btn-primary pull-rigth d-block"><i class="fas fa-plus me-1"></i>Ajouter panne</a> --}}
                        <div class="pull-right">
                            {{-- <a href="{{url('panel/panne/users_pdf')}}" class="btn btn-danger "><i class="fas fa-file-pdf me-1"></i>Print</a>
                            <a href="{{url('panel/panne/users_excel')}}" class="btn btn-info "><i class="fas fa-print me-1"></i>Excel</a>
                            <a href="{{url('panel/panne/create')}}" class="btn btn-primary "><i class="fas fa-plus me-1"></i>Ajouter conducteur</a> --}}
                       </div>
                    </div>

                      <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                  
                                        <th>#<button class="btn btn-link p-0" onclick="sortTable(0)"><i class="fas fa-sort"></i></button></th>
                                        <th>Photo</th>
                                        <th>Voiture</th>
                                         @if($userRole != 4)
                                               <th>Conducteur</th>
                                         @endif
                                        <th>Type <button class="btn btn-link p-0" onclick="sortTable(1)"><i class="fas fa-sort"></i></button></th>
                                        <th>Description <button class="btn btn-link p-0" onclick="sortTable(2)"><i class="fas fa-sort"></i></button></th>
                                        <th>kilometrage <button class="btn btn-link p-0" onclick="sortTable(2)"><i class="fas fa-sort"></i></button></th>
                                        <th>Date <button class="btn btn-link p-0" onclick="sortTable(3)"><i class="fas fa-sort"></i></button></th>
                                        <th>Localisation <button class="btn btn-link p-0" onclick="sortTable(4)"><i class="fas fa-sort"></i></button></th>
                                        {{-- <th>Departement <button class="btn btn-link p-0" onclick="sortTable(5)"><i class="fas fa-sort"></i></button></th> --}}
                                        <th>Statut <button class="btn btn-link p-0" onclick="sortTable(6)"><i class="fas fa-sort"></i></button></th>
                                        <th>Created Date</th>
                                        <th>Actions</th>
                                        
                                    </tr>
                                </thead>
                                <tbody id="TriTableBody">
                                @forelse ($getRecords as $item)  
                                    <tr >
                                            <td >{{$item->id}}</td>
                                            <td >
                                                @if (!empty($item->getPhotoPanne()))
                                                    <img style="border-radius: 50%" width="60px" height="60px"  src="{{ $item->getPhotoPanne() }}" alt="">
                                                @endif
                                            </td>
                                            <td >({{$item->getAffectationVehicule->immatriculation}})-({{$item->getAffectationVehicule->marque}})</td>
                                             @if($userRole != 4)
                                               <td>{{$item->getConducteur->nom}}-{{$item->getConducteur->prenom}}</td> 
                                             @endif
                                            <td >{{$item->type}}</td>
                                            <td >{{$item->description}}</td>
                                            <td >{{$item->kilometrage_panne}} KM</td>
                                            <td >{{ date('d-m-y H:i A', strtotime($item->date_panne)) }}</td>
                                            <td >{{$item->localisation}}</td>
                                            <td >
                                                @if ($item->statut == 1)
                                                    <span class="label label-success">En attente</span>
                                                @else
                                                    <span class="label label-danger"> Résolu</span>
                                                @endif
                                            </td>
                                            <td >{{ date('d-m-y H:i A', strtotime($item->created_at)) }}</td>
                                            <td>
                                                {{-- <a href="{{ url('panel/panne/view', $item->id) }}" class="btn btn-success btn-sm"><i class="fa-regular fa-eye"></i></a> --}}

                                                <a href="{{ url('panel/panne/edit', $item->id) }}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>

                                                @if (Auth::user()->role == 1 || Auth::user()->role == 2)
                                                   <a href="{{ url('panel/panne/delete', $item->id) }}" onclick="return confirm('Are you sure do you want to delete ?');" class="btn btn-danger  btn-sm" ><i class="fas fa-trash"></i></a>
                                                @endif
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
