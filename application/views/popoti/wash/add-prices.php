                                        <div class="row">
                                            <div class="col-lg-12">

                                                <form action="<?php echo site_url('wash/tambah-prices/'.encode($prices->id)) ?>" method="post" class="tambah-prices">

                                                    <div class="form-group">
                                                        <label for="simpleinput">Name <span class="text-danger">*</span></label>
                                                        <input type="text" id="simpleinput" name="nama" class="form-control" value="<?php echo $prices->nama ?>">
                                                    </div>
                                                    
                                                    <h4 class="text-center">Prices</h4>

                                                    <div class="row">
                                                        <?php
                                                        if($category->num_rows() > 0)
                                                        {
                                                            foreach($category->result() as $cat)
                                                            { ?>
                                                                <div class="col-md-4">
                                                                    <label><?php echo $cat->nama ?></label>
                                                                    <div class="input-group">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text">Rp.</span>
                                                                        </div>
                                                                        <input type="text" name="harga[<?php echo $cat->id ?>]" class="form-control" value="<?php echo sql_get_var('tb_jasa_harga', 'harga', ['jasaid' => $jasa->id, 'categoryid' => $cat->id]) ?>">
                                                                    </div>
                                                                </div>
                                                            <?php }
                                                        }
                                                        ?>
                                                    </div>

                                                </form>
                                            </div>
                                        </div>

                                        <div id='ResponseInput'></div>