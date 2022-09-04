<div class="row">
    <div class="col-lg-12">

        <form action="<?php echo site_url('cafe/tambah-prices/'.encode($prices->id)) ?>" method="post" class="tambah-prices">
            
            <div class="form-group">
                <label for="simpleinput">Name <span class="text-danger">*</span></label>
                <input type="text" id="simpleinput" name="nama" class="form-control" value="<?php echo ($prices->nama) ?? null ?>">
            </div>


            <div class="form-group">
                <label for="simpleinput">Purchase Price <span class="text-danger">*</span></label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Rp</span>
                    </div>
                    <input type="text" id="simpleinput" name="harga_beli" class="form-control currency" value="<?php echo ($prices->harga_beli) ?? null ?>">
                </div>
            </div>

             <div class="form-group">
                <label for="simpleinput">Price <span class="text-danger">*</span></label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Rp</span>
                    </div>
                    <input type="text" id="simpleinput" name="harga" class="form-control currency" value="<?php echo ($prices->harga) ?? null ?>">
                </div>
            </div>
        </form>
        </form>
    </div>
</div>

<div id='ResponseInput'></div>