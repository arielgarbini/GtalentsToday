$(document).ready(function(){
    $('.pagination li').click(function(e){
       var new_page = $(this).attr('data-page');
       var padre = $(this).parent();
       var element = padre.attr('data-element');
       var pagina = padre.attr('data-page');
       var url = padre.attr('data-resource');
       var count = padre.attr('data-count');
       var pages = padre.attr('data-pages');
       //bloquear eel paginador
       if((new_page=='last' && pagina==1) || (new_page=='next' && pages==pagina)){
           e.preventDefault();
           return false;
       }
        //pagina nueva
       if(new_page=='last'){
           new_page = parseInt(pagina)-1;
       } else if(new_page=='next'){
           new_page = parseInt(pagina)+1;
       }
       $('#loading').show();
       var data = '';
       $('input').each(function(){
            if($(this).attr('name')!=undefined){
                data += '&'+$(this).attr('name')+'='+$(this).val();
            }
        });
       $('select').each(function(){
            if($(this).attr('name')!=undefined){
                data += '&'+$(this).attr('name')+'='+$(this).val();
            }
       });
       $.ajax({
            url: url+'?page='+new_page+'&count='+count+''+data,
            method : "GET",
            success: function(response){
                console.log(response);
                $('#'+element).html(response.data);
                padre.find('.page-'+new_page).addClass('active');
                padre.find('.page-'+pagina).removeClass('active');
                padre.attr('data-page',new_page);
                $('#loading').hide();
            }
       });
    });
});