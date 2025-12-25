{{-- Global Delete Confirmation Script --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle all delete forms with SweetAlert
    document.querySelectorAll('form[method="POST"]').forEach(function(form) {
        const deleteButton = form.querySelector('button[type="submit"].btn-danger');
        if (deleteButton && form.querySelector('input[name="_method"][value="DELETE"]')) {
            deleteButton.addEventListener('click', function(e) {
                e.preventDefault();
                
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
            
            // Remove old onclick attribute
            deleteButton.removeAttribute('onclick');
        }
    });
});
</script>
