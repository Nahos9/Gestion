<div class="modal fade" id="editModalArticle" tabindex="-1" role="dialog" wire:ignore.self>
  <div class="modal-dialog modal-xl">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title">Modification d'un  article</h5>

          </div>
          <form wire:submit.prevent="ajouterArticle">
          <div class="modal-body">
            
            <div class="d-flex">
              <div class="my-4 bg-gray-light p-3 flex-grow-1">
                @if ($errors->any())
              <div class="alert alert-danger alert-dismissible">
                <h5><i class="icon fas fa-ban"></i> Erreurs</h5>
                 <ul>
                     @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                     @endforeach
                   </ul>
              </div>
              @endif
                <div class="form-group">
                  <input type="text" class="form-control" wire:model="editArticle.nom" placeholder="Nom de l'article">
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" wire:model="editArticle.noSerie" placeholder="Numéro de série">
                </div>
                <div class="form-group">
                  <select class="form-control" wire:model="editArticle.type_article_id">
                    <option value=""></option>
                  
                    <option value="{{$editArticle["type_article_id"]}}">{{$editArticle["type"]['nom']}}</option>
                 
                  </select>
                </div>
                {{-- affichage de la partie dynamique des chanps liés au type de la propriété --}}
                @if ($editArticle["article_proprietes"] != [])
                <p style="border: 1px dashed black "></p>
              <div>
                @foreach ($editArticle["article_proprietes"] as $key => $articlePropriete)
                <div class="form-group">
                  <label for="">{{$articlePropriete["propriete"]["nomPropriete"]}} @if (!$articlePropriete["propriete"]["estObligatoire"]) (optionel) @endif</label>
               
                  <input type="text" class="form-control" wire:model="editArticle.article_proprietes.{{$key}}.valeur">
                </div>
                @endforeach
              </div>
              @endif
              </div>
              
              <div class="p-4">
                        <div class="form-group">
                            <input type="file"  wire:model="images">
                        </div>
                        <div style="border: 1px solid #d0d1d3; border-radius:20px; height:300px; overflow:hidden;">
                          @if ($imagesEdit)

                          <img src="{{ $imagesEdit->temporaryUrl() }}" style="height: 200px;width:200px">
                      @endif
                        </div>
              </div>
            </div>
           
            
          </div>
          <div class="modal-footer">
              <button type="submit" class="btn btn-success">Ajouter</button>
              <button type="button" class="btn btn-danger" wire:click="closeEditModal">Fermer</button>
          </div>
        </form>
      </div>
  </div>
</div>