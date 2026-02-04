<?php

namespace App\Mail;

use App\Models\DonHang;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

/**
 * Email xác nhận đơn hàng
 * Gửi cho khách hàng sau khi đặt hàng thành công
 * Sử dụng Queue (Queueable) để không làm chậm response
 */
class OrderConfirm extends Mailable
{
    use Queueable, SerializesModels;

    public $donHang;

    // Nhận đơn hàng khi khởi tạo
    public function __construct(DonHang $donHang)
    {
        $this->donHang = $donHang;
    }

    // Build email: subject, view, data
    public function build()
    {
        return $this->subject('Xác nhận đơn hàng')
                    ->markdown('user.orders.mail') // Sử dụng Markdown template
                    ->with('donHang', $this->donHang);
    }
}
