@extends('layouts.admin')

@section('content')
    <div class="main-content-inner">

        <div class="main-content-wrap">
            <div class="tf-section-2 mb-30">
                <div class="flex gap20 flex-wrap-mobile">
                    <div class="w-half">

                        <div class="wg-chart-default mb-20">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap14">
                                    <div class="image ic-bg">
                                        <i class="icon-shopping-bag"></i>
                                    </div>
                                    <div>
                                        <div class="body-text mb-2">Tổng đơn hàng</div>
                                        <h4>{{ $totalOrders }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="wg-chart-default mb-20">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap14">
                                    <div class="image ic-bg">
                                        <i class="icon-dollar-sign"></i>
                                    </div>
                                    <div>
                                        <div class="body-text mb-2">Tổng doanh thu</div>
                                        <h4>{{ number_format($totalRevenue, 2) }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="wg-chart-default mb-20">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap14">
                                    <div class="image ic-bg">
                                        <i class="icon-shopping-bag"></i>
                                    </div>
                                    <div>
                                        <div class="body-text mb-2">Đơn chờ xử lý</div>
                                        <h4>{{ $pendingOrders }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="wg-chart-default">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap14">
                                    <div class="image ic-bg">
                                        <i class="icon-dollar-sign"></i>
                                    </div>
                                    <div>
                                        <div class="body-text mb-2">Doanh thu chờ xử lý</div>
                                        <h4>{{ number_format($pendingRevenue, 2) }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="w-half">

                        <div class="wg-chart-default mb-20">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap14">
                                    <div class="image ic-bg">
                                        <i class="icon-shopping-bag"></i>
                                    </div>
                                    <div>
                                        <div class="body-text mb-2">Đơn đã giao</div>
                                        <h4>{{ $deliveredOrders }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="wg-chart-default mb-20">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap14">
                                    <div class="image ic-bg">
                                        <i class="icon-dollar-sign"></i>
                                    </div>
                                    <div>
                                        <div class="body-text mb-2">Doanh thu đã giao</div>
                                        <h4>{{ number_format($deliveredRevenue, 2) }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="wg-chart-default mb-20">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap14">
                                    <div class="image ic-bg">
                                        <i class="icon-shopping-bag"></i>
                                    </div>
                                    <div>
                                        <div class="body-text mb-2">Đơn đã hủy</div>
                                        <h4>{{ $cancelledOrders }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="wg-chart-default">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap14">
                                    <div class="image ic-bg">
                                        <i class="icon-dollar-sign"></i>
                                    </div>
                                    <div>
                                        <div class="body-text mb-2">Doanh thu đã hủy</div>
                                        <h4>{{ number_format($cancelledRevenue, 0, ',', '.') }}đ</h4>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

                <div class="wg-box">
                    <div class="flex items-center justify-between">
                        <h5>Biểu đồ doanh thu</h5>
                        <div class="dropdown default">
                            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <span class="icon-more"><i class="icon-more-horizontal"></i></span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a href="javascript:void(0);">Tuần này</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);">Tuần trước</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="flex flex-wrap gap40">
                        <div>
                            <div class="mb-2">
                                <div class="block-legend">
                                    <div class="dot t1"></div>
                                    <div class="text-tiny">Doanh thu</div>
                                </div>
                            </div>
                            <div class="flex items-center gap10">
                                <h4>{{ number_format($yearRevenue, 0, ',', '.') }}đ</h4>
                                <div class="box-icon-trending {{ $revenueGrowth >= 0 ? 'up' : 'down' }}">
                                    <i class="icon-trending-{{ $revenueGrowth >= 0 ? 'up' : 'down' }}"></i>
                                    <div class="body-title number">{{ number_format($revenueGrowth, 2) }}%</div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="mb-2">
                                <div class="block-legend">
                                    <div class="dot t2"></div>
                                    <div class="text-tiny">Đơn hàng</div>
                                </div>
                            </div>
                            <div class="flex items-center gap10">
                                <h4>{{ $yearOrders }}</h4>
                                <div class="box-icon-trending {{ $ordersGrowth >= 0 ? 'up' : 'down' }}">
                                    <i class="icon-trending-{{ $ordersGrowth >= 0 ? 'up' : 'down' }}"></i>
                                    <div class="body-title number">{{ number_format($ordersGrowth, 2) }}%</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="line-chart-8"></div>
                </div>

            </div>
            <div class="tf-section mb-30">

                <div class="wg-box">
                    <div class="flex items-center justify-between">
                        <h5>Đơn hàng gần đây</h5>
                        <div class="dropdown default">
                            <a class="btn btn-secondary dropdown-toggle" href="#">
                                <span class="view-all">Xem tất cả</span>
                            </a>
                        </div>
                    </div>
                    <div class="wg-table table-all-user">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 80px">Mã ĐH</th>
                                        <th>Tên</th>
                                        <th class="text-center">SĐT</th>
                                        <th class="text-center">Tạm tính</th>
                                        <th class="text-center">Thuế</th>
                                        <th class="text-center">Tổng cộng</th>

                                        <th class="text-center">Trạng thái</th>
                                        <th class="text-center">Ngày đặt</th>
                                        <th class="text-center">Số lượng</th>
                                        <th class="text-center">Ngày giao</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($recentOrders as $order)
                                    <tr>
                                        <td class="text-center">{{ $order->ma_don_hang }}</td>
                                        <td class="text-center">{{ $order->ten_nguoi_nhan }}</td>
                                        <td class="text-center">{{ $order->sdt_nguoi_nhan }}</td>
                                        <td class="text-center">{{ number_format($order->tien_hang, 0, ',', '.') }}đ</td>
                                        <td class="text-center">0đ</td>
                                        <td class="text-center">{{ number_format($order->tong_tien, 0, ',', '.') }}đ</td>

                                        <td class="text-center">
                                            {{ \App\Models\DonHang::TRANG_THAI_DON_HANG[$order->trang_thai_don_hang] ?? $order->trang_thai_don_hang }}
                                        </td>
                                        <td class="text-center">{{ $order->created_at }}</td>
                                        <td class="text-center">{{ $order->chiTietDonHang->sum('so_luong') }}</td>
                                        <td></td>
                                        <td class="text-center">
                                            <a href="{{ route('admin.orders.show', ['id' => $order->id]) }}">
                                                <div class="list-icon-function view-icon">
                                                    <div class="item eye">
                                                        <i class="icon-eye"></i>
                                                    </div>
                                                </div>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
    <div id="chart-data-storage"
        data-revenue="{{ json_encode($monthlyRevenue) }}"
        data-pending="{{ json_encode($monthlyPendingArr) }}"
        data-delivered="{{ json_encode($monthlyDeliveredArr) }}"
        data-cancelled="{{ json_encode($monthlyCancelledArr) }}"
        style="display:none;"></div>
@endsection

@push('scripts')
<script>
    (function($) {
        var tfLineChart = (function() {
            var chartBar = function() {
                var storage = document.getElementById('chart-data-storage');
                var dataRevenue = JSON.parse(storage.getAttribute('data-revenue'));
                var dataPending = JSON.parse(storage.getAttribute('data-pending'));
                var dataDelivered = JSON.parse(storage.getAttribute('data-delivered'));
                var dataCancelled = JSON.parse(storage.getAttribute('data-cancelled'));

                var options = {
                    series: [{
                            name: 'Tổng cộng',
                            data: dataRevenue
                        }, {
                            name: 'Chờ xử lý',
                            data: dataPending
                        },
                        {
                            name: 'Đã giao',
                            data: dataDelivered
                        }, {
                            name: 'Đã hủy',
                            data: dataCancelled
                        }
                    ],
                    chart: {
                        type: 'bar',
                        height: 325,
                        toolbar: {
                            show: false,
                        },
                    },
                    plotOptions: {
                        bar: {
                            horizontal: false,
                            columnWidth: '10px',
                            endingShape: 'rounded'
                        },
                    },
                    dataLabels: {
                        enabled: false
                    },
                    legend: {
                        show: false,
                    },
                    colors: ['#2377FC', '#FFA500', '#078407', '#FF0000'],
                    stroke: {
                        show: false,
                    },
                    xaxis: {
                        labels: {
                            style: {
                                colors: '#212529',
                            },
                        },
                        categories: ['Th1', 'Th2', 'Th3', 'Th4', 'Th5', 'Th6', 'Th7', 'Th8', 'Th9',
                            'Th10', 'Th11', 'Th12'
                        ],
                    },
                    yaxis: {
                        show: false,
                    },
                    fill: {
                        opacity: 1
                    },
                    tooltip: {
                        y: {
                            formatter: function(val) {
                                return Number(val).toLocaleString('vi-VN') + "đ"
                            }
                        }
                    }
                };

                var chart = new ApexCharts(
                    document.querySelector("#line-chart-8"),
                    options
                );
                if ($("#line-chart-8").length > 0) {
                    chart.render();
                }
            };

            return {
                load: function() {
                    chartBar();
                },
            };
        })();

        $(window).on("load", function() {
            tfLineChart.load();
        });
    })(jQuery);
</script>
@endpush
