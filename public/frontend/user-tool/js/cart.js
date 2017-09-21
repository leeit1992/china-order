$(function(){
     $('.discount').click(function(){
         var id = $(this).attr('cart-id');
         var quantity = $("#quantity-"+id).val();
         quantity = quantity*1 - 1;
         if(quantity <= 0){
             alert('Số lượng sản phẩm phải lớn hơn 0');
             $("#quantity-"+id).val(1);
         }
         else 
            updateQuantity(id, quantity) ;
     });
     
     $('.increment').click(function(){

         var id = $(this).attr('cart-id');
         var quantity = $("#quantity-"+id).val();
         quantity = quantity*1 + 1;

          updateQuantity(id, quantity) ;
     });
     
     $('.quantity-input').change(function(){
         var id = $(this).parent().find('.increment').attr('cart-id');
         var quantity = $(this).val();
         quantity = quantity*1;
//         if(quantity >1000 || quantity <=0){
//             alert('Số lượng sản phẩm phải lớn hơn 0 và nhỏ hơn 1000');
//             $("#quantity-"+id).val(1);
//         }
//         else
            updateQuantity(id, quantity) ;
     });
     
     $(".delete-one").click(function(){
          var id = $(this).attr('cart-id');
          if(confirm('Bạn có chắc chắn muốn xóa không?')){
              deleteItem(id);
          }
     });
     
     $(".comment").click(function(){
          var id = $(this).attr('cart-id');
          var comment = $(this).parent().find('input').val();
          $.post( "XMLHTTP.php?request=cart&action=update_comment", {'id':id,'comment':comment}, function( data ) {
            //data = $.parseJSON(data);
             alert('Bạn đã lưu thành công');
         });
     });

    $(".customer").click(function(){
        var id = $(this).attr('seller-id');
        var customer = $(this).parent().find('input').val();
        $.post( "XMLHTTP.php?request=cart&action=update_customer", {'id':id,'customer':customer}, function( data ) {
            //data = $.parseJSON(data);
            alert('Bạn đã lưu thành công');
        });
    });

    $('#selectall').click(function(event) {  //on click
        if(this.checked) { // check select status
            $('.checkbox').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1"              
            });
        }else{
            $('.checkbox').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"                      
            });        
        }
    });
   
   $('.seller-checkall').click(function(event) {  //on click
        var sellerId = $(this).attr('seller-id');
        
        if(this.checked) { // check select status
            $('.checkbox').each(function() { //loop through each checkbox
                if($(this).attr('seller-id') == sellerId)
                    this.checked = true;  //select all checkboxes with class "checkbox1"              
            });
        }else{
            $('.checkbox').each(function() { //loop through each checkbox
                if($(this).attr('seller-id') == sellerId)
                    this.checked = false; //deselect all checkboxes with class "checkbox1"                      
            });        
        }
    });
    
    $("#delete-all").click(function(){
          var id = $(this).attr('cart-id');
          var selected = '';
          $('.checkbox:checked').each(function() {
             selected += $(this).val() + ',';
          }); 
          //console.log(selected);   
          if(selected == ''){
              alert('Bạn chưa chọn sản phẩm muốn xóa');
              return ;
          }
          if(confirm('Bạn có chắc chắn muốn xóa tất cả những sản phẩm đã chọn không?')){
             $.post( "XMLHTTP.php?request=cart&action=delete_all", {'ids':selected}, function( data ) {
                window.location.reload();                
             });
          }
     });
     
     $('#form-confirm').submit(function(){
          var selected = '';
          var i = 0;
          $('.checkbox[name="cartIds[]"]:checked').each(function() {
             selected += selected?  ','+$(this).val() : $(this).val();
              i++;
          }); 
          //console.log(selected);   
          if(selected == ''){
              alert('Bạn chưa chọn sản phẩm muốn mua');
              return false;
          }
          if(i > 90){
              alert('Bạn ko thể kết đc đơn số link muốn kết vượt quá 90. Vui lòng kết thành nhiều đơn!');
              return false;
          }
          window.location.href=$(this).attr('action')+"&cart_ids="+selected;
          return false;
     });
     
     $(".upload_excel").click(function(){
          $( "#dialog-message" ).dialog({
                modal: true,
                autoOpen: true,
                width: 600,
                buttons: {
                Đóng: function() {
                    $( this ).dialog( "close" );
                }
            }
          });
     }) ; 
     
     $('#upload-sumbit').submit(function(e){
         e.preventDefault();
         var data=new FormData($('#upload-sumbit')[0]);
         $("#ajax-loading").fadeIn();
         $.ajax({url:'XMLHTTP.php?request=cart&action=upload_excel',
                type:"post",data:data,processData:false,
                contentType:false,
                success:function(string){
                    $("#ajax-loading").fadeOut();
                    if(string) alert(string);

                    else window.location.reload();
                    /*var data=$.parseJSON(string);
                    if(data['flag']==1)
                    {
                        $('.alert-success').show();
                        $('.alert-error').hide();
                        $('.alert-success').html(data['message']);
                        setTimeout(function(){ $( "#dialog-message" ).modal('hide');window.location.reload();},1000);
                    }
                    else{
                        $('.alert-error').show();
                        $('.alert-success').hide();
                        $('.alert-error').html(data['message']);
                    }*/
                }
         });
     });
     
});

function updateQuantity(id, quantity){
    $.post( AVTDATA.adminUrl + "/updateCart", {'id':id,'quantity':quantity}, function( data ) {
        data = $.parseJSON(data);
        $( "#price-item-"+id ).html( data.price_item );
        $( "#total-item" ).html( data.total_item );

        $( "#total-price" ).html( data.total_price );
        $( "input[name=avt_total_price_cn]" ).val( data.total_price_no_icon );

        $( "#total-price-vnd" ).html( data.total_price_vnd );
        $( "input[name=avt_total_price_vn]" ).val( data.total_price_vn_no_icon );


        $( "#price-seller-"+data.seller_id ).html( data.total_price_seller );
        $( "#total-item-seller"+data.seller_id ).html( data.total_item_seller);
        
        $("#quantity-"+id).val(quantity);
     });
}

function deleteItem(id){
    $.post( "XMLHTTP.php?request=cart&action=delete_item", {'id':id}, function( data ) {
        data = $.parseJSON(data);
        $( "#item-"+id ).remove();
        if(data.delete_seller){
           $( ".seller-"+data.type+'-'+data.seller_id).remove(); 
        }
        if(data.delete_all){
           $( ".cart-bottom").remove(); 
        }
        $( "#total-item" ).html( data.total_item );
        $( "#total-price" ).html( data.total_price );
        $( "#total-price-vnd" ).html( data.total_price_vnd );
        $( "#price-seller-"+data.seller_id ).html( data.total_price_seller );
        $( "#total-item-seller"+data.seller_id ).html( data.total_item_seller);
        
     });
}