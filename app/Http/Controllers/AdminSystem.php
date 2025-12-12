<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use  Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Course;
use App\Models\Student;
use App\Models\Enrollment;
class AdminSystem extends Controller
{

    public function admin_profile_one():View
    {
        return view("admin.admin_profile"); #admin_profile.blade.php
    }
     public function admin_profile():View
    {
        return view("admin.admindasbord"); #admin.blade.php
    }

            public function admin_edit($id)
        {
            $user = User::findOrFail($id);
            return view('admin.admin_edit', compact('user'));
        }


        public function admin_update(Request $request, $id)
        {
            $request->validate([
                'name'  => 'required|string|max:255',
                'email' => 'required|email'
            ]);

            $user = User::findOrFail($id);

            $user->name  = $request->name;
            $user->email = $request->email;
            $user->save();

            return redirect()->route('admin.profile', $id)->with('message', 'Admin updated successfully!');
        }

        public function admin_delete($id)
        {
            $user = User::findOrFail($id);
            $user->delete();

            return redirect('/login')->with('message', 'Admin deleted successfully!');
        }


        // Admin handel this user
          public function user_show($admin_id)
      {                  
                  
            //   $allinfo=User::where('role',0)->get();
            $allinfo=User::where('id','!=',$admin_id)->get();
              $courses = Course::all();
              return view('admin.user_info')->with(['data'=>$allinfo]);
            // return view('admin.user_info', ['users' => $allinfo, 'courses' => $courses]); 


      }

      //Admin Block Unblock code 
        public function block_user($id)
    {
        $user = User::findOrFail($id);
        $user->role = 1;  // OR whatever value means 'blocked'
        $user->save();
        // dd($user);
        return redirect()->back()->with('message', 'User blocked Successfully!');
    }

    //unblock
    public function unblock_user($id)
{
    $user = User::findOrFail($id);
    $user->role = 0; // OR your normal user role
    $user->save();

    return redirect()->back()->with('message', 'User unblocked Successfully!');
}


      // check user is student or not
           public function check_enroll($id)
      {                  
                  
        $student=Student::where('user_id',$id)->first();
            if(!$student)
            {
              return redirect("/student/".$id)->with('message', 'Please complete your student profile first!');
            }
        
            // $exist=Enrollment::where('student_id',$student->id)->exists();

            // if($exist)
            // {
            //     return back()->with('message', 'The user is already enrolled!');
            // }

            else{
              return redirect('/course_list/'.$id);
            }

      }




     public function enrollment_form($id):View
    {
         $student = Student::findOrFail($id);
         $courses = Course::all();
         return view("admin.senrollment", compact('student','courses'));#senrollment.blade.php
    }
    
    // enrollment
     public function enrollment_data($id)
    {
          $student = Student::findOrFail($id);

            $courses = Course::all();

            return view("admin.senrollment", compact('student', 'courses'));
        
    }


   

        public function enrollment_insert(Request $req)
    {
        $student_id = $req->student_id;
        $course_id  = $req->course_id;

        // Validate form values
        if (!$student_id || !$course_id) {
            return back()->with('error', 'Please select a course');
        }

        // Find the student
        $student = Student::find($student_id);

        if (!$student) {
            return redirect('/student')->with('message', 'Please complete your student profile first');
        }

        // Check duplicate enrollment
        $exists = Enrollment::where('student_id', $student_id)
                            ->where('course_id', $course_id)
                            ->exists();

        if ($exists) {
            return redirect('/admin/enrrollment_info')
                    ->with('error', 'This student already enrolled in this course');
        }

        // Insert enrollment
        Enrollment::create([
            'student_id'  => $student_id,
            'course_id'   => $course_id,
            'enrolled_on' => now()->toDateString(),
        ]);

        return redirect('/admin/enrollment_info')
              ->with('message', 'Enrollment successful!');
    }



    public function enrollment_getdata()
    {
        $enrollData=Enrollment::all();

        return view("admin.enrollment_info")->with(['info'=>$enrollData]);
    }
}