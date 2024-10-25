$(document).ready(function() {
    function fetchStudents(query = '') {
        $.ajax({
            url: '../sql-query/students_query.php',
            method: 'POST',
            data: { action: 'fetch', searchQuery: query },
            dataType: 'json',
            success: function(response) {
                console.log('Server Response:', response);  // Log server response to ensure it's valid JSON
                
                let output = '';
                $('#studentData').empty(); // Clear existing rows
                
                if (response.error) {
                    output = '<tr><td colspan="4">Error: ' + response.error + '</td></tr>';
                } else if (Array.isArray(response) && response.length > 0) {
                    $.each(response, function(index, student) {
                        output += `<tr data-id="${student.id}">
                            <td class="editable" data-field="names">${student.names}</td>
                            <td class="editable" data-field="position">${student.position}</td>
                            <td class="editable" data-field="status">${student.status == 'active' ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-danger">Inactive</span>'}</td>
                            <td>
                                <button class="btn btn-warning btn-sm editStudent" data-id="${student.id}">Edit</button>
                                <button class="btn btn-danger btn-sm deleteStudent" data-id="${student.id}">Delete</button>
                            </td>
                        </tr>`;
                    });
                } else {
                    output = '<tr><td colspan="4">No records found</td></tr>';
                }
                $('#studentData').html(output); // Append new data
            },            
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('AJAX Error:', textStatus, errorThrown);
            }
        });
    }

    // Call fetchStudents to load data initially
    fetchStudents(); // Ensure this is called on page load

    // Call fetchStudents after adding a student
    $('#addStudentBtn').click(function(event) {
        event.preventDefault();
        
        const name = $('#studentName').val();
        const position = $('#studentPosition').val();

        if (!name || !position) {
            alert('Please fill in all fields.');
            return;
        }
    
        $.ajax({
            url: '../controller/create_student.php',
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({ names: name, position: position }),
            success: function(res) {
                if (res.success) {
                    // Fetch the updated student list after adding a new student
                    fetchStudents();
                    $('#studentName').val('');
                    $('#studentPosition').val('');
                    $('#addStudentModal').modal('hide');
                } else {
                    alert('Failed to add student: ' + res.message);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('AJAX Error:', textStatus, errorThrown);
                console.log(jqXHR.responseText); // Log the actual response for debugging
                alert('Error occurred while fetching data.');
            }
        });
    });
});
