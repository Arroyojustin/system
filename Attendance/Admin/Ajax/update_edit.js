$(document).on('click', '.editStudent', function() {
    let row = $(this).closest('tr');
    let studentId = $(this).data('id');
    let isEditing = row.data('editing');

    if (!isEditing) {
        // Enter edit mode
        row.find('.editable').each(function() {
            let field = $(this).data('field');
            let value = $(this).text().trim();
            
            if (field === 'status') {
                let options = `
                    <select class="form-select">
                        <option value="active" ${value === 'Active' ? 'selected' : ''}>Active</option>
                        <option value="inactive" ${value === 'Inactive' ? 'selected' : ''}>Inactive</option>
                    </select>`;
                $(this).html(options);
            } else {
                $(this).html(`<input type="text" class="form-control" name="${field}" value="${value}">`);
            }
        });
        $(this).text('Save').removeClass('btn-warning').addClass('btn-success');
        row.data('editing', true);
    } else {
        // Exit edit mode and collect updated data
        let updatedData = {
            names: '',
            position: '',
            status: ''
        };
        
        row.find('.editable').each(function() {
            let field = $(this).data('field');
            let value;
            
            if (field === 'status') {
                value = $(this).find('select').val();
                updatedData.status = value;
            } else {
                value = $(this).find('input').val();
                updatedData[field] = value;  // Update based on field name ('names' or 'position')
            }
            $(this).html(value.charAt(0).toUpperCase() + value.slice(1));
        });

        // Log the updated data for debugging purposes
        console.log('Updated Data:', updatedData);

        // Send AJAX request to update the student data
        $.ajax({
            url: '../sql-query/update_querty.php',
            method: 'POST',
            data: {
                id: studentId,
                names: updatedData.names,
                position: updatedData.position,
                status: updatedData.status
            },
            success: function(response) {
                console.log('AJAX Response:', response); // Log the response
                let res = JSON.parse(response);
                
                if (res.success) {
                    // Show Sweet Alert
                    Swal.fire({
                        icon: 'success',
                        title: 'Saved!',
                        text: 'Student updated successfully.',
                    });

                    // Update the row data-id to match the updated student ID
                    row.data('id', studentId);
                    
                    // Re-enable the clickable row functionality
                    row.off('click').on('click', function() {
                        const clickedId = $(this).data('id');
                        loadStudentInfo(clickedId);
                    });
                } else {
                    alert('Error updating student: ' + res.error);
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', xhr.responseText); // Log the actual response text
                alert('An error occurred while updating student.');
            }
        });
        
        $(this).text('Edit').removeClass('btn-success').addClass('btn-warning');
        row.data('editing', false);
    }
});
