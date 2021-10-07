<div class="card card-primary mt-4">
    <div class="card-header">
      <h3 class="card-title"><i class="fas fa-user-plus fa-2x"></i> Formulaire d'ajout</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form method="POST" wire:submit.prevent='addUser()'>
      <div class="card-body">
      <div class="row">
          <div class="col-6">
            <div class="form-group">
                <input type="text" class="form-control @error("userAdd.nom") is-invalid @enderror"  placeholder="Votre nom" wire:model='userAdd".nom'>
                @error("userAdd.nom")
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
          </div>
          <div class="col-6">
            <div class="form-group">
                <input type="text" class="form-control @error("userAdd.prenom") is-invalid @enderror"  placeholder="Votre prénom" wire:model='userAdd.prenom'>
                @error("userAdd.prenom")
                <span class="text-danger">{{$message}}</span>
            @enderror
              </div>
          </div>
      </div>
        <div class="form-group" >
          <select  id="" class="form-control" wire:model='userAdd.sexe'>
              <option  value="">___________________</option>
              <option value="H">Home</option>
              <option value="F">Femme</option>
          </select>
        </div>
          <div class="row">
            <div class="col-6">
              <div class="form-group">
                  <input type="text" class="form-control"  placeholder="Votre numéro de téléphone1" wire:model='userAdd.telephone1'>
                </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                  <input type="text" class="form-control"  placeholder="Votre numéro de téléphone2" wire:model='userAdd.telephone2'>
                </div>
            </div>
        </div>
        <div class="form-group" >
            <select  id="" class="form-control" wire:model='userAdd.pieceIdentite'>
                <option  value="">___________________</option>
                <option value="CNI">CNI</option>
                <option value="Passport">PASSPORT</option>
                <option value="Permis">PERMIS DE CONDUIRE</option>
            </select>
          </div>
         <div class="form-group">
                <input type="text" class="form-control"  placeholder="Votre numéro de pièce d'identité" wire:model='userAdd.noPieceIdentite'>
        </div>
        <div class="form-group">
            <input type="email" class="form-control"  placeholder="Votre email" wire:model='userAdd.email'>
    </div>
        <div class="form-group">
            <input type="text" class="form-control"  disabled value="Password">
        </div>
      </div>
      <!-- /.card-body -->

      <div class="card-footer">
        <button type="submit" class="btn btn-primary">Enregister</button>
        <button type="button" class="btn btn-warning" wire:click="goToUser">Retour à liste des utilisateurs</button>
      </div>
    </form>
  </div>