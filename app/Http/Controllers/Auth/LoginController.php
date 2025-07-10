<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.employee-login');
    }

    /**
     * إلى أين يُعاد التوجيه بعد تسجيل الدخول
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * إنشاء نسخة من الكنترولر وتفعيل ميدلوير الضيف فقط
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * تحديد الحقل الذي سيُستخدم لتسجيل الدخول (email أو name أو username)
     */
    public function username()
    {
        $login = request()->input('name');

        // تحديد نوع الحقل: إذا كان أرقام = phone، غير ذلك = name
        if (is_numeric($login)) {
            $field = 'phone';
        } else {
            $field = 'name';
        }

        // دمج الحقل المحدد مع الطلب ليسمح للمصادقة بالعمل
        request()->merge([$field => $login]);

        return $field;
    }
    public function login(Request $request)
    {
        $credentials = $request->only('phone', 'password');

        if (Auth::guard('employee')->attempt($credentials)) {
            $request->session()->regenerate();
            $employee = Auth::guard('employee')->user();

            session([
                'user_type' => 'employee',
                'department_id' => $employee->department_id,
            ]);

            if ($employee->hasRole('admin')) {
                return redirect()->route('dashboard.admin');
            }

            switch ($employee->department_id) {
                case 1:
                    return redirect()->route('dashboard.admin');
                case 2:
                    return redirect()->route('dashboard.clothes');
                case 3:
                    return redirect()->route('dashboard.shoes');
                default:
                    return redirect()->route('home');
            }
        }

        return back()->withErrors([
            'phone' => 'بيانات الدخول غير صحيحة',
        ]);
    }


    /**
     * تحديد بيانات الاعتماد المطلوبة للمصادقة
     */
    protected function credentials(Request $request)
    {
        return [
            'name' => $request->name,
            'password' => $request->password,
            'status'=>'نشط',
        ];
    }

    /**
     * التحقق من صحة الطلب مع رسائل عربية مخصصة
     */
    protected function validateLogin(Request $request)
    {
        $request->validate([
            'name' => 'required|string|exists:employees,name',
            'password' => 'required|string',
        ], [
            'name.required' => 'حقل اسم المستخدم مطلوب',
            'name.string' => 'يجب أن يكون اسم المستخدم نصًا',
            'name.exists' => 'اسم المستخدم غير مسجل في النظام',
            'password.required' => 'حقل كلمة المرور مطلوب',
            'password.string' => 'يجب أن تكون كلمة المرور نصًا',
        ]);
    }

    /**
     * ما يحدث بعد تسجيل الدخول بنجاح
     */
    protected function authenticated(Request $request, $user)
    {
        return redirect()->intended($this->redirectPath())
            ->with('success', 'تم تسجيل دخولك بنجاح!');
    }
}
