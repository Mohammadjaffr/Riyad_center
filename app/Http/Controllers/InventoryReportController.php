<?php
namespace App\Http\Controllers;

use App\Models\InventoryLog;
use Illuminate\Http\Request;

class InventoryReportController extends Controller
{
    public function index(Request $request)
    {
        $logs = InventoryLog::with(['product', 'employee'])
            ->when($request->type, function ($query, $type) {
                $query->where('change_type', $type);
            })
            ->latest()
            ->paginate(20);

        return view('inventory_reports.index', compact('logs'));
    }

}
