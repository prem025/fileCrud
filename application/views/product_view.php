
<div class="container">
<div class="card-header">Product List<button class="btn btn-primary pull-right btn-sm " onclick="addProduct()">Add Product</buttton></div>     
<table class="table table-bordered orders" id='datatable'>
    <thead>
        <tr>
            <th>Id</th>
            <th>Product Name</th>
            <th>Product price</th>
            <th>Product Desccription</th>
            <th>Status</th>
            <!-- <th>Image</th> -->
            <th>Action</th>
        </tr>
    </thead>
    <tbody></tbody>
</table>


<div id="product_modal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Product</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="add_edit_product" method="post" enctype="multipart/form-data">
                  <input type="hidden" name="product_id" id="product_id" value="0"/>
                  <input type="hidden" name="image_item" id="image_item[]" value=""/>
                    <div class="row col-sm-12 form-group">
                        <label class="control-label col-sm-4">Product Name</label>
                        <div class="col-sm-8">
                            <input type="text" id="product_name" name="product_name" class="form-control" placeholder="Enter Product Name"  />
                        </div>
                    </div>
                    <div class="row col-sm-12 form-group">
                        <label class="control-label col-sm-4">Product Price</label>
                        <div class="col-sm-8">
                            <input type="number" id="product_price" name="product_price" class="form-control" placeholder="Enter Product price" />
                        </div>
                    </div>
                    <div class="row col-sm-12 form-group">
                        <label class="control-label col-sm-4">Product Desccription</label>
                        <div class="col-sm-8">
                            <input type="text" id="product_desccription" name="product_desccription" class="form-control" placeholder="Enter Product  Desccription"  />
                        </div>
                    </div>

                    <div class="row col-sm-12 form-group">
                        <label class="control-label col-sm-4">upload Image</label>
                        <div class="col-sm-8">
                        <input type="file" id="product_image" class="random_class" name="product_image[]" multiple="">
                        </div>
                    </div>
                    <div id="image_div" style="text-align: center;"></div>
                   
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="btn_edit_player">Save</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
            
        </div>

    </div>
</div>

<script src="<?php echo base_url('assets/js/views/product_view.js')?>"></script>
