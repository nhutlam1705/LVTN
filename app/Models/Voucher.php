<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    protected $table = 'vouchers';

    protected $fillable = [
        'code',
        'description_voucher', 
        'value',
        'type',
        'start_date',
        'end_date',
        'usage_limit'
    ];
    public function isValid()
    {
        $now = now();
        if ($this->usage_limit <= 0) {
            return false; // Nếu số lần sử dụng đã hết
        }

        if ($this->start_date && $this->start_date > $now) {
            return false; // Nếu voucher chưa bắt đầu
        }

        if ($this->end_date && $this->end_date < $now) {
            return false; // Nếu voucher đã hết hạn
        }

        return true; // Voucher hợp lệ
    }
}
