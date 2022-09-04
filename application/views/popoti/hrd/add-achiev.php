        <div class="row">
            <div class="col-lg-12">

                <form action="<?php echo site_url('hrd/add_achiev/'.$id) ?>" method="post" id="form-achievment">

                    <div class="form-group">
                        <label for="achiev">Achievment Nominal <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="text" id="achiev" name="nama" class="form-control" value="<?php echo $achiev->nominal ?>">
                            <div class="input-group-addon">
                                <div class="input-group-text">%</div>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>

        <div id='ResponseInput'></div>