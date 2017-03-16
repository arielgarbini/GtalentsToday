$("article img").wrap(function () {
    return "<a class='colorbox' href='"+$(this).attr('src')+"'></a>"
});

$("table").addClass('table');

$('a.colorbox').colorbox({width: "80%"});