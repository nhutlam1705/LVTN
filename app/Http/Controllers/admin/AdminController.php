<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\Models\Contact;
use Illuminate\Support\Facades\Mail;

class Admincontroller extends Controller
{
    public function index(Request $request)
    {
        $contacts = Contact::all();
        // Lấy tháng được chọn hoặc mặc định là tháng hiện tại
        $month = $request->get('month', Carbon::now()->format('Y-m'));
        $startOfMonth = Carbon::createFromFormat('Y-m', $month)->startOfMonth();
        $endOfMonth = Carbon::createFromFormat('Y-m', $month)->endOfMonth();
        $period = CarbonPeriod::create($startOfMonth, $endOfMonth);

        // Tạo mảng ngày với doanh thu mặc định là 0
        $dates = [];
        $revenues = [];
        foreach ($period as $date) {
            $dates[] = $date->format('Y-m-d');
            $revenues[$date->format('Y-m-d')] = 0;
        }

        // Lấy doanh thu thực tế từ bảng orders
        $monthlyRevenue = Order::selectRaw('DATE(created_at) as date, SUM(total_amount) as total')
                                ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
                                ->groupBy('date')
                                ->orderBy('date')
                                ->get();

        foreach ($monthlyRevenue as $revenue) {
            $revenues[$revenue->date] = $revenue->total;
        }

        // Nếu là AJAX request, trả về JSON
        if ($request->ajax()) {
            return response()->json([
                'dates' => array_keys($revenues),
                'revenues' => array_values($revenues),
            ]);
        }
          // Tính tổng doanh thu của tháng
          $totalRevenue = Order::whereBetween('created_at', [$startOfMonth, $endOfMonth])
          ->sum('total_amount');
          $totalOriginal = Order::whereBetween('created_at', [$startOfMonth, $endOfMonth])
          ->sum('total_original');
        // Đối với request bình thường, trả về view
        return view('admin.home', [
            'dates' => array_keys($revenues),
            'revenues' => array_values($revenues),
            'totalRevenue' => $totalRevenue, 
            'totalOriginal' => $totalOriginal, 
            
        ],compact('contacts'));
    }

    // Hàm tính tổng doanh thu theo tháng
    public function getMonthlyRevenue(Request $request)
    {
        // Lấy tháng được chọn hoặc mặc định là tháng hiện tại
        $month = $request->get('month', Carbon::now()->format('Y-m'));

        // Xác định ngày bắt đầu và ngày kết thúc của tháng
        $startOfMonth = Carbon::createFromFormat('Y-m', $month)->startOfMonth();
        $endOfMonth = Carbon::createFromFormat('Y-m', $month)->endOfMonth();

        // Tính tổng doanh thu của tháng
        $totalRevenue = Order::whereBetween('created_at', [$startOfMonth, $endOfMonth])
                             ->sum('total_amount');
        $totalOriginal = Order::whereBetween('created_at', [$startOfMonth, $endOfMonth])
                             ->sum('total_original');

        // Trả về kết quả dưới dạng JSON
        return response()->json([
            'totalRevenue' => $totalRevenue,
            'totalOriginal' => $totalOriginal,
        ]);
    }
    public function reply(Request $request, $id)
    {
        $request->validate(['reply_message' => 'required|string']);

        $contact = Contact::findOrFail($id);

        // Gửi email phản hồi
        Mail::raw($request->reply_message, function ($message) use ($contact) {
            $message->to($contact->email)
                    ->subject('Shop Điện gia dụng Nhựt Lâm');
        });

        $contact->update(['is_replied' => true]);

        return back()->with('success', 'Phản hồi đã được gửi.');
    }
}