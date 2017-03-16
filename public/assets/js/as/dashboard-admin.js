as.dashboard = {};

as.dashboard.adjustWidgetsHeight = function () {
    var maxHeight = 0;
    $(".panel-widget .panel-heading").height('auto');
    $(".panel-widget .panel-heading").each(function () {
        if ($(this).height() > maxHeight) {
            maxHeight = $(this).height();
        }
    });
    $(".panel-widget .panel-heading").height(maxHeight);
};

as.dashboard.initChart = function () {
    var data = {
        labels: months,
        datasets: [
            {
                label: trans.chartLabel,
                fillColor: "rgba(151,187,205,0.2)",
                strokeColor: "rgba(151,187,205,1)",
                pointColor: "rgba(151,187,205,1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(151,187,205,1)",
                data: users
            }
        ]
    };

    var ctx = document.getElementById("myChart").getContext("2d");
    var myLineChart = new Chart(ctx).Line(data, {
        responsive: true,
        maintainAspectRatio: false,
        tooltipTemplate: "<%if (label){%><%=label%>: <%}%><%= value %> <%= value == 1 ? '"+trans.new+" "+trans.user+"' : '"+trans.new_plural+" "+trans.users+"' %>",
    });
};

$(document).ready(function () {
    as.dashboard.adjustWidgetsHeight();
    as.dashboard.initChart();
});