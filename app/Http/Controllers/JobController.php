<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Category;
use App\Job;
use App\JobUser;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function Index()
    {
        $jobs = Job::all();
//        $jobs = DB::table('jobs')
//            ->join('categories', 'categories.id', '=', 'jobs.caregory_id')
//            ->select('jobs.*', 'categories.categoryName')
//            ->get();
        $arr = Array('jobs' => $jobs);

        return view('Job.Index', $arr);
    }

    // GET: Categories/Create
    public function Create(Request $request)
    {
        if ($request->isMethod('GET')) {
            $caregories = Category::all();
            $arr = Array('caregories' => $caregories);
            return view('Job.Create', $arr);
        } else {
            $request->validate([
                'jobTitle' => 'required|max:255',
                'jobContent' => 'required|max:255',
                'caregoryId' => 'required',
                'jobImage' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',

            ]);
            $job = new Job();
            $job->jobTitle = $request->input('jobTitle');
            $job->jobContent = $request->input('jobContent');
            $job->caregory_Id = $request->input('caregoryId');
            if ($request->hasFile('jobImage')) {
                $tempPath = $request->file('jobImage')->getRealPath();
                $extension = $request->file('jobImage')->getClientOriginalExtension();
                $hashFile = md5_file($tempPath);
                $fullName = $hashFile . "." . $extension;
                if (!Storage::exists('public/' . $fullName)) {
                    $request->file('jobImage')->storeAs('public', $fullName);
                }
                $job->jobImage = $fullName;
            }
            $job->save();
            return redirect()->route('Job.Index')->with('success', 'You have successfully add new job.');
        }
    }

    public function Delete($id)
    {
        $job = Job::find($id);
        if (!is_null($job)) {
            $job->delete();
        }
        return redirect()->route('Job.Index')->with('success', 'You have successfully delete job.');
    }

    public function Edit(Request $request, $id)
    {
        $job = Job::find($id);
        if (!is_null($job)) {
            if ($request->isMethod("GET")) {
                $caregories = Category::all();
                $arr = Array('Job' => $job, 'caregories' => $caregories);
                return view('Job.Edit', $arr);
            } else {
                $request->validate([
                    'jobTitle' => 'required|max:255',
                    'jobContent' => 'required|max:255',
                    'caregoryId' => 'required',
                    'jobImage' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',

                ]);
                $job->jobTitle = $request->input('jobTitle');
                $job->jobContent = $request->input('jobContent');
                $job->caregory_id = $request->input('caregoryId');
                if ($request->hasFile('jobImage')) {
                    $tempPath = $request->file('jobImage')->getRealPath();
                    $extension = $request->file('jobImage')->getClientOriginalExtension();
                    $hashFile = md5_file($tempPath);
                    $fullName = $hashFile . "." . $extension;
                    if (!Storage::exists('public/' . $fullName)) {
                        $request->file('jobImage')->storeAs('public', $fullName);
                    }
                    $job->jobImage = $fullName;
                }
                $job->save();
                return redirect()->route('Job.Index')->with('success', 'You have successfully edit job.');

            }
        }
    }

    public function Details($id)
    {
        $job = Job::find($id);
//        $job = DB::table('jobs')
//            ->join('categories', 'categories.id', '=', 'jobs.caregory_id')
//            ->select('jobs.*', 'categories.categoryName')
//            ->where('jobs.id','=',$id)
//            ->get()->first();
        if (!is_null($job)) {
            $arr = Array('Job' => $job);
            return view('Job.Details', $arr);
        } else {

            return redirect()->route('Job.Index');
        }
    }

    public function ApplyJob(Request $request, $id)
    {
        $job = Job::find($id);
        if (!is_null($job)) {
            if ($request->isMethod("GET")) {
                $arr = Array('Job' => $job);
                return view('Job.ApplyJob', $arr);
            } else {
                $sql = $job->users()->wherePivot('job_id', '=', $job->id)->wherePivot('user_id', '=', Auth::id());
                $query = str_replace(array('?'), array('\'%s\''), $sql->toSql());
                $query = vsprintf($query, $sql->getBindings());
//                dump($query);

                $result = $sql->get()->count();
                if ($result == 1) {
                    return redirect()->route('Job.Index')->with('success', 'You apply already for job.');
                }
                $request->validate([
                    'message' => 'required|max:255',
                ]);
                $message = $request->input('message');
                $job->users()->syncWithoutDetaching([Auth::id(), ['message' => $message]]);
                return redirect()->route('Job.Index')->with('success', 'You apply successfully for job.');

//                $JobUser = new JobUser();
//                $JobUser->

            }
        } else {
            return redirect()->route('Job.Index')->with('success', 'You have successfully edit job.');
        }
    }

    public function ApplyJobByUser()
    {

        $jobs = Auth::user()->jobs()->select('jobTitle', 'message', 'job_user.created_at', 'job_user.job_id as jobId')->get();
//        $query = str_replace(array('?'), array('\'%s\''), $jobs->toSql());
//        $query = vsprintf($query, $jobs->getBindings());

        $arr = Array('jobs' => $jobs);
        return view('Job.ApplyJobByUser', $arr);

    }

    public function DeleteApplyJob($id)
    {
        $result = Auth::user()->jobs()->detach($id);
        if ($result = 1) {
            return redirect()->route('Job.ApplyJobByUser')->with('success', 'You have successfully delete job.');

        } else {
            return redirect()->route('Job.ApplyJobByUser')->with('success', 'You have not delete job.');
        }
    }

    public function EditApplyJob(Request $request, $id)
    {
        $job = Auth::user()->jobs()->wherePivot('job_id', '=', $id);
        if ($request->isMethod("GET")) {
            $job = $job->select('jobTitle', 'message', 'job_user.job_id as jobId')->get();
            $arr = Array('job' => $job->first());
            return view('Job.EditApplyJob', $arr);
        } else {
            $request->validate([
                'message' => 'required|max:255',
            ]);
            $message = $request->input('message');
            $job->syncWithoutDetaching([$id, ['message' => $message]]);
            return redirect()->route('Job.ApplyJobByUser')->with('success', 'You have successfully edit job.');
        }

    }
}
