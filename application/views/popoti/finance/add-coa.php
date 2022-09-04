                                        <div class="row">

                                            <div class="col-lg-12">



                                                <form action="<?php echo site_url('finance/tambah-coa/'.encode($coa->id).'/'.$issub) ?>" method="post" class="tambah-coa">



                                                    <div class="form-group">

                                                        <label for="simpleinput">Group Name <span class="text-danger">*</span></label>

                                                        <select class="form-control" name="groupid">

                                                            <option value="">-- Choose One --</option>

                                                            <?php

                                                            if($group->num_rows() > 0)

                                                            {

                                                                foreach($group->result() as $g)

                                                                {

                                                                    $selected = '';

                                                                    if($g->id == $coa->groupid)

                                                                        $selected = 'selected=""';



                                                                    echo '<option value="'.$g->id.'" '.$selected.'>'.$g->nama.'</option>';

                                                                }

                                                            }

                                                            ?>

                                                        </select>

                                                    </div>

                                                    <div class="form-group">

                                                        <label for="simpleinput">Sub Group</label>

                                                        <select class="form-control" name="parentid">
                                                            <option value="0">-- Choose One --</option>
                                                            <?php
                                                            if($sub->num_rows() > 0)
                                                            {
                                                                foreach($sub->result() as $s)
                                                                { ?>
                                                                    <option value="<?php echo $s->id ?>" <?php echo ($s->id == $coa->parentid) ? 'selected=""' : '' ?>>[<?php echo $s->kode ?>] <?php echo $s->nama ?></option>
                                                                <?php }
                                                            }
                                                            ?>
                                                        </select>

                                                    </div>

                                                    <div class="form-group">

                                                        <label for="simpleinput">Code <span class="text-danger">*</span></label>

                                                        <input type="text" id="simpleinput" name="kode" class="form-control currency" value="<?php echo $coa->kode ?>">

                                                    </div>

                                                    <div class="form-group">

                                                        <label for="simpleinput">Account Name <span class="text-danger">*</span></label>

                                                        <input type="text" id="simpleinput" name="nama" class="form-control" value="<?php echo $coa->nama ?>">

                                                    </div>

                                                    <?php if(! $issub) { ?>
                                                    <div class="mr-3">

                                                        <p class="text-center">Beginning Balance</p>

                                                    </div>

                                                    <div class="form-group row">

                                                        <div class="col-md-6">

                                                            <label>Debit</label>

                                                            <div class="input-group">

                                                                <div class="input-group-prepend">

                                                                    <span class="input-group-text">Rp.</span>

                                                                </div>

                                                                <input type="text" name="dr_awal" class="form-control" value="<?php echo $coa->dr_awal ?>">

                                                            </div>

                                                        </div>

                                                        <div class="col-md-6">

                                                            <label>Credit</label>

                                                            <div class="input-group">

                                                                <div class="input-group-prepend">

                                                                    <span class="input-group-text">Rp.</span>

                                                                </div>

                                                                <input type="text" name="cr_awal" class="form-control" value="<?php echo $coa->cr_awal ?>">

                                                            </div>

                                                        </div>

                                                    </div>
                                                    <?php } ?>



                                                </form>

                                            </div>

                                        </div>



                                        <div id='ResponseInput'></div>