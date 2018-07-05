$(function () {
    $("#header_div").css({left:$(window).scrollLeft()*(-1)});
    $('.search_btn').on('click',function(){
        $( ".search_field" ).toggle();
        if($('.content_bl').css("padding-top")=='70px'){
            $('.content_bl').css("padding-top","116px");
        }else{
            $('.content_bl').css("padding-top","70px");
        }
    });

    $('.form_search').keyup(function(e){
        if(e.keyCode==13)
        {
            $('.s').submit();
            //console.log('a');
            //return false;
        }
    });
    if(($(document).width()-$("#header_table").width()-40)>0){
        var new_width=$(".descr_cell div").width()+$(document).width()-$("#header_table").width()-40;
        $(".descr_cell").css({width:new_width,maxWidth:new_width,minWidth:new_width});
        $(".descr_cell div").css({width:new_width-10,maxWidth:new_width-10,minWidth:new_width-10});
    }
    //$('.header_table').fixedtableheader();
    $("#header_table").tablesorter();
    var data_sort= new Array (0,0,0,0,0,0,0,0,0);
    $('#header_table1 th').click(function(){
        var $this = $(this);
        var id = $this.attr('data_id');
        var sorting = [[id,data_sort[id]],[0,0]];
        if(data_sort[id]==0){data_sort[id]=1;}else{data_sort[id]=0;}
        $("#header_table").trigger("sorton",[sorting]);
        return false;
    });
});
$(window).scroll(
    function(){
        $("#header_div").css({left:$(window).scrollLeft()*(-1)});

    }
);
$(window).resize(
    function(){
        $("#header_div").css({left:$(window).scrollLeft()*(-1)});
        if(($(document).width()-$("#header_table").width()-40)>0){
            var new_width=$(".descr_cell div").width()+$(document).width()-$("#header_table").width()-40;
            $(".descr_cell").css({width:new_width,maxWidth:new_width,minWidth:new_width});
            $(".descr_cell div").css({width:new_width-10,maxWidth:new_width-10,minWidth:new_width-10});
        }

    }
);

$( document ).ready(function() {
// attch script start //
    $('.attch_btn').on("click", function(e) {
        e.preventDefault();
        $(".attchWindow").show();
    });
    $('body').on('click',".attch_btn_form",function(e){
        //$('.attch_btn').on("click", function(e) {
        e.preventDefault();
        $(".attchWindowForm").show();
        var h = $(".attchWindowForm").outerHeight();
        var t = $(this).offset().top;
        var l = $(this).offset().left;
        $(".attchWindowForm").offset({top:(t-h-5), left:l})

    });
    $('.attchClose').on("click", function() {
        $(".attchWindow").hide();
        $(".attchWindowForm").hide();
    });
    $("#header_table").tablesorter();
    var data_sort= new Array (0,0,0,0);
    //$('parent_static').on('event', 'children_dinamic', handler);
    $('body').on('click',"#fixedtableheader0 th",function(){
        var $this = $(this);
        var id = $this.attr('data_id');
        if(id!=4){
            var sorting = [[id,data_sort[id]],[0,0]];
            if(data_sort[id]==0){data_sort[id]=1;}else{data_sort[id]=0;}
            $("#header_table").trigger("sorton",[sorting]);
            return false;
        }
    });
    //$('.header_table').fixedtableheader();
    //$("#fixedtableheader0").css('display','table');
    $('.upload').on('click', function() {
        console.log('a');
        var id_attach = $('.attchBody select').val();
        var values = $("input[id='c']").map(function(){return $(this).val();});
        var error = 0;
        if(id_attach==0){
            $(".attchBody p").css('visibility','visible');
            $(".attchBody p").html('Выберите файл');
        }else{
            console.log(id_attach);
            console.log(values);
            for(var i=0;i<values.length;i++){
                if(values[i]==id_attach) error=1;
            }
            if(error==0){
                var name_attach = $( ".attchBody select option:selected" ).text();
                $(".attchBlock").append("<div class='row_attach'><span class='glyphicon glyphicon-remove delete_attach' aria-hidden='true'></span>"+name_attach+"<input type='hidden' name='n[]' value='"+name_attach+"' /><input type='hidden' id='c' name='c[]' value='"+id_attach+"' /></div>");
                $('.attchBody select').val(0);
                $(".attchWindowForm").hide();
            }else{
                $(".attchBody p").css('visibility','visible');
                $(".attchBody p").html('Такой файл уже добавлен');
            }
        }
    });
    $('body').on('click', '.delete_attach', function(e) {
        $(this).parent().remove();
    });

    $('.user_click').click(function(e){
        e.preventDefault();
        $.ajax({
            url: "/attach/click",
            method: "POST",
            //data: {id:$('#data_id').val(),attachment_descr:$('#comment_edit').val()},
            success: function(data){
                $.notify({
                    // options
                    message: 'Hello World'
                },{
                    // settings
                    type: 'danger'
                });
            }
        })
    });

});