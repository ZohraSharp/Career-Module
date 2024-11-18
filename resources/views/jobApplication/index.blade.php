<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employment Application Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    

    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-PxVuJ49XxYcP3wpKFIqlVCTEXw2dr7g51EQ1KpOq74pLJGZwbNLnA5zzOAZu5ncK" crossorigin="anonymous"> -->
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }
        .card {
            margin-top: 50px;
            border: 1px solid #ddd;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color: #007bff;
            color: white;
            font-size: 1.25rem;
            font-weight: bold;
        }
        .form-label {
            font-weight: bold;
        }
        .form-check-label {
            margin-left: 10px;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .section-title {
            margin-top: 20px;
            margin-bottom: 10px;
            font-size: 1.2rem;
            color: #007bff;
            font-weight: bold;
            border-bottom: 2px solid #007bff;
            padding-bottom: 5px;
        }

        .container{
        padding: 15px;
        }
        SELECT{
        padding: 5px;
        }
        input.date{
        width:50px;
        padding: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center">
                        Employment Application Form
                    </div>
                    <div class="card-body">
                        <p class="text-muted text-center">Please fill out the form below accurately to indicate your suitability for the position.</p>
                        @include('sweetalert::alert')
                        <!-- @if (session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                        @endif -->
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                        <!-- Personal Information -->
                        <div class="section-title">Personal Information</div>
                        <form action="{{route('career.store')}}" method=post enctype="multipart/form-data">
                        @csrf
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="first-name" class="form-label">First Name:</label>
                                    <input type="text" class="form-control" id="first-name" name="first-name" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="last-name" class="form-label">Last Name:</label>
                                    <input type="text" class="form-control" id="last-name" name="last-name" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="birth-month" class="form-label">Birth Month:</label>
                                    <SELECT id ="month" name = "birth-month" onchange="change_month(this)"></select>
                                </div>
                                <div class="col-md-4">
                                    <label for="birth-day" class="form-label">Birth Day:</label>
                                    <SELECT  id ="day" name = "birth-day"></SELECT>
                                </div>
                                <div class="col-md-4">
                                    <label for="birth-year" class="form-label">Birth Year:</label>
                                    <SELECT id ="year" name = "birth-year" onchange="change_month(this)"></SELECT>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="phone-number" class="form-label">Phone Number:</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="phone-area-code" name="phone-area-code" placeholder="Area Code" required>
                                        <input type="text" class="form-control" id="phone-number" name="phone-number" placeholder="Phone Number" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="form-label">E-mail Address:</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="example@example.com" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="address" class="form-label">Address:</label>
                                <input type="text" class="form-control" id="street-address" name="street-address" placeholder="Street Address" required>
                                <input type="text" class="form-control mt-2" id="street-address-line2" name="street-address-line2" placeholder="Apartment, suite, etc. (optional)">
                            </div>

                            <div class="mb-3">
                                <label for="postal-code" class="form-label">Postal/Zip Code:</label>
                                <input type="text" class="form-control" id="postal-code" name="postal-code">
                            </div>

                            <!-- Job Skills & Training -->
                            <div class="section-title">Job Skills & Training</div>
                            <div class="mb-3">
                                <label for="skills" class="form-label">Describe your skills:</label>
                                <textarea class="form-control" id="skills" name="skills" rows="3"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="training" class="form-label">Training or Certifications:</label>
                                <textarea class="form-control" id="training" name="training_certifications" rows="3"></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="referral" class="form-label">How were you referred to us?</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="walk-in" value="walk-in" name="referredBy">
                                    <label class="form-check-label" for="walk-in">Walk-in</label>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="resume" class="form-label">Add Experience:</label>
                                <input type="number" class="form-control" id="exp" name="experience" placeholder="experience in years" required>
                            </div>

                            <!-- Resume Upload -->
                            <div class="mb-3">
                                <label for="resume" class="form-label">Upload Resume:</label>
                                <input type="file" class="form-control" id="resume" name="resume" required>
                            </div>

                            <!-- Submit Button -->
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary px-5">Submit Application</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2M1Qp3ZHi2IHvcPHCZAR1pTTaQgFMo5CAcUtKR0YlIbEz/e2kF2uB8kSI65" crossorigin="anonymous"></script>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script>
var Days = [31,28,31,30,31,30,31,31,30,31,30,31];// index => month [0-11]
$(document).ready(function(){
    var option = '<option value="day">day</option>';
    var selectedDay="day";
    for (var i=1;i <= Days[0];i++){ //add option days
        option += '<option value="'+ i + '">' + i + '</option>';
    }
    $('#day').append(option);
    $('#day').val(selectedDay);

    var option = '<option value="month">month</option>';
    var selectedMon ="month";
    for (var i=1;i <= 12;i++){
        option += '<option value="'+ i + '">' + i + '</option>';
    }
    $('#month').append(option);
    $('#month').val(selectedMon);

    var option = '<option value="month">month</option>';
    var selectedMon ="month";
    for (var i=1;i <= 12;i++){
        option += '<option value="'+ i + '">' + i + '</option>';
    }
    $('#month2').append(option);
    $('#month2').val(selectedMon);
  
    var d = new Date();
    var option = '<option value="year">year</option>';
    selectedYear ="year";
    for (var i=1930;i <= d.getFullYear();i++){// years start i
        option += '<option value="'+ i + '">' + i + '</option>';
    }
    $('#year').append(option);
    $('#year').val(selectedYear);
});
function isLeapYear(year) {
    year = parseInt(year);
    if (year % 4 != 0) {
	      return false;
	  } else if (year % 400 == 0) {
	      return true;
	  } else if (year % 100 == 0) {
	      return false;
	  } else {
	      return true;
	  }
}

function change_year(select)
{
    if( isLeapYear( $(select).val() ) )
	  {
		    Days[1] = 29;
		    
    }
    else {
        Days[1] = 28;
    }
    if( $("#month").val() == 2)
		    {
			       var day = $('#day');
			       var val = $(day).val();
			       $(day).empty();
			       var option = '<option value="day">day</option>';
			       for (var i=1;i <= Days[1];i++){ //add option days
				         option += '<option value="'+ i + '">' + i + '</option>';
             }
			       $(day).append(option);
			       if( val > Days[ month ] )
			       {
				          val = 1;
			       }
			       $(day).val(val);
		     }
  }

function change_month(select) {
    var day = $('#day');
    var val = $(day).val();
    $(day).empty();
    var option = '<option value="day">day</option>';
    var month = parseInt( $(select).val() ) - 1;
    for (var i=1;i <= Days[ month ];i++){ //add option days
        option += '<option value="'+ i + '">' + i + '</option>';
    }
    $(day).append(option);
    if( val > Days[ month ] )
    {
        val = 1;
    }
    $(day).val(val);
}
</script>
</html>
