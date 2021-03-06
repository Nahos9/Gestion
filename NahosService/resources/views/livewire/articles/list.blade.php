
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
          <div class="card-body table-responsive p-0" style="width:100%">
            <div  class="d-flex justify-content-end bg-info p-4 "style="width:100%">
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
          
                      <img src="{{asset($article->imageUrl)}}" alt="" style="width: 60px;height:60px;">
                     
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
                      <a class="btn btn-link" href="{{route("admin.gestarticles.articles.tarifs",["articleId"=>$article->id])}}"> <i class="fas fa-dollar-sign  "></i>Tarif</a>
                      <button class="btn btn-link" wire:click='editArticle({{$article->id}})'> <i class="far fa-edit btn btn-link"> Edit</i></button>
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

