<?php

namespace App\Http\Controllers;

use App\Models\JobSeeker;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use RealRashid\SweetAlert\Facades\Alert;

class jobApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('jobApplication.show');

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('jobApplication.index');
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first-name' => 'required',
            'last-name' => 'required',
            'email' => 'required|email',
            'phone-number' => 'required',
            'resume' => 'required|file|mimes:pdf,doc,docx|max:2048',
            'skills' => 'required',
            'street-address' => 'required|string|max:255',
            'street-address-line2' => 'nullable|string|max:255',
            'postal-code' => 'required|string|max:20',
            'training_certifications' => 'required',
            'referredBy' => 'required',
            'experience' => 'required',

        ]);

        $address = $request->input('street-address') . ', ' .
        $request->input('street-address-line2') . ', ' .
        $request->input('postal-code');

        $dob = null;
        if ($request->filled(['birth-year', 'birth-month', 'birth-day'])) {
            $dob = Carbon::createFromDate(
                $request->input('birth_year'),
                $request->input('birth_month'),
                $request->input('birth_day')
            );
        }
        $jobSeeker = JobSeeker::create([
            'first_name' => $validated['first-name'],
            'last_name' => $validated['last-name'],
            'email' => $validated['email'],
            'phone_number' => $validated['phone-number'],
            'skills' => $validated['skills'],
            'address' => $address,
            'dob' => $dob,
            'training_certifications' => $validated['training_certifications'],
            'referredBy' => $validated['referredBy'],
            'experience' => $validated['experience'],

        ]);

        if ($request->hasFile('resume')) {
            $resumePath = $request->file('resume')->store('resumes', 'public');

            $jobSeeker->resume()->create([
                'file_path' => $resumePath,
            ]);
        }
        Alert::success('Application Sent Successfully!');
        return redirect()->route('career-form.create');
    }

    /**
     * Display the specified resource.
     */
    // In JobApplicationController.php

    public function show(Request $request)
    {
        if ($request->ajax()) {
            $query = JobSeeker::with('resume')->orderBy('created_at', 'desc');

            if ($request->has('experience') && $request->experience) {
                $query->where('experience', '<=', $request->experience);
            }
            $jobSeekers = $query->paginate(25);

            return response()->json($jobSeekers);
        }
    }

    public function downloadResume($jobSeekerId)
    {
        // $jobSeeker = JobSeeker::findOrFail($jobSeekerId);
        $jobSeeker = JobSeeker::with('resume')->findOrFail($jobSeekerId);
        $resume = $jobSeeker->resume;

        // Check if resume exists
        if ($resume && file_exists(storage_path('app/public/' . $resume->file_path))) {
            return response()->download(storage_path('app/public/' . $resume->file_path, 'resume'));
        } else {
            return redirect()->back()->with('error', 'Resume not found.');
        }
    }

    public function viewProfile($jobSeekerId)
    {
        $jobSeeker = JobSeeker::findOrFail($jobSeekerId);
        return view('jobApplication.profile', compact('jobSeeker'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function getJobSeekers(Request $request)
    {
        $experience = $request->experience ?? null;

        $jobSeekers = DB::select('CALL GetJobSeekers(?)', [$experience]);

        return response()->json($jobSeekers);
    }
}
