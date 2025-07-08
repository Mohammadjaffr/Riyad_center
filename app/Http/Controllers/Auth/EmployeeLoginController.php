<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.employee-login');
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
                default:
                    return redirect()->route('home');
            }
        }

        return back()->withErrors([
            'phone' => 'بيانات الدخول غير صحيحة',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('employee')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('employee.login.form');
    }
    protected function credentials(Request $request)
    {
        return [
            'phone' => $request->phone,
            'password' => $request->password,
            'status'=>'نشط',
        ];
    }
}
