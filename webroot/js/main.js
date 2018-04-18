$(document).ready(function(){
    $.ajaxSetup({
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })

    $('a.btn.add-to-cart').click(function(e){
        e.preventDefault();
        var itemid = $(this).attr('data-id');
        
        var quantity = 1;
        var data = {'product_id':itemid,'quantity':quantity};
        
        $.ajax({
            url:'/carts/add/',
            type:'POST',
            data: data
        }).done(function(msg){
               var response = msg;
               var cartmsg = $('#cartno');
               if(response.status){
                   $('#cartno').text(parseInt(cartmsg.text())+response.qty);
                   $.toast({
                    text: response.message, // Text that is to be shown in the toast
                    heading: '<i class="fa fa-angellist"> </i>Done!',
                    showHideTransition: 'fade', // fade, slide or plain
                    allowToastClose: true, // Boolean value true or false
                    hideAfter: 3000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
                    stack: 5, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
                    position: 'top-right', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
                    bgColor: '#FE980F',  // Background color of the toast
                    textColor: '#eeeeee',  // Text color of the toast
                    textAlign: 'left'  // Text alignment i.e. left, right or center
                });
               }else{
                   $.toast({
                    text: response.message, // Text that is to be shown in the toast
                    heading: '<i class="glyphicon glyphicon-exclamation-sign"> </i> Oops!',
                    showHideTransition: 'fade', // fade, slide or plain
                    allowToastClose: true, // Boolean value true or false
                    hideAfter: 3000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
                    stack: 5, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
                    position: 'top-right', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values

                    bgColor: '#444444',  // Background color of the toast
                    textColor: '#eeeeee',  // Text color of the toast
                    textAlign: 'left'  // Text alignment i.e. left, right or center
                   
                });
               }
            });
    });
});
