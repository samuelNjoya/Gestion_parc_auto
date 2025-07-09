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
                                <label for="filter-vehicle">nom</label>
                                <input type="text"  value="{{ Request::get('nom') }}" placeholder="nom" name="nom">
                            </div>

                             <div class="form-group col-sm-4 col-md-3 col-lg-2 ">
                                <label for="filter-vehicle">reference</label>
                                <input type="text"  value="{{ Request::get('reference') }}" placeholder="reference" name="reference">
                            </div>

                            {{-- <div class="form-group col-sm-4 col-md-3 col-lg-2 ">
                                <label for="filter-vehicle">titre</label>
                                <input type="text"  value="{{ Request::get('titre') }}" placeholder="titre" name="titre">
                            </div> --}}

                            {{-- <div class="form-group col-sm-4 col-md-3 col-lg-2 ">
                                <label for="filter-vehicle">date</label>
                                <input type="text"  value="{{ Request::get('date') }}" placeholder="date" name="date">
                            </div> --}}

                             {{-- <div class="form-group col-sm-4 col-md-3 col-lg-2 ">
                                <label for="filter-vehicle">cout</label>
                                <input type="text"  value="{{ Request::get('cout') }}" placeholder="cout" name="cout">
                            </div> --}}

                            <div class="form-group col-sm-4 col-md-3 col-lg-2">
                                <label for="filter-status">Statut</label>
                                    <select id="filter-status" name="statut">
                                        <option value="">Select</option>
                                        <option {{ (Request::get('statut') == '1') ? 'selected' : '' }} value="1">Valide</option>
                                        <option {{ (Request::get('statut') == '100') ? 'selected' : '' }} value="100">Invalide</option>
                                    </select>
                            </div>

                          
                           
                            <div class="form-group col-sm-4 col-md-3 col-lg-2">
                                <label class=""></label>
                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-primary" >Filtrer</button>
                                    <a class="btn btn-secondary" href="{{url('panel/piece')}}" > Réinitialiser</a>
                                </div>
                            </div>
                        </div>
                         </form>
                    </div>
                </div>

                <div class="">

                    <div class="d-flex justify-content-between mb-1">
                        <h3 class="">liste des pieces associée aux interventions techniques</h3>
                        {{-- <a href="{{url('panel/intervention_tech/create')}}" class="btn btn-primary pull-rigth d-block"><i class="fas fa-plus me-1"></i></a> --}}
                        <div class="pull-right">
                            <a href="{{url('panel/piece/users_pdf')}}" class="btn btn-danger "><i class="fas fa-file-pdf me-1"></i>Print</a>
                            <a href="{{url('panel/intervention_tech')}}" class="btn btn-primary "><i class="fas fa-list me-1"></i>intervention Techniques</a> 
                       </div>
                    </div>

                      <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                  
                                        <th>#<button class="btn btn-link p-0" onclick="sortTable(0)"><i class="fas fa-sort"></i></button></th>
                                        <th>Titre intervention <button class="btn btn-link p-0" onclick="sortTable(1)"><i class="fas fa-sort"></i></button></th>
                                        <th>Nom <button class="btn btn-link p-0" onclick="sortTable(2)"><i class="fas fa-sort"></i></button></th>
                                        <th>Reference<button class="btn btn-link p-0" onclick="sortTable(3)"><i class="fas fa-sort"></i></button></th>
                                         <th>date installation <button class="btn btn-link p-0" onclick="sortTable(3)"><i class="fas fa-sort"></i></button></th>
                                        <th>date expiration<button class="btn btn-link p-0" onclick="sortTable(4)"><i class="fas fa-sort"></i></button></th>
                                        <th>coût unitaire<button class="btn btn-link p-0" onclick="sortTable(5)"><i class="fas fa-sort"></i></button></th>
                                        <th>quantite</th>
                                        <th>Coût total</th>
                                        <th>kilometrage a l'installation</th>
                                        <th>statut</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="TriTableBody">
                                @forelse ($getRecords as $item)  
                                    <tr >
                                            <td >{{$item->id}}</td> 
                                            <td >{{$item->getInterventionTechnique?->titre}} - ({{$item->getInterventionTechnique?->getVehicule->immatriculation}})</td>
                                            <td >{{$item->nom}}</td>
                                            <td >{{$item->reference}}</td>
                                            <td >{{ date('d-m-y', strtotime($item->date_installation)) }}</td>
                                            <td >{{ date('d-m-y', strtotime($item->date_expiration)) }}</td>
                                            <td >{{$item->cout_unitaire}} fcfa</td>
                                            <td >{{$item->quantite}}</td>
                                            <td >{{$item->cout_unitaire*$item->quantite}} fcfa</td>
                                            <td >{{$item->kilometrage_installation}} km</td>
                                            <td >
                                                @if ($item->statut == 1)
                                                    <span class="label label-success">Valide</span>
                                                @else
                                                    <span class="label label-danger">Invalide</span>
                                                @endif
                                            </td>    
                                            <td> 
                                                <a href="{{ url('panel/piece/edit', $item->id) }}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                                                <a href="{{ url('panel/piece/delete', $item->id) }}" onclick="return confirm('Est vous sur de vouloir supprimé ?');" class="btn btn-danger  btn-sm" ><i class="fas fa-trash"></i></a>
                                              
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
  
<!-- Modal Bootstrap -->
<div class="modal fade" id="addPieceModal" tabindex="-1" aria-labelledby="addPieceModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="POST" action="{{route('pieces.insert')}}" novalidate id="formulaire">
      @csrf
      <input type="hidden" name="intervention_id" id="intervention_id" value="">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addPieceModalLabel">Ajouter une pièce</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
        </div>
        <div class="modal-body">
            <div class="form-group side-by-side">
                <div class="form-group">
                    <label for="piece_name" class="form-label">Nom de la pièce</label>
                    <input type="text" name="nom" class="form-control" value="{{old('nom')}}" id="piece_name" class="" required>
                     <div class="invalid-feedback">Veuillez sélectionner un véhicule.</div>
                </div>
                <div class="form-group">
                    <label for="" class="form-label">reference</label>
                    <input type="text" name="reference" class="form-control" value="{{old('reference')}}" id="" class="" required>
                     <div class="invalid-feedback">Veuillez sélectionner un véhicule.</div>
                </div>
            </div>
            <div class="form-group side-by-side">
                    <div class="form-group">
                        <label for="vehicule" class="form-label">Date installation</label>
                         <input type="date" name="date_installation" value="{{old('date_installation')}}" id="dateIntervention" class="form-control" required />
                        <div class="invalid-feedback">Veuillez sélectionner un véhicule.</div>
                    </div>
                    <div class="form-group">
                        <label for="dateIntervention" class="form-label">Date expiration</label>
                        <input type="date" name="date_expiration" value="{{old('date_expiration')}}" id="dateIntervention" class="form-control" required />
                        <div class="invalid-feedback">Veuillez saisir une date.</div>
                    </div>
            </div> 
             <div class="form-group side-by-side">
                    <div class="form-group">
                        <label for="vehicule" class="form-label">Coût unitaire</label>
                         <input type="text" name="cout_unitaire" value="{{old('cout_unitaire')}}" id="dateIntervention" class="form-control" required />
                        <div class="invalid-feedback">Veuillez sélectionner un véhicule.</div>
                    </div>
                    <div class="form-group">
                        <label for="dateIntervention" class="form-label">quantite</label>
                        <input type="number" name="quantite" value="{{old('quantite')}}" id="dateIntervention" class="form-control" required />
                        <div class="invalid-feedback">Veuillez saisir une date.</div>
                    </div>
            </div>  
            <div class="form-group side-by-side">
                    <div class="form-group">
                        <label for="vehicule" class="form-label">kilometrage installation</label>
                         <input type="number" name="kilometrage_installation" value="{{old('kilometrage_installation')}}" id="dateIntervention" class="form-control" required />
                        <div class="invalid-feedback">Veuillez sélectionner un véhicule.</div>
                    </div>
                    <div class="form-group">
                        <label for="dateIntervention" class="form-label">duree_vie</label>
                        <input type="text" name="duree_vie" value="{{old('duree_vie')}}" id="dateIntervention" class="form-control" required />
                        <div class="invalid-feedback">Veuillez saisir une date.</div>
                    </div>
            </div>   
                <div class="form-group">
                    <label for="description" class="form-label">Description</label>
                    <textarea id="description" class="form-control" name="description" value="{{old('description')}}" rows="3" placeholder="Description"></textarea>
                </div>

                 <div class="form-group">
                            <label for="license_type">Statut <span class="required">*</span></label>
                            <select id="license_type" name="statut" class="form-control" required aria-required="true">
                                <option value="">Sélectionnez</option>
                                <option value="1">Valide</option>
                                <option value="0">Invalide</option>
                            </select>
                        <div class="invalid-feedback">Veuillez saisir une date.</div>
                 </div>

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Enregistrer</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
        </div>
      </div>
    </form>
  </div>
</div>
     
 @endsection  


