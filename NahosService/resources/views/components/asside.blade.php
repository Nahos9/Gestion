<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="card-body box-profile">
        <div class="text-center">
          <img class="profile-user-img img-fluid img-circle mb-3" src="{{asset('img/user.png')}}" alt="Photo de profil de l'utilisateur" >
        </div>
        <h3 class="text-center profil-username ellipsis mb-3">{{fullName()}}</h3>
        <p class="text-center">{{ getRolesName()}}</p>
        <ul class="list-group bg-dark mb-3">
          <li class="list-group-item">
          <a href="#" class="d-flex align-items-center mb-3 "><i class="fa fa-lock pr-2"></i><b >Mot de passe</b> </a>
          </li>
          <li class="list-group-item">
          <a href="#" class="d-flex align-items-center mb-3"><i class="fa fa-user pr-2"></i><b >Mon profile</b> </a>
          </li>
      </ul>

      <a class="btn btn-primary btn-block" href="{{ route('logout') }}"
      onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();">
      Déconnexion
  </a>

  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
      @csrf
  </form>
      </div>
  </aside>