                                        <div class="row">
                                            <div class="col-lg-12">

                                                <form action="<?php echo site_url('finance/tambah-limit/'.$limit->mod.'/'.encode($limit->id)) ?>" method="post" class="tambah-limit">

                                                    <div class="form-group">
                                                        <label for="simpleinput">Account <span class="text-danger">*</span></label>
                                                        <select class="form-control" name="coaid">
                                                            <option value="0">-- Choose One --</option>
                                                            <?php
                                                            if($coa->num_rows() > 0)
                                                            {
                                                                foreach($coa->result() as $s)
                                                                { ?>
                                                                    <option value="<?php echo $s->id ?>" <?php echo ($s->id == $limit->coaid) ? 'selected=""' : '' ?>>[<?php echo $s->kode ?>] <?php echo $s->nama ?></option>
                                                                <?php }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="simpleinput">Periode <span class="text-danger">*</span></label>
                                                        <select class="form-control" name="periode">
                                                            <option value="">-- Choose One --</option>
                                                            <option value="hari" <?php echo ($limit->periode == 'hari') ? 'selected=""' : '' ?>>HARI</option>
                                                            <option value="minggu" <?php echo ($limit->periode == 'minggu') ? 'selected=""' : '' ?>>MINGGU</option>
                                                            <option value="bulan" <?php echo ($limit->periode == 'bulan') ? 'selected=""' : '' ?>>BULAN</option>
                                                            <option value="tahun" <?php echo ($limit->periode == 'tahun') ? 'selected=""' : '' ?>>TAHUN</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="simpleinput">Type <span class="text-danger">*</span></label>
                                                        <select class="form-control" name="type">
                                                            <option value="">-- Choose One --</option>
                                                            <option value="==" <?php echo ($limit->type == '==') ? 'selected=""' : '' ?>>=</option>
                                                            <option value="<" <?php echo ($limit->type == '<') ? 'selected=""' : '' ?>><</option>
                                                            <option value="<=" <?php echo ($limit->type == '<=') ? 'selected=""' : '' ?>><=</option>
                                                            <option value=">" <?php echo ($limit->type == '>') ? 'selected=""' : '' ?>>></option>
                                                            <option value=">=" <?php echo ($limit->type == '>=') ? 'selected=""' : '' ?>>>=</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="simpleinput">Nominal Limit <span class="text-danger">*</span></label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">Rp.</span>
                                                            </div>
                                                            <input type="text" name="limit" class="form-control autonumber" data-a-sep="." data-a-dec="," value="<?php echo $limit->limit ?>">
                                                        </div>
                                                    </div>

                                                </form>
                                            </div>
                                        </div>

                                        <div id='ResponseInput'></div>