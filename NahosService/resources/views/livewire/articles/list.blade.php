<div>
    <div class="col-12 ">
        <div class="card p-4 mt-4 ">
          <div class="card-header bg-primary d-flex align-items-center">
            <h3 class="card-title flex-grow-1"><i class="fa fa-list fa-2x"></i> Liste des  articles</h3>
    
            <div class="card-tools d-flex align-items-center">
                <a href="" class="btn btn-link text-white mr-4 d-block" ><i class="fas fa-user-plus"></i>Ajouté un article</a>
              <div class="input-group input-group-md " style="width: 250px;">
                <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
    
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
                  <th ></th>
                  <th >Article</th>
                  <th  class="text-center" >Type</th>
                  <th class="text-center" >Etat</th>
                  <th class="text-center" >Ajouté</th>
                  <th class="text-center">Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($articles as $article)
                <tr>
                   <td>{{$article->nom }}</td>
                   <td>{{$article->typeArticle->id}}</td>
                   <td>
                     @if($article->estDisponible)
                      <span class="badge badge-succes"></span>
                      @else
                      <span class="badge badge-danger"></span>
                      @endif
                   </td>
                   <td>{{optional($article->created_at)->diffForHumans()}}</td>
                   <td>
                    <button class="btn btn-link" wire:click='editArticle({{$article->id}})'> <i class="far fa-edit btn btn-link"> Editer</i></button>
                    <button class="btn btn-link" wire:click='editArticle({{$article->id}})'> <i class="far fa-edit btn btn-link"> Supprimer</i></button>
                   </td>
                </tr> 
                @endforeach
                  
              </tbody>
            </table>
          </div>
          <div class="card-footer">
            <div class="float-right">

          </div>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
</div>

