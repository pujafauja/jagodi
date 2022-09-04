        <div class="row">
            <div class="col-lg-12">

                <form action="<?php echo site_url('hrd/add_cat/'.$id) ?>" method="post" id="form-category">

                    <div class="form-group">
                        <label for="category">Category Name <span class="text-danger">*</span></label>
                        <input type="text" id="category" name="nama" class="form-control" value="<?php echo $category->nama ?>">
                    </div>

                </form>
            </div>
        </div>

        <div id='ResponseInput'></div>