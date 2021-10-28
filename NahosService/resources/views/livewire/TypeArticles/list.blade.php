<div>
    <div class="col-12 ">
        <div class="card p-4 mt-4 ">
          <div class="card-header bg-primary d-flex align-items-center">
            <h3 class="card-title flex-grow-1"><i class="fa fa-list fa-2x"></i> Liste des types articles</h3>
    
            <div class="card-tools d-flex align-items-center">
                <a href="" class="btn btn-link text-white mr-4 d-block" wire:click.prevent='toggleAddTypeArticle'><i class="fas fa-user-plus"></i>Nouvau type d'article</a>
              <div class="input-group input-group-md " style="width: 250px;">
                <input type="text" name="table_search" class="form-control float-right" placeholder="Search" wire:model.debounce='search'>
    
                <div class="input-group-append">
                  <button type="submit" class="btn btn-default">
                    <i class="fas fa-search"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive p-0" style="height: 300px;">
            <table class="table table-head-fixed text-nowrap table-striped">
              <thead>
                <tr>
                  <th style="width: 50%;">Type d'article</th>
                  <th class="text-center" style="width: 20%;">Ajouté</th>
                  <th class="text-center" style="width: 30%">Actions</th>
                </tr>
              </thead>
              <tbody>
                @if ($isAddType)
                  <tr>
                    <td colspan="2">
                      <input type="text" placeholder="Nom type article" class="form-control @error('newTypeArticleName') is-invalid @enderror" wire:keydown.enter='addTypeArticle' wire:model='newTypeArticleName'>
                      @error('newTypeArticleName')
                      <div>
                        <span class="text-danger">{{$message}}</span>
                      </div>
                  @enderror
                    </td>
                   
                    <td class="text-center">
                      <button class="btn btn-link" wire:click='addTypeArticle'><i class="fas fa-check"></i>Valider</button>
                      <button class="btn btn-link" wire:click='toggleAddTypeArticle'><i class="far fa-window-close btn btn-link"></i>Annuler</button>
                    </td>

                  </tr>
                @endif
                @foreach ($typearticles as $typearticle)
                        <tr>
                            <td >{{$typearticle->nom}}</td>
                            <td class="text-center">{{optional($typearticle->created_at)->diffForHumans()}}</td>
                            <td class="text-center">
                              <button class="btn btn-link" wire:click='editTypeArticle({{$typearticle->id}})'> <i class="far fa-edit btn btn-link"> Editer</i></button>
                              <button class="btn btn-link" wire:click='showEditProp({{$typearticle->id}})'><i class="fa fa-list"> Propriétés</i></button>
                              @if (count($typearticle->articles)==0)
                              
                              <button class="btn btn-link" wire:click='deleteConfTypeArticle({{$typearticle->id}})'> <i class="far fa-trash-alt btn btn-link"> Supprimer</i></button>
                                  
                              @endif
                            </td>
                        </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <div class="card-footer">
            <div class="float-right">
              {{$typearticles->links()}}
          </div>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
</div>

