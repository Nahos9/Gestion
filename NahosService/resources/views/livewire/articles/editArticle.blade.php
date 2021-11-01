<div class="modal fade" id="editModalProp" style="z-index: 1200;" tabindex="-1" role="dialog" wire:ignore.self>
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modification de l'article </h5>

            </div>
            <div class="modal-body">
               <div class="d-flex my-4 bg-gray-light p-3">
                    <div class="d-flex flex-grow-1 mr-2">
                        <div class="flex-grow-1 mr-2">
                            <input type="text" placeholder="Nom propriété" class="form-control ">
                          
                        </div>
                        <div class="flex-grow-1">
                            <select class="form-control">
                                <option value="">--Champ Obligatoire--</option>
                                <option value="1">OUI</option>
                                <option value="0">NON</option>
                            </select>
                        </div>
                    </div>
                    <div>
                    <button class="btn btn-primary" >Valider</button>
                    </div>
               </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger">Fermer</button>
            </div>
        </div>
    </div>
</div>