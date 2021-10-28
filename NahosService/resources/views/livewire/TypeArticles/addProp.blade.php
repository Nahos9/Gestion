<div class="modal fade" id="modalProp" tabindex="-1" role="dialog" wire:ignore.self>
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Gestion des caracteristique de "{{ optional($nameEdit)->nomPropriete }}" </h5>

            </div>
            <div class="modal-body">
               <div class="d-flex my-4 bg-gray-light p-3">
                    <div class="d-flex flex-grow-1 mr-2">
                        <div class="flex-grow-1 mr-2">
                            <input type="text" placeholder="Nom propriété" wire:model="newPropModel.nomPropriete" class="form-control @error("newPropModel.nomPropriete") is-invalid @enderror">
                            @error("newPropModel.nomPropriete")
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="flex-grow-1">
                            <select class="form-control @error("newPropModel.estObligatoire") is-invalid @enderror" wire:model="newPropModel.estObligatoire">
                                <option value="">--Champ Obligatoire--</option>
                                <option value="1">OUI</option>
                                <option value="0">NON</option>
                            </select>
                            @error("newPropModel.estObligatoire")
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div>
                    <button class="btn btn-success" wire:click="addProp()">Ajouter</button>
                    </div>
               </div>
               <table class="table table-bordered">
                    <thead class="bg-primary">
                        <th>Nom propriété</th>
                        <th>Est obligatoire</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @forelse ($proprietesarticles as $proprietearticle)
                            <tr>
                                <td>{{ $proprietearticle->nomPropriete }}</td>
                                <td>{{ $proprietearticle->estObligatoire == 0 ? "NON": "OUI" }}</td>
                                <td>
                                    <button class="btn btn-link"> <i class="far fa-edit"></i> </button>

                                    @if (count($proprietearticle->articles)==0)
                                   
                                    <button class="btn btn-link" wire:click="showDeletePrompt('{{$proprietearticle->nomPropriete}}', {{$proprietearticle->id}})"> <i class="far fa-trash-alt"></i> </button>
                                        
                                    @endif
                                
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3">
                                    <span class="text-info">Vous n'avez pas encore des propriétés définies pour ce type d'article</span>
                                </td>
                            </tr>
                        @endforelse

                    </tbody>
               </table>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" wire:click="closeModal">Fermer</button>
            </div>
        </div>
    </div>
</div>