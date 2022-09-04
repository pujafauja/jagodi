                                        <div class="row">
                                            <div class="col-lg-12">

                                                <form action="<?php echo site_url('customer/tambah-unit/'.encode($unit->id)) ?>" method="post" class="tambah-unit">

                                                    <div class="form-group">
                                                        <label for="simpleinput">Unit Name <span class="text-danger">*</span></label>
                                                        <input unit="text" id="simpleinput" name="nama" class="form-control" value="<?php echo $unit->nama ?>">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="simpleinput">Merk <span class="text-danger">*</span></label>
                                                        <select class="form-control" name="merkid">
                                                            <?php
                                                            if($merk->num_rows() > 0)
                                                            {
                                                                foreach($merk->result() as $m)
                                                                {
                                                                    ?>
                                                                    <option value="<?php echo $m->id ?>" <?php echo ( $m->id == $unit->merkid ) ? 'selected=""' : '' ?>><?php echo $m->nama ?></option>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="simpleinput">Jenis <span class="text-danger">*</span></label>
                                                        <select class="form-control" name="typeid">
                                                            <?php
                                                            if($jenis->num_rows() > 0)
                                                            {
                                                                foreach($jenis->result() as $t)
                                                                {
                                                                    ?>
                                                                    <option value="<?php echo $t->id ?>" <?php echo ( $t->id == $unit->typeid ) ? 'selected=""' : '' ?>><?php echo $t->nama ?></option>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="simpleinput">Category</label>
                                                        <select class="form-control" name="warnaid">
                                                            <?php
                                                            if($warna->num_rows() > 0)
                                                            {
                                                                foreach($warna->result() as $c)
                                                                {
                                                                    ?>
                                                                    <option value="<?php echo $c->id ?>" <?php echo ( $c->id == $unit->warnaid ) ? 'selected=""' : '' ?>><?php echo $c->nama ?></option>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>

                                                </form>
                                            </div>
                                        </div>

                                        <div id='ResponseInput'></div>