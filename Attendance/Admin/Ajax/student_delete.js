$(document).on('click', '.deleteStudent', function() {
    const studentId = $(this).data('id');

    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            // Proceed with the deletion
            $.ajax({
                type: 'POST',
                url: 'controller/delete_student.php', // Specify the correct path
                data: { id: studentId },
                success: function(response) {
                    const res = JSON.parse(response);
                    if (res.status === 'success') {
                        Swal.fire(
                            'Deleted!',
                            'The student has been deleted.',
                            'success'
                        );
                        // Optionally, refresh the table or remove the row
                        $(`tr[data-id='${studentId}']`).remove();
                    } else {
                        Swal.fire(
                            'Error!',
                            res.message,
                            'error'
                        );
                    }
                },
                error: function() {
                    Swal.fire(
                        'Error!',
                        'There was an error deleting the student.',
                        'error'
                    );
                }
            });
        }
    });
});
