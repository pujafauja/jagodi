                                        <div class="row">
                                            <div class="col-lg-12">

                                                <form action="<?php echo site_url('service/tambah-jasa/'.encode($jasa->id)) ?>" method="post" class="tambah-jasa">

                                                    <div class="form-group">
                                                        <label for="simpleinput">Nama Jasa <span class="text-danger">*</span></label>
                                                        <input type="text" id="simpleinput" name="nama" class="form-control" value="<?php echo $jasa->nama ?>">
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Group <span class="text-danger">*</span></label>
                                                        <select class="form-control" name="groupid">
                                                            <option value="">-- Choose One --</option>
                                                            <?php
                                                            if($group->num_rows() > 0)
                                                            {
                                                                foreach($group->result() as $gr)
                                                                {
                                                                    $selected = '';
                                                                    if($gr->id == $jasa->groupid)
                                                                        $selected = 'selected=""';

                                                                    echo '<option value="'.$gr->id.'" '.$selected.'>'.$gr->nama.'</option>';
                                                                }
                                                            }
                                                            ?>
                                                        </select>
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