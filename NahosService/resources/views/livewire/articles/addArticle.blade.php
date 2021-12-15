<div class="modal fade" id="modalAddArticle" tabindex="-1" role="dialog" wire:ignore.self>
  <div class="modal-dialog modal-xl">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title">Ajout d'un nouvel article</h5>

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
                  <input type="text" class="form-control" wire:model="addArticle.nom" placeholder="Nom de l'article">
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" wire:model="addArticle.noSerie" placeholder="Numéro de série">
                </div>
                <div class="form-group">
                  <select class="form-control" wire:model="addArticle.type">
                    <option value=""></option>
                    @foreach ($typearticles as $typearticle)
                    <option value="{{$typearticle->id}}">{{$typearticle->nom}}</option>
                  @endforeach
                  </select>
                </div>
                {{-- affichage de la partie dynamique des chanps liés au type de la propriété --}}
                @if ($proprieteArticles != null)
                <p style="border: 1px dashed black "></p>
              <div>
                @foreach ($proprieteArticles as $propriete)
                <div class="form-group">
                  <label for="">{{$propriete->nomPropriete}} @if (!$propriete->estObligatoire) (optionel) @endif</label>
                  @php
                      $field = "addArticle.prop.".$propriete->nomPropriete;
                      // addArticle.prop.{{$propriete->nomPropriete}}
                  @endphp
                  <input type="text" class="form-control" wire:model="{{ $field }}">
                </div>
                @endforeach
              </div>
              @endif
              </div>
              
              <div class="p-4">
                        <div class="form-group">
                            <input type="file"  wire:model="images" id="image{{$inputFile}}">
                        </div>
                        <div style="border: 1px solid #d0d1d3; border-radius:20px; height:300px; overflow:hidden;">
                          @if ($images)

                          <img src="{{ $images->temporaryUrl() }}" style="height: 200px;width:200px">
                      @endif
                        </div>
              </div>
            </div>
           
            
          </div>
          <div class="modal-footer">
              <button type="submit" class="btn btn-success">Ajouter</button>
              <button type="button" class="btn btn-danger" wire:click="closeModal">Fermer</button>
          </div>
        </form>
      </div>
  </div>
</div>