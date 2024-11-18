<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Seeker Submissions</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <style>
        /* Custom styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .container {
            background-color: white;
            padding: 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            margin-top: 20px;
        }

        h1 {
            color: #343a40;
        }

        .table th, .table td {
            vertical-align: middle;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Job Seeker Submissions</h1>

        <!-- Filter Form -->
        <!-- <form id="filterForm" class="mb-3"> -->
            <div class="row">
                <div class="col-md-3">
                    <label for="experience">Max Experience (Years):</label>
                    <input type="number" id="experience" name="experience" class="form-control"  placeholder="search through experince">
                </div>
                <div class="col-md-3">
                    <button type="button" class="btn btn-primary mt-4" id="filterForm">Filter</button>
                </div>
            </div>
        <!-- </form> -->

        <!-- Job Seeker List Table -->
        <table id="jobSeekerTable" class="table table-bordered">
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Skills</th>
                    <th>Experience</th>
                    <th>Resume</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                
            </tbody>
        </table>

        <!-- Pagination Links -->
        <div id="pagination-links"></div>
    </div>

    <!-- jQuery and DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            function loadJobSeekers(experience = null, page = 1) {
                $.ajax({
                    url: '{{ route('applicantData.show') }}',  
                    method: 'GET',
                    data:{
                        experience: experience,
                        page: page
                    },
                    success: function (response) {
                        $('#jobSeekerTable tbody').empty();
                        let jobSeekers = response.data;
                        let paginationLinks = response.links;

                        jobSeekers.forEach(function (user) {
                            var row = '<tr>' +
                                '<td>' + user.first_name + '</td>' +
                                '<td>' + user.last_name + '</td>' +
                                '<td>' + user.email + '</td>' +
                                '<td>' + user.phone_number + '</td>' +
                                '<td>' + user.skills + '</td>' +
                                '<td>' + user.experience + '</td>' +
                                '<td>';

                            // Check if the resume exists and provide a download link
                            if (user.resume) {
                                row += '<a href="{{ route('hr.download', ':id') }}'.replace(':id', user.id) + '" class="btn btn-info btn-sm">Download Resume</a>';
                            } else {
                                row += 'No resume uploaded';
                            }

                            row += '</td>' +
                                '<td>' +
                                '<a href="{{ route('hr.view', ':id') }}'.replace(':id', user.id) + '" class="btn btn-primary btn-sm">View</a>' +
                                '</td>' +
                                '</tr>';

                            $('#jobSeekerTable tbody').append(row);

                        });
                        updatePagination(paginationLinks);

                    },
                    error: function (error) {
                        console.log("There was an error:", error);
                    }
                });
            }

            function updatePagination(links) {
                let paginationHtml = '';
                
                links.forEach(function(link) {
                    if (link.active) {
                        paginationHtml += '<span class="page-link active">' + link.label + '</span>';
                    } else if (link.url) {
                        paginationHtml += '<a href="#" class="page-link" data-page="' + link.url.split('page=')[1] + '">' + link.label + '</a>';
                    } else {
                        paginationHtml += '<span class="page-link disabled">' + link.label + '</span>';
                    }
                });

                $('#pagination-links').html(paginationHtml);
            }

            loadJobSeekers();

            $('#filterForm').on('click', function(event) {
                event.preventDefault();  
                const experience = $('#experience').val();  
                loadJobSeekers(experience);  
            });
            $(document).on('click', '.page-link', function(event) {
                event.preventDefault();
                const page = $(this).data('page');  
                loadJobSeekers($('#experience').val(), page); 
            });



            
        });
    </script>
</body>
</html>
