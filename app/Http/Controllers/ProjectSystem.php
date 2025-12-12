<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use  Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use App\Models\Student;
use App\Models\Enrollment;
use Illuminate\Support\Facades\Session;



class ProjectSystem extends Controller
{
    public function signup_form():View
    {
        return view("signup"); #signup.blade.php
    }
   


   public function signup_post(Request $req)
    {
            $req->validate([
                'name'     => 'required|string|max:255',
                'email'    => 'required|email|unique:users,email',
                'password' => 'required|min:3'
            ]);
            
            $role = ($req->email === "admin@gmail.com") ? 1 : 0;

            // Same style as your Post example
            $newUser = new User();
            $newUser->name = $req->name;
            $newUser->email = $req->email;
            $newUser->role = $role;
            $newUser->password = Hash::make($req->password);  // IMPORTANT
            $newUser->email_verified_at = null;
            $newUser->remember_token = Str::random(60);

            $newUser->save();
            // dd($newUser->toArray());

            return redirect('/login')->with('message' ,'insert success');
    }

  // user display
  public function showUsers():View
  {
                
                    $userId=Auth::id();
                    $data=User::find($userId);
                
                    return view('users', compact('data'));
  }

 #login page
     public function login_page():View
    {
        return view("login"); #signup.blade.php
    }
  #login data
     public function login_data(Request $req)
    {
        

        $req->validate([
            'email'=>'required|email',
             'password'=>'required|min:3'
        ]);

        $user=User::where('email',$req->email)->first();

        if(!$user)
        {
            return back()->with('error', 'Invalid email');
        }

         if($user->role==1 && $user->email!='admin@gmail.com')
         {
            return back()->with('error', 'Your account is blocked. Contact admin.');
         }
       

         if(Hash::check($req->password,$user->password))
         {
            return back()->with('error', 'Invalid  password');

         }
        
             Auth::login($user);

             if($user->role==1 && $user->email='admin@gmail.com')
             {
                 return redirect('/admin/admindasbord')->with('message' ,'loginsuccess');
             }
             else{
                return redirect('/users')->with('message' ,'loginsuccess');
             }

        
    }

    //logout

    public function logout_data()
    {
         Auth::logout();
         Session::flush();
         return redirect('/login')->with('message', 'Logged out successfully');
    }

 //-------------------user edit ,delete start-------------------   
  public function user_edit($id)
{
    $user = User::findOrFail($id);
    return view('user_edit', compact('user'));
}



public function user_update(Request $request, $id)
{
    $request->validate([
        'name'  => 'required|string|max:255',
        'email' => 'required|email'
    ]);

    $user = User::findOrFail($id);

    $user->name  = $request->name;
    $user->email = $request->email;
    $user->save();
    if (Auth::user()->role == 1) {
            return redirect('/user_info')->with('message', 'User updated successfully!');
        }

        // If logged-in user is NORMAL USER
        return redirect('/users')->with('message', 'Profile updated successfully!');
    // return redirect('/users')->with('message', 'Profile updated successfully!');
}


public function user_delete($id)
{
    $user = User::findOrFail($id);
    $user->delete();

    return redirect()->back()->with('message', 'User deleted successfully!');
}



 //complete course pages start   
 public function course_form():View
    {
        return view("course"); #course.blade.php
    }

     public function course_data(Request $req)
    {
        $cname=$req->input('course_name');
        $cdu=$req->input('duration');
        $cdesc=$req->input('description');

        $courseObj=new Course();
        $courseObj->course_name=$cname;
        $courseObj->duration=$cdu;
        $courseObj->description=$cdesc;
     
        $courseObj->save();
        //  dd($courseObj);

        return redirect("/course_list");
    }

   //course list

   public function course_show()
  {                  
                    $courseInfo=Course::all();
                
                    return view('course_list')->with(['course'=>$courseInfo]);
  }

   public function course_show_noid():View
  {                  
                    $courseInfo=Course::all();
                
                    return view('course_list')->with(['course'=>$courseInfo]);
  }

  
// public function course_show($user_id)
// {
//     // 1️⃣ convert user_id -> student record
//     $student = Student::where('user_id', $user_id)->first();

//     // If student profile does not exist
//     if (!$student) {
//         // If this is a normal user
//         if (Auth::id() == $user_id) {
//             return redirect('/student')->with('message', 'Please complete your student profile first');
//         }

//         // If this is admin checking another user
//         return redirect('/student/'.$user_id)->with('message', 'Please complete profile for this user');
//     }

//     // 2️⃣ fetch all courses (same for user/admin)
//     $courses = Course::all();

//     // 3️⃣ send data to blade
//     return view('course_list', [
//         'student' => $student,
//         'courses' => $courses,
//         'user_id' => $user_id   // VERY IMPORTANT
//     ]);
// }


   public function course_edit($id):View
  {                  
                    $cedit=Course::findOrFail($id);
                
                    return view('cedit')->with(['course_edit_data'=>$cedit]);
  }

   public function course_update(Request $req)
  {              
           $cuname=$req->input('ecourse_name'); 
           $cudu=$req->input('eduration');              
           $cudesc=$req->input('edescription');              
           $id=$req->input('eid');
           $updateCourse=['course_name'=>$cuname,'duration'=>$cudu,'description'=>$cudesc];
           Course::where('id', $id)->update($updateCourse);
            //    dd($updateCourse);
        return redirect('/course_list')->with('message','course update success');
  }

  public function course_delete($id)
  {                       
           Course::whereId($id)->delete();
           
        return redirect('/course_list')->with('message','course delete success');
  }
// ---------------------------------------course part end here -----------------------------------------------------


//-------------------------student part start ------------------------- 
  
   public function student_form_empty():View
    {
        return view("student"); #student.blade.php
    }

    public function student_form($id):View
        {
            $user=User::find($id);
            return view("student",compact('user')); #student.blade.php
        }

      public function student_data(Request $req)
    {
        $sid=$req->input('user_id');
        $sname=$req->input('full_name');
        $sphone=$req->input('phone');
        $sdept=$req->input('department');

        $req->validate([
        'full_name'  => 'required|string',
        'phone'      => 'required|string',
        'department' => 'required|string'
       ]);

        $studentObj = new Student();

        $studentObj->user_id    = $req->user_id;; 
        $studentObj->full_name  = $req->full_name;
        $studentObj->phone      = $req->phone;
        $studentObj->department = $req->department;

        $studentObj->save();
    //    dd($studentObj);
        return redirect("/student_list");
    }

   //course list

   public function student_show()
  {                  
                    $studentInfo=Student::all();              
                    return view('student_list')->with(['student'=>$studentInfo]);

        //   $allinfo=Student::with('user')->get();
        //   return view('student_list')->with(['student'=>$allinfo]);

  }

   public function student_edit($id):View
  {                  
                    $cedit=Student::findOrFail($id);
                
                    return view('sedit')->with(['student_edit_data'=>$cedit]);
  }

   public function student_update(Request $req)
  {              
           $suname=$req->input('sfull_name'); 
           $suphone=$req->input('sphone');              
           $sudept=$req->input('sdepartment');              
           $id=$req->input('sid');
           $updateStudent=['full_name'=>$suname,'phone'=>$suphone,'department'=>$sudept];
           Student::where('id', $id)->update($updateStudent);
            //    dd($updateCourse);
        return redirect('/student_list')->with('message','student update success');
  }

  public function student_delete($id)
  {                       
           Student::whereId($id)->delete();
           
        return redirect('/student_list')->with('message','student delete success');
  }

//-----------------------enrollment -----------------------

     

     public function enrollment_submit($user_id,$course_id)
    {

    //     if (Auth::id() !== (int)$id) {
    //     // if admins should be able to enroll other users, remove this.
    //     return back()->with('error', 'Unauthorized.');
    //    }
         $student=Student::where('user_id',$user_id)->first();
        
         if (!$student) {
        return redirect('/student/'.$user_id)->with('message', 'Please complete your student profile first');
       }
       
      $exists =  Enrollment::where('student_id',$student->id)
                            ->where('course_id',$course_id)
                            ->exists();
          
        if ($exists) {
                return redirect('/course_list/'.$user_id)->with('error', 'You are already enrolled in this course');
            }
       

            //create enrollment
                Enrollment::create([
                'student_id' =>$student->id,
                'course_id' =>$course_id,
                'enrolled_on'=>now()->toDateString(),

            ]);

       
       return redirect("admin/enrollment_info")->with('message', 'Enrollment successful!');
    }
}