$(document).ready(function() {
    $('#showAddStudentModal').click(function() {
        $('#addStudentModal').modal('show');
    });

    $('#addStudentBtn').click(function(event) {
        event.preventDefault();
        
        const name = $('#studentName').val().trim();
        const position = $('#studentPosition').val().trim();
        const email = $('#studentEmail').val().trim(); // Assuming there's an email input field

        // Validation check for empty fields
        if (!name || !position || !email) {
            Swal.fire({
                icon: 'error',
                title: 'Invalid Input',
                text: 'Please fill in all fields.',
            });
            return;
        }

        // Prepare data object to send
        const studentData = {
            names: name,
            position: position,
            email: email
        };

        // AJAX request to add student (as JSON)
        $.ajax({
            url: 'controller/create_student.php',
            type: 'POST',
            contentType: 'application/json', // Send as JSON
            data: JSON.stringify(studentData), // Convert the data to JSON string
            success: function(res) {
                console.log('Server response:', res);  // Log the response for debugging
                
                if (res.success) {
                    // Append the new student row to the table
                    const newRow = `<tr data-id="${res.id}">
                                        <td class="editable" data-field="names">${name}</td>
                                        <td class="editable" data-field="position">${position}</td>
                                        <td class="editable" data-field="status">Active</td>
                                        <td>
                                            <button class='btn btn-light editStudent' data-id="${res.id}">Edit</button>
                                            <button class='btn btn-danger deleteStudent' data-id="${res.id}">Delete</button>
                                        </td>
                                    </tr>`;
                    
                    $('#studentData').append(newRow); // Append new student row
                    $('#studentName').val(''); // Clear the input fields
                    $('#studentPosition').val('');
                    $('#studentEmail').val('');
                    $('#addStudentModal').modal('hide'); // Hide modal

                    Swal.fire({
                        icon: 'success',
                        title: 'Student Added',
                        text: 'The student has been added successfully!',
                        showConfirmButton: false,
                        timer: 1500
                    });
                } else {
                    console.error('Error from server:', res.message); // Log error
                    Swal.fire({
                        icon: 'error',
                        title: 'Failed to Add Student',
                        text: res.message,
                    });
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('AJAX Error:', textStatus, errorThrown, jqXHR.responseText);  // Log AJAX error details
                Swal.fire({
                    icon: 'error',
                    title: 'Error Occurred',
                    text: 'An error occurred while adding the student. Please try again.',
                });
            }
        });
    });
});
