<div class="modal fade" id="modalProp" style="z-index: 1900;" role="dialog" wire:ignore.self>
  <div class="modal-dialog modal-xl" style="top:100px;">
    <div class="modal-content">
      <div class="modal-header bg-info">
        <h5 class="modal-title" id="exampleModalLabel">Edition des propriétés "{{optional($nameEdit)->nom}}"</h5>
      </div>
      <div class="modal-body">
            <div class="d-flex my-4 bg-gray-light p-3">
              <div class="flex-grow-1 mr-2">
                <input type="text" placeholder="Nom" wire:keypress.enter="updateProp()" wire:model="editPropModel.nom" class="form-control @error("editPropModel.nom") is-invalid @enderror">
                @error("editPropModel.nom")
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="flex-grow-1">
              <select class="form-control @error("editPropModel.estObligatoire") is-invalid @enderror" wire:model="editPropModel.estObligatoire">
                  <option value="">--Champ Obligatoire--</option>
                  <option value="1">OUI</option>
                  <option value="0">NON</option>
              </select>
              @error("editPropModel.estObligatoire")
                  <span class="text-danger">{{$message}}</span>
              @enderror
          </div>
          <div class="ml-2">
            <button class="btn btn-success" wire:click="updateProp()">Valider</button>
            </div>
        </div>

      <div>
        <table class="table table-borded">
          <thead class="bg-info">
              <tr>
                <th>Nom</th>
                <th>Est obligatoire</th>
                <th>Action</th>
              </tr>
          </thead>
          <tbody>
              <tr>
                <td>Kilometrage</td>
                <td>Oui</td>
                <td class="text-center">
                  <button class="btn btn-link" ><i class="fas fa-check"></i>Valider</button>
                  <button class="btn btn-link" ><i class="far fa-window-close btn btn-link"></i>Annuler</button>
                </td>
              </tr>
          </tbody>
        </table>
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
      </div>
    </div>
  </div>
</div>

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
                              <button class="btn btn-link" wire:click='deleteConfTypeArticle({{$typearticle->id}})'> <i class="far fa-trash-alt btn btn-link"> Supprimer</i></button>
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

<script>
  window.addEventListener("showSuccessMessage", event=>{
      Swal.fire({
              position: 'top-end',
              icon: 'success',
              toast:true,
              title: event.detail.message || "Opération effectuée avec succès!",
              showConfirmButton: false,
              timer: 4000
              }
          )
  })
</script>

<script>

  window.addEventListener("showEditForm",function(e){
  Swal.fire({
  title: "Edition d'un type d'article",
  input: 'text',
  inputValue: e.detail.typearticle,
  showCancelButton: true,
  inputValidator: (value) => {
    if (!value) {
      return 'Le champ est obligatoire!!'
    }
    @this.updateTypeArticle(e.detail.typearticle.id,value)
  }
})
  })
</script>
<script>
  window.addEventListener("showConfirmMessage", event=>{
     Swal.fire({
      title: event.detail.message.title,
      text: event.detail.message.text,
      icon: event.detail.message.type,
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Continuer',
      cancelButtonText: 'Annuler'
      }).then((result) => {
      if (result.isConfirmed) {
          if(event.detail.message.data){
              @this.deleteTypeArticle(event.detail.message.data.type_article_id)
          }
        
      }
      })
  })
</script>
<script>
  window.addEventListener("showModal",function(e){

    $("#modalProp").modal({
      "show": true,
      "backdrop":"static"
    })
  })
</script>
