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
        $(".attchWindow").css('visibility','visible');
    });
    $('body').on('click',".attch_btn",function(e){
        //console.log('a');
        //$('.attch_btn').on("click", function(e) {
        e.preventDefault();
        $(".attchWindow").css('visibility','visible');
        var h = $(".attchWindow").outerHeight();
        var t = $(this).offset().top;
        var l = $(this).offset().left;

    });
    $('.attchClose').on("click", function() {
        $(".attchWindow").css('visibility','hidden');
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
    $('.edit_attach').click(function(){
        $('#label_attach').html($(this).parent().prev().prev().prev().prev().html());
        $('#comment_edit').val($(this).parent().prev().prev().prev().html());
        $('#data_id').val($(this).data('id'));

    });

});