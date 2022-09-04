

<form action="<?php echo site_url('sparepart/tambah-budgeting/'.encode($budgeting->id)) ?>" method="post" id="form-item">


   <div class="form-group">
    <label for="simpleinput">Category <span class="text-danger">*</span></label>
    <select class="form-control" name="categori_id">
        <option value="">-- Choose One --</option>
        <?php 
        if($category->num_rows() > 0)                    
        {
            foreach($category->result() as $c)
                { ?>
                    <option value="<?php echo $c->id ?>" <?php echo ($budgeting->categori_id == $c->id) ? 'selected=""' : '' ?>><?php echo $c->nama ?></option>
                <?php }
            }
            ?>
        </select>
    </div>


    <div class="form-group">
        <label for="simpleinput">Month <span class="text-danger">*</span></label>
        <div class="input-group">
            <input type="text" class="form-control" name="month" data-provide="datepicker" data-date-format="yyyy-mm" data-date-min-view-mode="1" value="<?php echo $budgeting->month ?>">
            <div class="input-group-append">
                <span class="input-group-text"><i class="fe-calendar"></i></span>
            </div>
        </div>
    </div>  

    <div class="form-group">
        <label for="simpleinput">Budgeting <span class="text-danger">*</span></label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">Rp</span>
            </div>
            <input type="text" id="simpleinput" name="budgeting" class="form-control autonumber" data-a-sep="." data-a-dec="," value="<?php echo $budgeting->budgeting ?>">
        </div>
    </div>
    <div id="ResponseInput"></div>

</form>

<script src="<?php echo base_url('assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js') ?>"></script>

<script type="text/javascript">
</script>