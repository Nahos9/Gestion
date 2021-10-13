<div wire:ignore.self>
  @if($currentPage == PAGEEDITFORM)
  @include("livewire.utilisateurs.editForm")
  @endif
  @if($currentPage == PAGEUSERFORM)
    @include("livewire.utilisateurs.formajout")      
  @endif
  @if($currentPage == PAGELISTE)
  @include("livewire.utilisateurs.tableauUtilisateurs")
  @endif
  
</div>