<div class="row">
    <div class="col-lg-12">

        <form action="<?php echo site_url('sparepart/tambah-supplier/'.encode($supplier->id)) ?>" method="post" class="tambah-supplier">

            <div class="form-group">
                <label for="simpleinput">Kode <span class="text-danger">*</span></label>
                <input type="text" id="simpleinput" name="kode" class="form-control" value="<?php echo $supplier->kode ?>">
            </div>
            <div class="form-group">
                <label for="simpleinput">Supplier Name <span class="text-danger">*</span></label>
                <input type="text" id="simpleinput" name="nama" class="form-control" value="<?php echo $supplier->nama ?>">
            </div>
            <div class="form-group">
                <label for="simpleinput">category <span class="text-danger">*</span></label>
                <select class="form-control" name="catid">
                    <option value="">-- Choose One --</option>
                    <?php 
                    if($category->num_rows() > 0)                    
                    {
                        foreach($category->result() as $c)
                        { ?>
                            <option value="<?php echo $c->id ?>" <?php echo ($c->id == $supplier->catid) ? 'selected=""' : '' ?>><?php echo $c->nama ?></option>
                        <?php }
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="simpleinput">Address <span class="text-danger">*</span></label>
                <textarea name="alamat" id="" class="form-control"><?php echo $supplier->alamat ?></textarea>
            </div>
            <div class="form-group">
                <label for="simpleinput">Phone <span class="text-danger">*</span></label>
                <input type="text" id="simpleinput" name="tlp" class="form-control" value="<?php echo $supplier->tlp ?>">
            </div>
            <div class="form-group">
                <label for="simpleinput">Bank</label>
                <input type="text" id="simpleinput" name="bank" class="form-control" value="<?php echo $supplier->bank ?>">
            </div>
            <div class="form-group">
                <label for="simpleinput">Account Number</label>
                <input type="text" id="simpleinput" name="rek" class="form-control" value="<?php echo $supplier->rek ?>">
            </div>
            <div class="form-group">
                <label for="simpleinput">A/N</label>
                <input type="text" id="simpleinput" name="alias" class="form-control" value="<?php echo $supplier->alias ?>">
            </div>

        </form>
    </div>
</div>

<div id='ResponseInput'></div>