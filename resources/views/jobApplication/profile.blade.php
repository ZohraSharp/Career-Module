<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Seeker Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }
        .container {
            max-width: 960px;
            margin-top: 50px;
        }
        .card {
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h4 {
            margin-bottom: 20px;
        }
        ul {
            list-style-type: none;
            padding-left: 0;
        }
        ul li {
            margin-bottom: 10px;
        }
        .download-resume-btn {
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="card">
        <div class="card-header">
            <h4>{{ $jobSeeker->first_name }} {{ $jobSeeker->last_name }}'s Profile</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5>Contact Information</h5>
                    <ul>
                        <li><strong>Email:</strong> {{ $jobSeeker->email }}</li>
                        <li><strong>Phone:</strong> {{ $jobSeeker->phone_number }}</li>
                        <li><strong>Date of Birth:</strong> {{ \Carbon\Carbon::parse($jobSeeker->dob)->format('d M, Y') }}</li>
                    </ul>

                    <h5>Address</h5>
                    <p>{{ $jobSeeker->address }}</p>
                </div>

                <div class="col-md-6">
                    <h5>Skills</h5>
                    <p>{{ $jobSeeker->skills }}</p>

                    <h5>Experience</h5>
                    <p>{{ $jobSeeker->experience }} years</p>
                </div>
            </div>

            <h5>Resume</h5>
            @if($jobSeeker->resume)
                <a href="{{ asset('storage/' . $jobSeeker->resume->file_path) }}" class="btn btn-info btn-sm download-resume-btn" target="_blank">Download Resume</a>
            @else
                <p>No resume uploaded.</p>
            @endif
        </div>
    </div>

    <div class="mt-4">
        <a href="{{ route('applicantData.index') }}" class="btn btn-secondary">Back to Job Seekers List</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
