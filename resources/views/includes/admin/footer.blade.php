</div>
</div>
</div>
</div>
<script>
    (function($) {

        toastr.options = {
            // "closeButton": true,
            "progressBar": true,
            "newestOnTop": true
            // "positionClass": "toast-top-full-width"
        };

        <?php if($errors->any()): ?>
            <?php foreach($errors->all() as $error): ?>
                toastr.error('{{ $error }}', 'Lỗi');
            <?php endforeach; ?>
        <?php endif; ?>
        
        <?php if(session()->has('success')): ?>
            toastr.success("{!! session('success') !!}");
        <?php endif; ?>

        var tfLineChart = (function() {

            var chartBar = function() {

                var options = {
                    series: [{
                            name: 'Tổng cộng',
                            data: [0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00,
                                0.00, 0.00, 0.00
                            ]
                        }, {
                            name: 'Chờ xử lý',
                            data: [0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00,
                                0.00, 0.00, 0.00
                            ]
                        },
                        {
                            name: 'Đã giao',
                            data: [0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00,
                                0.00, 0.00
                            ]
                        }, {
                            name: 'Đã hủy',
                            data: [0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00,
                                0.00, 0.00
                            ]
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
                                return "$ " + val + ""
                            }
                        }
                    }
                };

                chart = new ApexCharts(
                    document.querySelector("#line-chart-8"),
                    options
                );
                if ($("#line-chart-8").length > 0) {
                    chart.render();
                }
            };

            /* Function ============ */
            return {
                init: function() {},

                load: function() {
                    chartBar();
                },
                resize: function() {},
            };
        })();

        jQuery(document).ready(function() {});

        jQuery(window).on("load", function() {
            tfLineChart.load();
        });

        jQuery(window).on("resize", function() {});
    })(jQuery);
</script>
