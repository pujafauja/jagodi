<div class="row">
    <div class="col-lg-12">

        <form action="<?php echo base_url('sparepart/new-abc-category/'.encode($abc->id)) ?>" method="post" class="tambah-abc">

            <div class="form-group">
                <label for="">Code <span class="text-danger">*</span></label>
                <input type="text" id="" name="code" class="form-control" value="<?php echo $abc->code ?>">
            </div>
            <div class="form-group">
                <label for="">Logical Operator <span class="text-danger">*</span></label>
                <select name="logical" id="" class="form-control">
                	<option value="">- Empty -</option>
                	<option value=">" <?php echo ($abc->logical == '>') ? 'selected=""' : '' ?>>></option>
                	<option value=">=" <?php echo ($abc->logical == '>=') ? 'selected=""' : '' ?>>>=</option>
                	<option value="<" <?php echo ($abc->logical == '<') ? 'selected=""' : '' ?>><</option>
                	<option value="<=" <?php echo ($abc->logical == '<=') ? 'selected=""' : '' ?>><=</option>
                </select>
            </div>
            <div class="form-group">
                <label for="">Total weeks <span class="text-danger">*</span></label>
                <input type="text" id="" name="weeks" class="form-control" value="<?php echo $abc->weeks ?>">
            </div>
            <div class="form-group">
                <label for="">QTY <span class="text-danger">*</span></label>
                <input type="text" id="" name="amount" class="form-control" value="<?php echo $abc->amount ?>">
            </div>
            <div class="form-group">
                <label for="">Lower Stock <span class="text-danger">*</span></label>
                <input type="text" id="" name="lower" class="form-control" value="<?php echo $abc->lower ?>">
            </div>
            <div class="form-group">
                <label for="">Upper Stock <span class="text-danger">*</span></label>
                <input type="text" id="" name="upper" class="form-control" value="<?php echo $abc->upper ?>">
            </div>
            <div class="form-group">
                <label for="">ROQ Month <span class="text-danger">*</span></label>
                <div class="input-group">
                    <input type="text" id="" name="roq" class="form-control autonumber" data-a-sep="." data-a-dec="," data-m-dec="2" data-v-min="0" data-v-max="100" value="<?php echo $abc->roq ?>">
                    <div class="input-group-append">
                        <span class="input-group-text">%</span>
                    </div>
                </div>
            </div>

        </form>
    </div>
</div>

<div id='ResponseInput'></div>

<script src="<?php echo base_url() ?>assets/js/vendor.min.js"></script>
<script src="<?php echo base_url('assets/libs/autonumeric/autoNumeric-min.js') ?>"></script>

<script src="<?php echo base_url('assets/js/pages/form-masks.init.js') ?>"></script>