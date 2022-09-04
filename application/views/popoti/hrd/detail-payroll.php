<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <?php if ($salary): ?> 
                        <table class="text-center table table-borderless">
                            <thead>
                                <tr class="border-bottom">
                                    <th style="vertical-align: middle;" class="boder " rowspan="2">Name</th>
                                    <th style="vertical-align: middle;" class="boder " rowspan="2">Position</th>
                                    <th style="vertical-align: middle;" class="boder border-right" rowspan="2">Attendance</th>
                                    <th class="text-center border-right"  colspan="5">Salary Parameters</th>
                                    <th class="text-center border-right" colspan="5">Calculate Pay</th>
                                    <th style="vertical-align: middle;text-align: center;" rowspan="2">Print</th>
                                </tr>
                                <tr class="border-bottom">
                                    <th style="vertical-align: middle;" >Basic Salary</th>
                                    <th style="vertical-align: middle;" >Meal Allowance</th>
                                    <th style="vertical-align: middle;" >Allowance</th>
                                    <th style="vertical-align: middle;" >Transportation</th>
                                    <th style="vertical-align: middle;"  class="border-right">Another</th>
                                    <th style="vertical-align: middle;" >Gross Salary</th>

                                    <th style="vertical-align: middle;" >Heath BPJS</th>
                                    <th style="vertical-align: middle;" >Employment BPJS</th>
                                    <th style="vertical-align: middle;" >Potongan</th>
                                    <th style="vertical-align: middle;"  class="border-right">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $kotor = 0; $bersih = 0; foreach ($salary['rows'] as $key => $value): ?>
                                    <tr>
                                        <?php $kotor += $value->gaji_bruto; $bersih += $value->subtotal ?>
                                        <input type="hidden" class="id" name="id[]" value="<?php echo $value->id ?>">
                                        <input type="hidden" class="subtotal" name="subtotal[]" value="<?php echo $value->subtotal ?>">
                                        <td><?php echo $value->employee ?></td>
                                        <td><?php echo $value->position ?></td>
                                        <td class="border-right"><?php echo $value->hadir ?></td>
                                        <td><?php echo 'Rp. '.rupiah($value->pokok) ?></td>
                                        <td><?php echo 'Rp. '.rupiah($value->makan) ?></td>
                                        <td><?php echo 'Rp. '.rupiah($value->transport) ?></td>
                                        <td><?php echo 'Rp. '.rupiah($value->tunjangan) ?></td>
                                        <td class="border-right"><?php echo 'Rp. '.rupiah($value->another) ?></td>
                                        <td><?php echo 'Rp. '.rupiah($value->gaji_bruto) ?></td>

                                        <td><?php echo 'Rp. '.rupiah($value->kes_karyawan) ?></td>

                                        <td><?php echo 'Rp. '.rupiah($value->naker_karyawan) ?></td>

                                        <td><?php echo 'Rp. '.rupiah($value->amount) ?></td>
                                        <td class="border-right"><?php echo 'Rp. '.rupiah($value->subtotal) ?></td>
                                        <th>
                                            <a href="<?php echo base_url() ?>hrd/print_gaji/<?php echo encode($value->id) ?>" id="print-pay" class="btn btn-success"><i class="fa fa-print mr-1"></i>Pay Slip</a>
                                        </th>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    <?php endif ?>
                </div>
                <div class="row mt-3">
                    <div class="col-8">
                        <?php if ($salary): ?>
                            <table cellpadding="5">
                                <tr>
                                    <th class="text-right" colspan="12">Total Biaya Gaji</th>
                                    <td></td>
                                    <th>Rp. <?php echo rupiah($kotor) ?></th>                       
                                </tr>
                                <tr>
                                    <th class="text-right" colspan="12">Total Gaji Setelah Potongan</th>
                                    <td></td>
                                    <th>Rp. <?php echo rupiah($bersih) ?></th>                      
                                </tr>
                            </table>
                        <?php endif ?>
                    </div>
                    <div class="col-4 text-right">
                        <a href="<?php echo base_url() ?>hrd/payroll" class="btn btn-primary"><i class="fa fa-arrow-circle-left mr-2"></i> Back</a>
                        <a href="<?php echo base_url() ?>hrd/print-all/<?php echo $month ?>" id="print-all" class="btn btn-success"><i class="fa fa-print mr-2"></i> Print All</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

