<?php if (!$salary): ?>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label for=""> Month </label>
                                <div class="input-group">
                                    <input type="text" name="month" id="search-by-month" class="form-control" data-provide="datepicker" data-date-format="yyyy-mm" data-date-min-view-mode="1" />
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
<?php endif ?>

<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <?php if ($salary): ?> 
                <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th valign="center" rowspan="2">Name</th>
                                    <th valign="center" rowspan="2">Position</th>
                                    <th valign="center" rowspan="2">Attendance</th>
                                    <th colspan="5">Calculate Primary Fee</th>
                                    <th colspan="4">Health BPJS</th>
                                    <th colspan="4">Employment BPJS</th>
                                    <th colspan="2">Another Piece</th>
                                    <th valign="center" rowspan="2">Subtotal</th>
                                </tr>
                                <tr>
                                    <th>Basic Salary</th>
                                    <th>Meal Allowance</th>
                                    <th>Allowance</th>
                                    <th>Another</th>
                                    <th>Gross Salary</th>

                                    <th>Employee</th>
                                    <th>Company</th>
                                    <th>Total</th>
                                    <th>%</th>

                                    <th>Employee</th>
                                    <th>Company</th>
                                    <th>Total</th>
                                    <th>%</th>

                                    <th>Account</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($salary['rows'] as $key => $value): ?>
                                    <tr>
                                        <input type="hidden" class="id" name="id[]" value="<?php echo $value->id ?>">
                                        <input type="hidden" class="subtotal" name="subtotal[]" value="<?php echo $value->subtotal ?>">
                                        <td><?php echo $value->employee ?></td>
                                        <td><?php echo $value->position ?></td>
                                        <td><?php echo $value->hadir ?></td>

                                        <td><?php echo 'Rp. '.rupiah($value->pokok, 2) ?></td>
                                        <td><?php echo 'Rp. '.rupiah($value->makan, 2) ?></td>
                                        <td><?php echo 'Rp. '.rupiah($value->tunjangan, 2) ?></td>
                                        <td><?php echo 'Rp. '.rupiah($value->another, 2) ?></td>
                                        <td><?php echo 'Rp. '.rupiah($value->gaji_bruto, 2) ?></td>

                                        <td><?php echo 'Rp. '.rupiah($value->kes_karyawan, 2) ?></td>
                                        <td><?php echo 'Rp. '.rupiah($value->kes_perusahaan, 2) ?></td>
                                        <td><?php echo 'Rp. '.rupiah($value->kes_total, 2) ?></td>
                                        <td><?php echo $value->kes_persen ?>%</td>

                                        <td><?php echo 'Rp. '.rupiah($value->naker_karyawan, 2) ?></td>
                                        <td><?php echo 'Rp. '.rupiah($value->naker_perusahaan, 2) ?></td>
                                        <td><?php echo 'Rp. '.rupiah($value->naker_total, 2) ?></td>
                                        <td><?php echo $value->naker_persen ?>%</td>

                                        <td><?php echo $value->coaid ?></td>
                                        <td><?php echo 'Rp. '.rupiah($value->amount, 2) ?></td>
                                        <td><?php echo 'Rp. '.rupiah($value->subtotal, 2) ?></td>

                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                </div>
                <div class="row mt-3">
                    <div class="col-8">
                        <?php if ($salary): ?>
                            <b>Total Payment : Rp. <?php echo rupiah($salary['total'], 2) ?></b>
                        <?php endif ?>
                    </div>
                    <div class="col-4 text-right">
                        <?php if ($salary): ?>
                            <input type="hidden" name="total" value="<?php echo $salary['total'] ?>">
                            <button class="btn btn-success d-inline" id="btn-pay"><i class="fa fa-check mr-2"></i>Pay</button>
                        <?php endif ?>
                    </div>
                </div>
                <?php else: ?>
                    <table class="table dt-responsive nowrap w-100" id="payroll-datatable">
                        <thead>
                            <tr>
                                <th>Month</th>
                                <th>Total Salary</th>
                                <th class="no-short">Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                <?php endif ?>
            </div>
        </div>
    </div>
</div>



