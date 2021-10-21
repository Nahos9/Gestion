<div>
    <div class="col-12 ">
        <div class="card p-4 mt-4 ">
          <div class="card-header bg-primary d-flex align-items-center">
            <h3 class="card-title flex-grow-1"><i class="fas fa-users fa-2x"></i> Liste des types articles</h3>
    
            <div class="card-tools d-flex align-items-center">
                <a href="" class="btn btn-link text-white mr-4 d-block"><i class="fas fa-user-plus"></i>Nouvau type d'article</a>
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
                @foreach ($typearticles as $typearticle)
                        <tr>
                            <td >{{$typearticle->nom}}</td>
                            <td class="text-center">{{$typearticle->created_at}}</td>
                            <td class="text-center">
                              <button class="btn btn-link" ><i class="far fa-edit btn btn-link"></i></button>
                              <button class="btn btn-link" ><i class="far fa-trash-alt btn btn-link"></i></button>
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