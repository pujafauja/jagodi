<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <label for=""> Month </label>
                            <div class="input-group">
                                <input type="text" name="month" id="getinsentifbymonth" class="form-control" data-provide="datepicker" data-date-format="yyyy-mm" data-date-min-view-mode="1" />
                                <div class="input-group-addon">
                                    <button id="refresh-payroll" class="btn btn-primary"><i class="fa fa-sync"></i></button>
                                </div>                                    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col">
        <div class="card-box">
            <!-- <div class="card-header">Intensive & Reward</div> -->
            <div class="card-body">
                <p></p>
                <?php 
                    $jumCat = count($category)
                 ?>
                <div class="table-responsive">
                    <table id="bonus" class="table w-100">
                    <thead>
                        <tr>
                            <th style="vertical-align: center" rowspan="2">Employee</th>
                            <th style="vertical-align: center" rowspan="2">Position</th>
                            <th colspan="<?php echo $jumCat ?>">Target To Achieved</th>
                            <th colspan="<?php echo $jumCat + 2 ?>">Achieved Target</th>
                            <th colspan="<?php echo $jumCat * 2 ?>">Incentive</th>
                        </tr>
                        <tr>
                            <?php $cols = 0; foreach ($category as $key => $value): ?>
                                <th><?php echo $value['nama']; $cols++ ?></th>
                            <?php endforeach ?>

                            <?php foreach ($category as $key => $value): ?>
                                <th><?php echo $value['nama']; $cols++ ?></th>
                                <th>%</th>
                            <?php endforeach ?>

                            <?php foreach ($category as $key => $value): ?>
                                <th><?php echo $value['nama']; $cols ++ ?></th>
                                <th>%</th>
                            <?php endforeach ?>

                        </tr>
                    </thead>
                    <tbody id="tb-insentif">
                        
                    </tbody>
                    <tfoot>
                        <tr>
                            <th class="text-right" colspan="<?php echo $cols ?>">Grand Total</th>
                            <th colspan="2" id="grandtotal"></th>
                            <input type="hidden" name="grandtotal">
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="row">
                <div class="col text-right">
                    <button id="confirm-insentif" class="btn btn-success" disabled=""><i class="fa fa-check mr-2"></i>Confirm</button>
                </div>
            </div>
        </div>
    </div>
</div>