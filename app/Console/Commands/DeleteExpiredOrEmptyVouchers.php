<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Voucher;
use Illuminate\Support\Carbon;

class DeleteExpiredOrEmptyVouchers extends Command
{
    // Tên của command
    protected $signature = 'vouchers:delete-expired-or-empty';

    // Mô tả của command
    protected $description = 'Xóa các voucher có số lượng bằng 0 hoặc đã hết hạn';

    public function __construct()
    {
        parent::__construct();
    }

    // Logic xóa voucher hết hạn hoặc có số lượng bằng 0
    public function handle()
    {
        // Lấy ngày hiện tại
        $currentDate = Carbon::now();

        // Xóa các voucher có usage_limit bằng 0 hoặc đã hết hạn
        $deletedCount = Voucher::where('usage_limit', 0)
            ->orWhere('valid_until', '<', $currentDate)
            ->delete();

        // In ra số lượng voucher đã xóa
        $this->info("Đã xóa $deletedCount voucher.");
    }
}
