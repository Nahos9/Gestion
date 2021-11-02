{{-- <div class="modal fade" id="modalAddArticle" tabindex="-1" role="dialog" wire:ignore.self>
  <div class="modal-dialog modal-xl">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title">Ajout d'un nouvel article</h5>

          </div>
          <div class="modal-body">
            <div class="d-flex">
              <div class="flex-grow-1">
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
              </div>
              <div class="flex grow-1 ">
                  <h1>Bonjour</h1>
              </div>
            </div>
            @if ($proprieteArticles != null)
            <div>
              @foreach ($proprieteArticles as $propriete)
              <div class="form-group">
                <label for="">{{$propriete->nomPropriete}}</label>
                <input type="text" class="form-control" wire:model="addArticle.noSerie" placeholder="Numéro de série">
              </div>
              @endforeach
            </div>
            @endif
            
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-danger" wire:click="closeModal">Fermer</button>
          </div>
      </div>
  </div>
</div> --}}
<div>
    <div class="col-12 ">
        <div class="card p-4 mt-4 ">
          <div class="card-header bg-primary d-flex align-items-center">
            <h3 class="card-title flex-grow-1"><i class="fa fa-list fa-2x"></i> Liste des  articles</h3>
    
            <div class="card-tools d-flex align-items-center">
                <a class="btn btn-link text-white mr-4 d-block" wire:click="showAddForm" ><i class="fas fa-user-plus"></i>Ajouté un article</a>
              <div class="input-group input-group-md " style="width: 250px;">
                <input type="text" name="table_search" wire:model.debounce.250ms='search' class="form-control float-right" placeholder="Search">
    
                <div class="input-group-append">
                  <button type="submit" class="btn btn-default">
                    <i class="fas fa-search"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive p-0">
            <div  class="d-flex justify-content-end bg-dark p-4">
              <div class="groupe-form">
                <label for="filtreType" class="form-control">Filtrer par type</label>
                <select  id="filtreType" class="form-control" wire:model.debounce='filtreType'>
                  <option value=""></option>
                  @foreach ($typearticles as $typearticle)
                    <option value="{{$typearticle->id}}">{{$typearticle->nom}}</option>
                  @endforeach
                </select>
              </div>
              <div class="groupe-form ml-2">
                <label for="filtreEtat" class="form-control">Filtrer par etat</label>
                <select  id="filtreEtat" class="form-control" wire:model.debounce='filtreEtat'>
                  <option value=""></option>
                    <option value="1">Disponible</option>
                    <option value="0">Insdisponible</option>
                </select>
              </div>
            </div>
            <div style="height: 350px;">
              <table class="table table-head-fixed text-nowrap table-striped">
                <thead>
                  <tr>
                    <th ></th>
                    <th >Article</th>
                    <th  class="text-center" >Type</th>
                    <th class="text-center" >Etat</th>
                    <th class="text-center" >Ajouté</th>
                    <th class="text-center">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ($articles as $article)
                  <tr>
                    <td>
                      <img src="{{asset('img/photo.png')}}" alt="" style="width: 60px;height:60px;">
                    </td>
                     <td>{{$article->nom }} - {{$article->noSerie}}</td>
                     <td>{{$article->type->nom}}</td>
                     <td>
                       @if($article->estDisponible)
                        <span class="badge badge-success">Disponible</span>
                        @else
                        <span class="badge badge-danger">Indisponible</span>
                        @endif
                     </td>
                     <td>{{optional($article->created_at)->diffForHumans()}}</td>
                     <td>
                      <button class="btn btn-link" wire:click='editArticle({{$article->id}})'> <i class="far fa-edit btn btn-link"> Editer</i></button>
                      <button class="btn btn-link" wire:click='comfirmDeleteArticle({{$article->id}})'> <i class="far fa-trash-alt  btn btn-link"> Supprimer</i></button>
                     </td>
                  </tr> 
                  @empty
                      <tr>
                        <td colspan="6">
                          <div class="alert alert-danger alert-dismissible">
                            <h5><i class="icon fas fa-ban"></i> Information</h5>
                           Aucun resultat pour cette recherche
                          </div>
                        </td>
                      </tr>
                  @endforelse
                    
                </tbody>
              </table>
            </div>
          </div>
          <div class="card-footer">
            <div class="float-right">
              {{$articles->links()}}
          </div>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
</div>

