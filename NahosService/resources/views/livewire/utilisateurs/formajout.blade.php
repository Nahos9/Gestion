
<div class="row">
  <div class="col-3"></div>
  <div class="col-6">
    <form wire:submit.prevent="addUser()" class="mt-4">
      <div class="card-header bg-primary">
        <h5><i class="fas fa-user-plus"></i> Ajout nouvel utilisateur</h5>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-6">
            <div class="form-group">
              <input type="text" class="form-control @error('newUser.nom') is-invalid @enderror"  placeholder="Enter votre nom" wire:model='newUser.nom'>
              @error('newUser.nom')
                {{$message}}
              @enderror
          </div>
          </div>
          <div class="col-6">
            <div class="form-group">  
              <input type="text" class="form-control @error('newUser.prenom') is-invalid @enderror"  placeholder="Enter votre prénom " wire:model='newUser.prenom'>
              @error('newUser.prenom')
              {{$message}}
            @enderror
          </div>
          </div>
        </div>
        <div class="form-group">
          <select name="" id="" class="form-control @error('newUser.sexe') is-invalid @enderror" wire:model='newUser.sexe'>
            <option value="">----------------</option>
            <option value="H">Homme</option>
            <option value="F">Femme</option>
          </select>
          @error('newUser.sexe')
          {{$message}}
        @enderror
        </div>   
        <div class="form-group">
          <input type="email" class="form-control @error('newUser.email') is-invalid @enderror"  placeholder="Enter votre adresse email" wire:model='newUser.email'>
          @error('newUser.email')
          {{$message}}
        @enderror
      </div>
      <div class="row">
        <div class="col-6">
          <div class="form-group">
            <input type="text" class="form-control @error('newUser.telephone1') is-invalid @enderror"  placeholder="Enter votre téléphone1" wire:model='newUser.telephone1'>
            @error('newUser.telephone1')
            {{$message}}
          @enderror
        </div>
        </div>
        <div class="col-6">
          <div class="form-group">  
            <input type="text" class="form-control "  placeholder="Enter votre téléphone2" wire:model='newUser.telephone2'>
        </div>
        </div>
      </div>
      <div class="form-group">
        <select name="" id="" class="form-control @error('newUser.pieceIdentite') is-invalid @enderror" wire:model='newUser.pieceIdentite'>
          <option value="">----------------</option>
          <option value="CNI">CNI</option>
          <option value="Passport">PASSPORT</option>
          <option value="permis">Permis de conduire</option>
        </select>
        @error('newUser.pieceIdentite')
        {{$message}}
      @enderror
      </div>  
      <div class="form-group">
        <input type="text" class="form-control @error('newUser.noPieceIdentite') is-invalid @enderror"  placeholder="Enter votre N° de piece d'identité" wire:model='newUser.noPieceIdentite'>
        @error('newUser.noPieceIdentite')
        {{$message}}
      @enderror
    </div>
        <div class="form-group">
          <input type="password" class="form-control" disabled placeholder="Password" wire:model='password'>
        </div>   
      <div class="card-footer">
        <button type="submit" class="btn btn-primary">Enregistrer</button>
        <button type="button" class="btn btn-warning" wire:click.prevent='goToUser()'>Retour à la liste des utilisateurs</button>
      </div>
    </div>
    </form>
  
  </div>
  <div class="col-3"></div>
    
</div>
<script>
  window.addEventListener("userCreatedSucces",event=>{

      // console.log(event);
      Swal.fire({
      position: 'top-end',
      icon: 'success',
      title: event.detail.message,
      showConfirmButton: false,
      timer: 3000
    })
  });
</script>