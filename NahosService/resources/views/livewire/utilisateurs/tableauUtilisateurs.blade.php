<div class="col-12 ">
    <div class="card p-4 mt-4 ">
      <div class="card-header bg-primary d-flex align-items-center">
        <h3 class="card-title flex-grow-1"><i class="fas fa-users fa-2x"></i> Liste des utilisateurs</h3>

        <div class="card-tools d-flex align-items-center">
            <a href="" class="btn btn-link text-white mr-4 d-block" wire:click.prevent="goToAddUser"><i class="fas fa-user-plus"></i>Nouvel utilisateur</a>
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
              <th style="width: 5%;"></th>
              <th style="width: 25%;">utilisateurs</th>
              <th class="text-center" style="width: 20%;">Roles</th>
              <th class="text-center" style="width: 20%;">Ajouté</th>
              <th class="text-center" style="width: 30%">Actions</th>
            </tr>
          </thead>
          <tbody>
              @foreach($users as $user)
            <tr>
              <td>
                  @if ($user->sexe == 1)
                      <img src="{{asset('img/man.png')}}" alt="" style="width: 24px;">
                 @else

                 <img src="{{asset('img/woman.png')}}" alt="" style="width: 24px;">
                  @endif
                  
                </td>
              <td>{{$user->prenom}} {{$user->nom}}</td>
              <td class="text-center">{{$user->allRoleNames}}</td>
              <td class="text-center"><span class="tag tag-success">{{$user->created_at->diffForHumans()}}</span></td>
              <td class="text-center">
                <button class="btn btn-link" wire:click="goToEdit({{$user->id}})" ><i class="far fa-edit btn btn-link"></i></button>
                <button class="btn btn-link" wire:click="confirmDelete('{{$user->prenom}} {{$user->nom}}',{{$user->id}})"><i class="far fa-trash-alt btn btn-link"></i></button>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="card-footer">
            <div class="float-right">
                {{$users->links()}}
            </div>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <script>
      window.addEventListener("confirmDelete",event=>{

        Swal.fire({
              title: event.detail.message.title,
              text: event.detail.message.text,
              icon: event.detail.message.type,
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Continuer'
            }).then((result) => {
              if (result.isConfirmed) {

                @this.deleteUser(event.detail.message.data.user_id)
              }
              
      })
      window.addEventListener("userDeletedSucces",event=>{

// console.log(event);
        Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: event.detail.message,
        showConfirmButton: false,
        timer: 3000
        })
});
      
  });
  </script>

 