<div class="modal fade" id="modalProp" tabindex="-1" role="dialog" wire:ignore.self>
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Gestion des caracteristique  </h5>

            </div>
            <div class="modal-body">
               <div class="d-flex my-4 bg-gray-light p-3">
                    <div class="d-flex flex-grow-1 mr-2">
                        <div class="flex-grow-1 mr-2">
                            <input type="text" placeholder="Nom propriété" wire:model="newPropModel.nomPropriete" class="form-control">
                         
                        </div>
                        <div class="flex-grow-1">
                            <select class="form-control ">
                                <option value="">--Champ Obligatoire--</option>
                                <option value="1">OUI</option>
                                <option value="0">NON</option>
                            </select>
                          
                    </div>
                    <div>
                    <button class="btn btn-success" >Ajouter</button>
                    </div>
               </div>
               <table class="table table-bordered">
                    <thead class="bg-primary">
                        <th>Nom propriété</th>
                        <th>Est obligatoire</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                            <tr>
                                <td>Samsung S10</td>
                                <td>D'accord</td>
                                <td>
                                    <button class="btn btn-link" > <i class="far fa-edit"></i> </button>

                              
                                   
                                    <button class="btn btn-link" > <i class="far fa-trash-alt"></i> </button>

                                
                                </td>
                            </tr>
 
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
                <button type="button" class="btn btn-danger">Fermer</button>
            </div>
        </div>
    </div>
</div>