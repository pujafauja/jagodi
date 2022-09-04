

   <form action="<?php echo site_url('sparepart/tambah-budgeting/'.encode($budgeting->id)) ?>" method="post" id="form-item">



     <div class="form-group">
      <label for="simpleinput">Query <span class="text-danger">*</span></label>
      <input type="text" id="query_id" value="<?php echo $budgeting->queri_id ?>" name="queri" class="form-control currency">
     </div>

    <div class="form-group">
                <label for="simpleinput">Budgeting <span class="text-danger">*</span></label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Rp</span>
                    </div>
                    <input type="text" id="budgeting" name="budgeting" class="form-control autonumber" data-a-sep="." data-a-dec="," value="<?php echo $budgeting->budgeting ?>">
                </div>
            </div>

</form>

