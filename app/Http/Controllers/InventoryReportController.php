<?php
namespace App\Http\Controllers;

use App\Models\InventoryLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InventoryReportController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::guard('employee')->user();
        $department_id = $user->department_id;

        $logs = InventoryLog::with(['productVariant.product', 'employee'])
            ->latest()
            ->paginate(20);

        return view('inventory_reports.index', compact('logs'));
    }

}
