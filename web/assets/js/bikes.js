/**
 * Created by anjatomovska on 12/13/16.
 */

$(document).ready(function(){
    $('[data-toggle="popover"]').popover();

    $('#filter_bike').delegate('input[name="bike_filter"]',"change", (function () {
        var categories = $( 'input[name="bike_filter"]' );

        for (var  i = 0; i <categories.length; i++){


            if(categories[i].checked){

                $("."+categories[i].value).show();
            }
            else{
                $("."+categories[i].value).hide();
            }
        }
    }));



    $(".favorite-bike").mouseover(function(){


        $(this).find('i').toggleClass('fa-heart-o');
        $(this).find('i').toggleClass('fa-heart');
    });

    $(".favorite-bike").mouseout(function(){

        $(this).find('i').toggleClass('fa-heart-o');
        $(this).find('i').toggleClass('fa-heart');
    });


    $('.favorite-bike').click(function(){

        var url = $("#favorite_url").attr('url');


        var thisElem = $(this);



        var data  ={
            'id': $(this).attr('id'),

        };
        $.ajax({
            url: url,
            method:'post',
            data:data
        }).success(function(response){
           thisElem.removeClass('favorite-bike');
           thisElem.find('i').toggleClass('fa-heart-o');
           thisElem.find('i').toggleClass('fa-heart');

        })
    });


});