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

<script>
  window.addEventListener("ShowSuccesMessage",event=>{
    Swal.fire({
    position: 'top-end',
    icon: 'success',
    title: event.detail.message || "Opération éffectuée avec succès!!",
    showConfirmButton: false,
    timer: 3000
    })
 
  
})
</script>
<script>
 window.addEventListener("showConfirmMessage",event=>{

      Swal.fire({
            title: event.detail.message.title,
            text: event.detail.message.text,
            icon: event.detail.message.type,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Continuer'
            cancelButtonText: "Annuler"
          }).then((result) => {
            if (result.isConfirmed) {
              if(event.detail.message.data)
              {
                 @this.deleteUser(event.detail.message.data.user_id)
              }
                @this.resetPassword()
            }
      
            })
 })

</script>