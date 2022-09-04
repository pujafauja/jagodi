                                        <div class="row">
                                            <div class="col-lg-12">

                                                <form action="<?php echo site_url('service/tambah-package/'.encode($package->id)) ?>" method="post" class="tambah-package">

                                                    <div class="form-group">
                                                        <label for="simpleinput">Nama Paket <span class="text-danger">*</span></label>
                                                        <input type="text" id="simpleinput" name="nama" class="form-control" value="<?php echo $package->nama ?>">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="simpleinput">Harga <span class="text-danger">*</span></label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">Rp.</span>
                                                            </div>
                                                            <input type="text" name="harga" class="form-control" value="<?php echo $package->harga ?>">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Items</label>
                                                        <div class="row">
                                                            <?php
                                                            if($group->num_rows() > 0)
                                                            {
                                                                $no = 1;
                                                                foreach($group->result() as $gr)
                                                                { ?>
                                                                    <div class="col-md-4">
                                                                        <div class="custom-control custom-checkbox">
                                                                            <input type="checkbox" name="groupid[]" class="custom-control-input" value="<?php echo $gr->id ?>" id="<?php echo 'group-'.$gr->id ?>"> <label class="custom-control-label" for="<?php echo 'group-'.$gr->id ?>"><?php echo $gr->nama ?></label>
                                                                        </div>
                                                                    </div>
                                                                    <?php if($no % 3 == 0)
                                                                        echo "</div><div class='row'>";
                                                                
                                                                $no++; }
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>

                                                </form>
                                            </div>
                                        </div>

                                        <div id='ResponseInput'></div>