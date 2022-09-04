<form action="<?php echo site_url('ecommerce/save-discount/'.encode($discount->id)) ?>" method="post" class="add-new">
    <div class="row">
        <div class="col-md-6">
            <div class="card-box">

                <h5 class="text-uppercase bg-light p-2 mt-0 mb-3">General</h5>
                    
                <div class="form-group">
                    <label for="simpleinput">Discount Name <span class="text-danger">*</span></label>
                    <input type="text" id="simpleinput" name="nama" class="form-control" value="<?php echo $discount->nama ?>">
                </div>

                <div class="form-group">
                    <label for="simpleinput">Periode <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <input type="text" id="" name="awal" class="form-control basic-datepicker" value="<?php echo $discount->awal ?>">
                        <div class="input-group-text">-</div>
                        <input type="text" id="" name="akhir" class="form-control basic-datepicker" value="<?php echo $discount->akhir ?>">
                    </div>
                </div>
                    
                <div class="form-group">
                    <label for="discount-type">Discount For <span class="text-danger">*</span></label>
                    <select name="type" id="discount-type" class="form-control">
                        <option <?php echo $discount->type == 'all' ? 'selected=""' : '' ?> value="all">All Products</option>
                        <option <?php echo $discount->type == 'product' ? 'selected=""' : '' ?> value="product">Specific Products</option>
                        <option <?php echo $discount->type == 'kategori' ? 'selected=""' : '' ?> value="kategori">Specific Categories</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="simpleinput">Disc. Amount <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <label for="">
                                    <input type="radio" name="typeDisc" value="%" <?php echo $discount->typeDisc == '%' || !$discount->typeDisc ? 'checked=""' : '' ?>>
                                    %
                                </label>
                                <label for="">
                                    <input type="radio" name="typeDisc" value="Rp" <?php echo $discount->typeDisc == 'rp' ? 'checked=""' : '' ?>>
                                    Rp
                                </label>
                            </div>
                        </div>
                        <input type="text" id="" name="nominal" class="form-control currency" value="<?php echo $discount->nominal ?>">
                    </div>
                </div>

            </div>
        </div>

        <div class="col-md-6">
            <div class="card-box">

                <h5 class="text-uppercase bg-light p-2 mt-0 mb-3">Discount Detail</h5>

                <div id="discount-product" class="alert alert-info d-none"><i class="mdi mdi-alert-outline mr-1"></i>Discount will applied to all products</div>

                <div class="form-group d-none" id="discount-category">
                    <div class="form-group mb-3">
                        <label for="product-category">Categories <span class="text-danger">*</span></label>
                        <select id="product-category" name="categories[]" multiple class="form-control">
                            <?php echo nestedKategoriMultipleSelect($category, '', json_decode($discount->kategoriid, true), $optionGroup = true); ?>
                        </select>
                    </div>
                </div>

                <div id="discount-few-products" class="">
                    <div class="row">
                        <div class="col-12">
                            <div class="alert alert-info">Select products using this button below</div>
                        </div>

                        <table id="product-detail" class="table table-borderless">
                            <tbody>
                                <?php
                                if($discount->type == 'product'):
                                    foreach(json_decode($discount->productid) as $prodID):
                                        $productID = decode($prodID);

                                        $gambar = json_decode(sql_get_var('products', 'images', ['id' => $productID]))[0];
                                        $nama = sql_get_var('products', 'nama', ['id' => $productID]); ?>
                                        <tr>
                                            <td width="50px">
                                              <a href="" class="remove-item"><i class="fe-x-circle text-danger"></i></a>
                                              <input id="product-id" type="hidden" name="products[]" value="<?php echo $prodID ?>">
                                            </td>
                                            <td class="table-user">
                                              <img src="<?php echo base_url('media/products/md/'.$gambar) ?>" class="mr-2 rounded-circle" alt="">
                                              <span class="font-weight-semibold"><?php echo $nama ?></span>
                                            </td>
                                        </tr>
                                    <?php endforeach;
                                endif;
                                ?>
                            </tbody>
                        </table>
                        <div class="row" id="product-detail">
                            
                        </div>

                        <div class="row mt-2">
                            <div class="col-12"><a href="<?php echo base_url('ecommerce/new-featured') ?>" class="btn btn-primary btn-sm text-light product-modal"><i class="fas fa-plus mr-1"></i> Add New Product</a></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="text-center mb-3">
                <a href="<?php echo base_url('ecommerce/discounts') ?>" class="btn w-sm btn-light waves-effect">Cancel</a>
                <button type="submit" class="btn w-sm btn-success waves-effect waves-light save-product">Save</button>
            </div>
        </div> <!-- end col -->
    </div>
    <!-- end row -->
</form>