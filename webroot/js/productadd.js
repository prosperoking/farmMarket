/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(function(){
    var cat = $("#cat");
    var subcat = ("#subcat");
    cat.each(function(){
      var catopt = $(this).val();
      var text = $(this).text();
      $("#subcat optgroup[label='"+catopt+"']").attr({'label':text,'data-id':catopt});
    });
    var catselected = cat.val();
   
    
    
    
    
    var valOut = $('span[class^=tag]').length;
    if(valOut >4){
            $('#tags'). attr('readonly','readonly');
        }else{
            $('#tags').removeAttr('readonly');
        }
    $('#tags').tagsInput({
        'height':'60px',
        'width':'100%',
        'interactive':true,
        'defaultText':'enter tag',
        'limit':5,
        'maxChars' : 50,
        onChange: function()
        {
       var valOut = $('span[class^=tag]').length;
        if(valOut >4){
            $('#tags'). attr('readonly','readonly');
        }else{
            $('#tags').removeAttr('readonly');
        }

            }
    });
    
});


