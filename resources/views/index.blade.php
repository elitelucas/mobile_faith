@extends('layouts.master-layouts')

@section('title')
    Dashboard
@endsection

@section('content')

    @component('common-components.breadcrumb')
        @slot('title') Dashboard @endslot
    @endcomponent

    <div class="row">
        <div class="col-xl-12">
            <div class="row">

                @component('common-components.index-widget')
                    @slot('title') Users @endslot
                    @slot('price') {{ $count[0] }} @endslot
                    @slot('icon') bx bx-user font-size-24 @endslot
                @endcomponent

                @component('common-components.index-widget')
                    @slot('title') Prayers @endslot
                    @slot('price') {{ $count[1] }} @endslot
                    @slot('icon') bx bx-archive-in font-size-24 @endslot
                @endcomponent

                @component('common-components.index-widget')
                    @slot('title') Invites @endslot
                    @slot('price') {{ $count[2] }} @endslot
                    @slot('icon') bx bx-purchase-tag-alt font-size-24 @endslot
                @endcomponent
            </div>
            <!-- end row -->

            <div class="card">
                <div class="card-body">
                    <div class="float-right">
                        <ul class="nav nav-pills">
                            <li class="nav-item">
                                <a class="nav-link active" href="#">Year</a>
                            </li>
                        </ul>
                    </div>
                    <h4 class="card-title mb-4">Statistics</h4>

                    <div id="stacked-column-chart" class="apex-charts" dir="ltr"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->

@endsection

@section('script')
    <!-- Plugin Js-->
    <script src="{{ URL::asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    {{-- <script src="{{ URL::asset('assets/js/pages/dashboard.init.js') }}"></script> --}}

    <script>
        var options = {
            chart: {
                height: 359,
                type: "bar",
                stacked: !0,
                toolbar: {
                    show: !1
                },
                zoom: {
                    enabled: !0
                }
            },
            plotOptions: {
                bar: {
                    horizontal: !1,
                    columnWidth: "15%",
                    endingShape: "rounded"
                }
            },
            dataLabels: {
                enabled: !1
            },
            series: [{
                name: "Users",
                data: [
                    @foreach ($statistics as $statistic)
                        {{ $statistic[0] }},
                    @endforeach
                ]
            }, {
                name: "Prayers",
                data: [
                    @foreach ($statistics as $statistic)
                        {{ $statistic[1] }},
                    @endforeach
                ]
            }, {
                name: "Invites",
                data: [
                    @foreach ($statistics as $statistic)
                        {{ $statistic[2] }},
                    @endforeach
                ]
            }],
            xaxis: {
                categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"]
            },
            colors: ["#556ee6", "#f1b44c", "#34c38f"],
            legend: {
                position: "bottom"
            },
            fill: {
                opacity: 1
            }
        };
        (chart = new ApexCharts(document.querySelector("#stacked-column-chart"), options)).render();
        var chart;
        options = {
            chart: {
                height: 180,
                type: "radialBar",
                offsetY: -10
            },
            plotOptions: {
                radialBar: {
                    startAngle: -135,
                    endAngle: 135,
                    dataLabels: {
                        name: {
                            fontSize: "13px",
                            color: void 0,
                            offsetY: 60
                        },
                        value: {
                            offsetY: 22,
                            fontSize: "16px",
                            color: void 0,
                            formatter: function formatter(e) {
                                return e + "%";
                            }
                        }
                    }
                }
            },
            colors: ["#556ee6"],
            fill: {
                type: "gradient",
                gradient: {
                    shade: "dark",
                    shadeIntensity: .15,
                    inverseColors: !1,
                    opacityFrom: 1,
                    opacityTo: 1,
                    stops: [0, 50, 65, 91]
                }
            },
            stroke: {
                dashArray: 4
            },
            series: [67],
            labels: ["Series A"]
        };
        (chart = new ApexCharts(document.querySelector("#radialBar-chart"), options)).render();

    </script>
@endsection
