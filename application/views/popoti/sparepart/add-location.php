                                        <div class="row">
                                            <div class="col-lg-12">

                                                <form action="<?php echo site_url('sparepart/tambah-location/'.encode($location->id)) ?>" method="post" class="tambah-location">

                                                    <div class="form-group">
                                                        <label for="simpleinput">Location Name <span class="text-danger">*</span></label>
                                                        <input type="text" id="simpleinput" name="nama" class="form-control" value="<?php echo $location->nama ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="simpleinput">Parent <span class="text-danger">*</span></label>
                                                        <select class="form-control" name="parentid">
                                                            <option value="0">No Parent</option>
                                                            <?php
                                                            if($parent->num_rows() > 0)
                                                            {
                                                                foreach($parent->result() as $p)
                                                                { ?>
                                                                    <option value="<?php echo $p->id ?>" <?php echo ($location->parentid == $p->id) ? 'selected=""' : ''; ?>><?php echo $p->nama ?></option>
                                                                <?php }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="simpleinput">Max. QTY <span class="text-danger">*</span></label>
                                                        <input type="text" id="simpleinput" name="max" class="form-control" value="<?php echo $location->max ?>">
                                                    </div>

                                                </form>
                                            </div>
                                        </div>

                                        <div id='ResponseInput'></div>