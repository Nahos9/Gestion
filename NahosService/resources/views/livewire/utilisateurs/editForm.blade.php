
<div class="row">
    <div class="col-3"></div>
    <div class="col-6">
      <form wire:submit.prevent="updateUser" class="mt-4">
        <div class="card-header bg-primary">
          <h5><i class="fas fa-user-plus"></i> Modifier les infromations de l'utilisateur</h5>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-6">
              <div class="form-group">
                <input type="text" class="form-control @error('editUser.nom') is-invalid @enderror"  placeholder="Enter votre nom" wire:model='editUser.nom'>
                @error('editUser.nom')
                  {{$message}}
                @enderror
            </div>
            </div>
            <div class="col-6">
              <div class="form-group">  
                <input type="text" class="form-control @error('editUser.prenom') is-invalid @enderror"  placeholder="Enter votre prénom " wire:model='editUser.prenom'>
                @error('editUser.prenom')
                {{$message}}
              @enderror
            </div>
            </div>
          </div>
          <div class="form-group">
            <select name="" id="" class="form-control @error('editUser.sexe') is-invalid @enderror" wire:model='editUser.sexe'>
              <option value="">----------------</option>
              <option value="1">Homme</option>
              <option value="2">Femme</option>
            </select>
            @error('editUser.sexe')
            {{$message}}
          @enderror
          </div>   
          <div class="form-group">
            <input type="email" class="form-control @error('editUser.email') is-invalid @enderror"  placeholder="Enter votre adresse email" wire:model='editUser.email'>
            @error('editUser.email')
            {{$message}}
          @enderror
        </div>
        <div class="row">
          <div class="col-6">
            <div class="form-group">
              <input type="text" class="form-control @error('editUser.telephone1') is-invalid @enderror"  placeholder="Enter votre téléphone1" wire:model='editUser.telephone1'>
              @error('editUser.telephone1')
              {{$message}}
            @enderror
          </div>
          </div>
          <div class="col-6">
            <div class="form-group">  
              <input type="text" class="form-control "  placeholder="Enter votre téléphone2" wire:model='editUser.telephone2'>
          </div>
          </div>
        </div>
        <div class="form-group">
          <select name="" id="" class="form-control @error('editUser.pieceIdentite') is-invalid @enderror" wire:model='editUser.pieceIdentite'>
            <option value="">----------------</option>
            <option value="CNI">CNI</option>
            <option value="Passport">PASSPORT</option>
            <option value="permis">Permis de conduire</option>
          </select>
          @error('editUser.pieceIdentite')
          {{$message}}
        @enderror
        </div>  
        <div class="form-group">
          <input type="text" class="form-control @error('editUser.noPieceIdentite') is-invalid @enderror"  placeholder="Enter votre N° de piece d'identité" wire:model='editUser.noPieceIdentite'>
          @error('editUser.noPieceIdentite')
          {{$message}}
        @enderror
      </div> 
        <div class="card-footer">
          <button type="submit" class="btn btn-primary">Modifier</button>
          <button type="button" class="btn btn-danger" wire:click.prevent='goToUser()'>Retour à la liste des utilisateurs</button>
        </div>
      </div>
      </form>
    
    </div>
    <div class="col-3"></div>
      
  </div>
  <script>
    window.addEventListener("editSuccesMessage",event=>{
  
        // console.log(event);
        Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: event.detail.message,
        showConfirmButton: false,
        timer: 4000
      })
    });
  </script>