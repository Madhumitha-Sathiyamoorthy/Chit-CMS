
/*
Template Name: Agroxa - Admin & Dashboard Template
Author: Themesbrand
Website: https://themesbrand.com/
Contact: themesbrand@gmail.com
File: Dashboard init js
 */

// get colors array from the string

function getChartColorsArray(chartId) {
    if (document.getElementById(chartId) !== null) {
        var colors = document.getElementById(chartId).getAttribute("data-colors");
        if (colors) {
            colors = JSON.parse(colors);
            return colors.map(function (value) {
                var newValue = value.replace(" ", "");
                if (newValue.indexOf(",") === -1) {
                    var color = getComputedStyle(document.documentElement).getPropertyValue(
                        newValue
                    );
                    if (color) return color;
                    else return newValue;
                } else {
                    var val = value.split(",");
                    if (val.length == 2) {
                        var rgbaColor = getComputedStyle(
                            document.documentElement
                        ).getPropertyValue(val[0]);
                        rgbaColor = "rgba(" + rgbaColor + "," + val[1] + ")";
                        return rgbaColor;
                    } else {
                        return newValue;
                    }
                }
            });
        } else {
            console.warn('data-colors Attribute not found on:', chartId);
        }
    }
}

function ChartColorChange(chartupdate, chartId) {
    document.querySelectorAll(".theme-color").forEach(function (item) {
        item.addEventListener("click", function (event) {
            setTimeout(function () {
                var updatechartColors = getChartColorsArray(chartId);
                if (chartupdate.options) {
                    if (chartupdate.options["colors"]) {
                        chartupdate.options["colors"] = updatechartColors;
                    } else if (chartupdate.options["lineColors"]) {
                        chartupdate.options["lineColors"] = updatechartColors;
                    } else if (chartupdate.options["barColors"]) {
                        chartupdate.options["barColors"] = updatechartColors;
                    }
                    chartupdate.redraw();
                }
            }, 0);
        });
    });
}

!function ($) {
    "use strict";

    var Dashboard = function () { };

    //creates area chart
    Dashboard.prototype.createAreaChart = function (element, pointSize, lineWidth, data, xkey, ykeys, labels, lineColors) {
        var areaChart = Morris.Area({
            element: element,
            pointSize: 0,
            lineWidth: 0,
            data: data,
            xkey: xkey,
            ykeys: ykeys,
            labels: labels,
            resize: true,
            gridLineColor: '#eeee',
            hideHover: 'auto',
            lineColors: lineColors,
            fillOpacity: .7,
            behaveLikeLine: true
        });
        ChartColorChange(areaChart, 'morris-area-example');
    },

        //creates Donut chart
        Dashboard.prototype.createDonutChart = function (element, data, colors) {
            var donutChart = Morris.Donut({
                element: element,
                data: data,
                resize: true,
                colors: colors
            });
            ChartColorChange(donutChart, 'morris-donut-example');
        },

        //pie
        $('.peity-pie').each(function () {
            $(this).peity("pie", $(this).data());
        });

    //donut
    $('.peity-donut').each(function () {
        $(this).peity("donut", $(this).data());
    });



    Dashboard.prototype.init = function () {

        //creating area chart
        var areaChartColors = getChartColorsArray("morris-area-example");
        if (areaChartColors) {
            var $areaData = [
                { y: '2011', a: 0, b: 0, c: 0 },
                { y: '2012', a: 150, b: 45, c: 15 },
                { y: '2013', a: 60, b: 150, c: 195 },
                { y: '2014', a: 180, b: 36, c: 21 },
                { y: '2015', a: 90, b: 60, c: 360 },
                { y: '2016', a: 75, b: 240, c: 120 },
                { y: '2017', a: 30, b: 30, c: 30 }
            ];
            this.createAreaChart('morris-area-example', 0, 0, $areaData, 'y', ['a', 'b', 'c'], ['Series A', 'Series B', 'Series C'], areaChartColors);
        }
        //creating donut chart
        var donutChartColors = getChartColorsArray("morris-donut-example");
        if (donutChartColors) {
            var $donutData = [
                { label: "Download Sales", value: 12 },
                { label: "In-Store Sales", value: 30 },
                { label: "Mail-Order Sales", value: 20 }
            ];
            this.createDonutChart('morris-donut-example', $donutData, donutChartColors);
        }
    },
        //init
        $.Dashboard = new Dashboard, $.Dashboard.Constructor = Dashboard
}(window.jQuery),

    //initializing 
    function ($) {
        "use strict";
        $.Dashboard.init();
    }(window.jQuery);