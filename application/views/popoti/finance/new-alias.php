<div class="row">
    <div class="col-lg-12">

        <form action="<?php echo site_url('finance/new-alias/'.encode($alias->id)) ?>" method="post" class="add-alias">

            <div class="form-group">
                <label for="simpleinput">Select COA <span class="text-danger">*</span></label>
                <select name="coaid" id="" class="form-control">
                    <option value=""></option>
                    <?php
                    if($coa->num_rows() > 0): 
                        foreach($coa->result() as $c): ?>
                            <option value="<?php echo $c->id ?>" <?php echo ($c->id == $alias->coaid) ? 'selected=""' : ''; ?>><?php echo "[$c->kode] $c->nama" ?></option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="">Select Category <span class="text-danger">*</span></label>
                <select name="kategori" id="" class="form-control">
                    <option value="0" <?php echo ($alias->kategori == '0') ? 'selected=""' : '' ?>>Others</option>
                    <option value="4" <?php echo ($alias->kategori == '4') ? 'selected=""' : '' ?>>Income</option>
                    <option value="5" <?php echo ($alias->kategori == '5') ? 'selected=""' : '' ?>>Outcome</option>
                </select>
            </div>
            <div class="form-group">
                <label for="">Alias Name <span class="text-danger">*</span></label>
                <input type="text" id="" name="nama" class="form-control" value="<?php echo $alias->nama ?>">
            </div>

        </form>
    </div>
</div>

<div id='ResponseInput'></div>