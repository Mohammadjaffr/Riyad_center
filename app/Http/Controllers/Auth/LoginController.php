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
     * عرض نموذج تسجيل الدخول
     */
    public function showLoginForm()
    {
        return view('auth.login'); // يمكنك تغييره إلى 'auth-form' لو أردت
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


    /**
     * تحديد بيانات الاعتماد المطلوبة للمصادقة
     */
    protected function credentials(Request $request)
    {
        return [
            $this->username() => $request->input('name'),
            'password' => $request->input('password'),
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
