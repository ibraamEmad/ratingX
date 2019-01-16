  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
  
$(document).ready(() => {

$('#searched').on('input',function(){
    console.log($("#searched").val());
    var searched_for=$("#searched").val();
   // console.log($("#searched").val());
    var movies;
    if(searched_for!==""){

    $.ajax({
        url: '/movie/search/'+searched_for,
        type: 'get',
        success: function(result) {
            var results=result[0];
          movies=result[1];
        //    alert(restaurants);

          for(var i = 1; i < movies+1; i++ ){
            var element=$("#movie"+i);
              if($("#movie"+i).length){
                $(element).hide();
              }
              else{
                  movies++;
              }
            
          }
            for ( var i = 0; i < results.length; i++ ) {


            var element=$("#movie"+results[i].id);
            $(element).show();


            }


         //   $('#row'+res).hide();
         //hide data like delete and show the results
        }
    });

}
   else{
    $.ajax({
        url: '/movie/count/all',
        type: 'get',
        data: { somefield: "Some field value", _token: '{{csrf_token()}}' },


        success: function(result) {
            console.log(result);
            movies=result;
            for(var i = 1; i < movies+1; i++ ){
                
                var element=$("#movie"+i);
                if($("#movie"+i).length){

             //   console.log(element);
                $(element).show();
                }
                else{
                    movies++;
                }
              }

        }
    });

                }
});


$('.star').click(function(){
var result=this.id.split("-");
var movie=result[0];
var rating=result[1];
console.log(rating);
$(".modal"+movie).hide();
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$.ajax({
    url: '/rate/'+movie+'/'+rating,
    type: 'PUT',
    data:{
        "rate": rating,
    },
    dataType: 'json',
    success: function(result) {
   //     $("#name-"+res).html(name);

        alert(result);
    },
    error:function(error){
       // $(this).hide();
      //  alert(error);
    }
});
});

// $('.rate').click(function(){
//     var rating=$("rate-"+this.id).val();
//     $.ajax({
//         url: '/rate/'+this.id,
//         type: 'PUT',
//         data:{
//             "rate": rating,
//         },
//         success: function(result) {
//        //     $("#name-"+res).html(name);
//    console.log("success");
//         }
//     });
// });

});
