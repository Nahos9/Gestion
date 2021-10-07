<div class="card card-primary mt-4">
    <div class="card-header">
      <h3 class="card-title"><i class="fas fa-user-plus fa-2x"></i> Formulaire d'ajout</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form>
      <div class="card-body">
      <div class="row">
          <div class="col-6">
            <div class="form-group">
                <input type="text" class="form-control" name="nom" placeholder="Votre nom">
              </div>
          </div>
          <div class="col-6">
            <div class="form-group">
                <input type="text" class="form-control" name="prenom" placeholder="Votre prénom">
              </div>
          </div>
      </div>
        <div class="form-group" >
          <select name="sexe" id="" class="form-control">
              <option  value="">___________________</option>
              <option value="H">Home</option>
              <option value="F">Femme</option>
          </select>
        </div>
          <div class="row">
            <div class="col-6">
              <div class="form-group">
                  <input type="text" class="form-control" name="telephone1" placeholder="Votre numéro de téléphone1">
                </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                  <input type="text" class="form-control" name="telephone2" placeholder="Votre numéro de téléphone2">
                </div>
            </div>
        </div>
        <div class="form-group" >
            <select name="pieceIdentite" id="" class="form-control">
                <option  value="">___________________</option>
                <option value="CNI">CNI</option>
                <option value="Passport">PASSPORT</option>
                <option value="Permis">PERMIS DE CONDUIRE</option>
            </select>
          </div>
         <div class="form-group">
                <input type="text" class="form-control" name="noPiece" placeholder="Votre numéro de pièce d'identité">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="password" disabled value="Password">
        </div>
      </div>
      <!-- /.card-body -->

      <div class="card-footer">
        <button type="button" class="btn btn-primary">Enregister</button>
        <button type="button" class="btn btn-warning" wire:click="goToUser">Retour à liste des utilisateurs</button>
      </div>
    </form>
  </div>