<div class="row">
    <div class="col-lg-12">

        <form action="<?php echo site_url('Utilities/tambah-inventory/'.encode($inventory->id)) ?>" method="post" id="form-item">

           <div class="form-group">
                <label for="simpleinput">Purchase Date <span class="text-danger">*</span></label>
                <div class="input-group">
                    <input type="date" id="simpleinput" name="tanggal_pembelian" value="<?php echo $inventory->tanggal_pembelian ?>" class="form-control">
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="fe-calendar"></i></span>
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <label for="simpleinput">Item Name <span class="text-danger">*</span></label>
                <input type="text" id="simpleinput" name="nama" value="<?php echo $inventory->nama ?>" class="form-control">
            </div>
        
           <div class="form-group">
                <label for="simpleinput">Location <span class="text-danger">*</span></label>
                <input type="text" name="lokasi_id" value="<?php echo $inventory->lokasi_id ?>" class="form-control">
            </div>

            <div class="form-group">
                <label for="simpleinput">Purchase value <span class="text-danger">*</span></label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Rp</span>
                    </div>
                    <input type="text" id="nilai_pembelian" name="nilai_pembelian" value="<?php echo $inventory->nilai_pembelian ?>" class="form-control autonumber" data-a-sep='.' data-a-dec="," data-m-dec="0" >
                </div>
            </div>  


            <div class="form-group">
            <label for="simpleinput">Number COA <span class="text-danger">*</span></label>
                <select class="form-control" name="numbercoa">
                    <option value="">-- Choose One --</option>

                      <?php
                    if($alias->num_rows() > 0):
                        foreach($alias->result() as $al): ?>
                            <?php if ($inventory->numbercoa): ?>
                                <?php if ($inventory->numbercoa == $al->id): ?>
                                    <option value="<?php echo $al->id ?>" selected>
                                        <?php echo $al->kode ?>
                                        <?php echo $al->nama ?>
                                    </option>
                                <?php else: ?>
                                    <option value="<?php echo $al->id ?>">
                                        <?php echo $al->kode ?>
                                        <?php echo $al->nama ?>
                                    </option>
                                <?php endif ?>
                            <?php else: ?>
                                <option value="<?php echo $al->id ?>">
                                    <?php echo $al->kode ?>
                                    <?php echo $al->nama ?>
                                </option>
                            <?php endif ?>
                        <?php endforeach;
                    endif;
                    ?>
                </select>
            </div>


        
            <div class="form-row baris mb-1">

                <div class="col-md-6">

                <label> Depreciation</label> 
                <div class="form-group">
                    <input type="text" id="penyusutan" name="penyusutan" value="<?php echo $inventory->penyusutan ?>" class="form-control autonumber" data-a-sep="." data-a-dec=",">
                  </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for=""></label>
                        <div class="input-group">
                         <div class="input-group-prepend">
                               <span class="input-group-text">Rp</span>
                           </div>
                           <input type="text" id="jumlah" name="nilai_buku" value="<?php echo $inventory->nilai_buku ?>" readonly="" class="form-control autonumber" data-a-sep="." data-a-dec=",">
                        </div>
                    </div>
               </div>

            </div>

          <div class="form-group">
                <label for="simpleinput">Accumulation <span class="text-danger">*</span></label>
                <select class="form-control" name="acumulation">
                  <option value="">-- Choose One --</option>
                  <?php
                    if($alias->num_rows() > 0):
                        foreach($alias->result() as $al): ?>
                            <?php if ($inventory->acumulation): ?>
                                <?php if ($inventory->acumulation == $al->id): ?>
                                    <option value="<?php echo $al->id ?>" selected>
                                        <?php echo $al->kode ?>
                                        <?php echo $al->nama ?>
                                    </option>
                                <?php else: ?>
                                    <option value="<?php echo $al->id ?>">
                                        <?php echo $al->kode ?>
                                        <?php echo $al->nama ?>
                                    </option>
                                <?php endif ?>
                            <?php else: ?>
                                <option value="<?php echo $al->id ?>">
                                    <?php echo $al->kode ?>
                                    <?php echo $al->nama ?>
                                </option>
                            <?php endif ?>
                        <?php endforeach;
                    endif;
                    ?>
                </select>
            </div>
       </form>
  <div id='ResponseInput'></div>
  </div>
</div>


<script src="<?php echo base_url() ?>assets/js/vendor.min.js"></script>
<script src="<?php echo base_url('assets/libs/autonumeric/autoNumeric-min.js') ?>"></script>

<script src="<?php echo base_url('assets/js/pages/form-masks.init.js') ?>"></script>

<script>
    function toFloat(nominal = 0)
    {
        if(nominal == '')
        {
            nominal = 0;
            nominal = parseFloat(nominal);
        } else {
            nominal = nominal.replace(/[.]/g, '');
            nominal = nominal.replace(/[,]/g, '.');
            nominal = parseFloat(nominal);
        }

        return nominal;
    }



</script>
