$(document).ready(function () {
    get_product();
});

function get_product() {
$.ajax({
    url: base_url+ 'Product/getProductData',
    type: 'POST',
    dataType: "json",
    success: function (response) {
        if ($.fn.DataTable.isDataTable('#datatable')) {
            $('#datatable').DataTable().destroy();
        }
        $('#datatable tbody').empty();
        data = response.data;
        
        var status = '';
        var btn = '';
        if (($.trim(data) != null) && ($.trim(data) != 'null') && ($.isPlainObject(data) != true)) {
            var i = 1;
            tblhtml = "";
            $.each(data, function (key, val) {
                if (val.is_deleted == false) {
                    status = 'Active';
                    btn = ' <a class="btn btn-danger btn-sm" href="javascript:deleteProduct(' + val.id + ',\'1\')">Inactive</a> ';
                }
                else {
                    status = 'Inactive';
                    btn = ' <a class="btn btn-success btn-sm" href="javascript:deleteProduct(' + val.id + ',\'0\')">Active</a> ';
                }
                tblhtml += '<tr>';
                tblhtml += '<td >' + val.id + '</td>';
                tblhtml += '<td >' + val.product_name + '</td>';
                tblhtml += '<td >' + val.product_price + '</td>';
                tblhtml += '<td >' + val.product_desccription+ '</td>';
                tblhtml += '<td >' + status + '</td>';
               
                tblhtml += '<td ><a class="btn btn-primary btn-sm" href="#" onclick="editProduct(' + val.id + ')">Edit</a>' + btn + '</td>';


            });
            $('#datatable tbody').html(tblhtml);
            $('#datatable').dataTable();
        }
    }
})
}

deleteProduct = (id, type) => {
    message = (type == '0') ? 'Are you sure you want to Active?' : 'Are you sure you want to InActive?';
    if (confirm(message)) {
        $.ajax({
            type: "POST",
            url: base_url+ 'Product/deleteProduct/' + id + '/' + type,
            dataType: "json",
            success: function (response) {
                console.log(response);
                swal(data.message, "", "success");
                if (response.status == true) {
                    get_product()
                }
            },
            error: function (response) {
                
                swal(data.message, "", "error")
                return false;
            }
        })
    }
}


$(document).delegate(':file', 'change', function() {
    
    for (var i = 0; i < $(this).get(0).files.length; ++i) {
        var file=$(this).get(0).files[i].name;
      
      
        if(file){                        
            var file_size=$(this).get(0).files[i].size;
            if(file_size < 3000000){
                var ext = file.split('.').pop().toLowerCase();                            
                if($.inArray(ext,['gif', 'png', 'jpg', 'jpeg'])===-1){
                    alert('Invalid Image Format! Image Format Must Be JPG, JPEG, PNG or GIF.');
                    $(this).val('');
                    return false;
                }

            }else{
                alert('Maximum File Size Limit is 3MB.');
                $(this).val('');
                return false;
            }                        
        }else{
            alert("fill all fields..");  
            $(this).val('');       
            return false;
        }
    }


});
addProduct = () =>{
    $('#form_title').text('Add Product');
    $("#product_modal").modal("show");
}
$("#add_edit_product").submit(function (e) {
    e.preventDefault();
    var product_name = $.trim($('#product_name').val());
    var product_price = $.trim($('#product_price').val());
    var product_desccription = $.trim($('#product_desccription').val());

    if(product_name == ''){
        alert('Please Enter Product name.');
        return false;

    }
    if(product_price == ''){
        alert('Please Enter Product Price.');
        return false;

    }
    if(product_desccription == ''){
        alert('Please Enter Product Desccription.');
        return false;

    }

    var formdata = new FormData($("#add_edit_product")[0]);
    $.ajax({
        url: base_url + 'Product/productAddEdit',
        type: 'POST',
        data: formdata,
        contentType: false,
        processData: false,
        success: function(data) {
            console.log(data.status);
            if (data.status == true) {
              
                alert(data.message);
                $("#product_modal").modal("hide");
                get_product();
            } else{
                alert("Somthing Wrong")
            }
               
        }
    });
})

$('#product_modal').on('hidden.bs.modal', function () {
    $(this).find('form').trigger('reset');
    $(this).find('#image_div').html('');
    $(this).find('#product_id').val(0);
})

editProduct = (id) =>{
    $('#form_title').text('Update Product');
    $.ajax({
        url: base_url + 'Product/editProductData',
        type: 'POST',
        data: {'id':id},
        dataType: "json",
        success: function(response) {
            console.log(response.data.id);
            var data=response.data;

            var image = data.product_image;

            image = JSON.parse(image);
            console.log(image);
            var items = '';
            if (response.status == true) {
              
               $('#product_id').val(data.id);
               $('#product_name').val(data.product_name);
               $('#product_price').val(data.product_price);
               $('#product_desccription').val(data.product_desccription);

               var i = 0;
                $.each(image,function(i,v){
                    console.log(v);
                    if(v != ''){
                        items +='<div class="col-sm-3 removeDiv" id="iamge_div'+i+'"><input type="hidden" name="image_item[]" value="'+v+'"/>';
                        items +='<img src="'+v+'" alt="product image" width="100" height="100"><button class="imgbtn btn btn-danger">Remove</button></div>';
                    }
                   
                })
                
                $('#image_div').html(items);
               $("#product_modal").modal("show");

                get_product();
            } else{
                alert("Somthing Wrong")
            }
               
        }
    });
    
}

$(document).on('click', '.imgbtn', function () {
    $(this).closest('div').remove();
})
