<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <?php if ($salary): ?> 
                        <table class="table text-center">
                            <thead>
                                <tr>
                                    <th style="vertical-align: middle;" valign="center" rowspan="2">Name</th>
                                    <th style="vertical-align: middle;" valign="center" rowspan="2">Position</th>
                                    <th colspan="6">Health BPJS</th>
                                    <th colspan="6">Employment BPJS</th>
                                </tr>
                                <tr>
                                    <th>Employee</th>
                                    <th>%</th>
                                    <th>Company</th>
                                    <th>%</th>
                                    <th>Total</th>
                                    <th>%</th>

                                    <th>Employee</th>
                                    <th>%</th>
                                    <th>Company</th>
                                    <th>%</th>
                                    <th>Total</th>
                                    <th>%</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php  
                                    $totalKesKaryawan = 0;
                                    $totalKesPerusahaan = 0;
                                    $totalNakerKaryawan = 0;
                                    $totalNakerPerusahaan = 0;
                                ?>
                                <?php foreach ($salary['rows'] as $key => $value): ?>
                                    <?php  
                                        $totalKesKaryawan += $value->kes_karyawan;
                                        $totalKesPerusahaan += $value->kes_perusahaan;
                                        $totalNakerKaryawan += $value->naker_karyawan;
                                        $totalNakerPerusahaan += $value->naker_perusahaan;
                                    ?>
                                    <tr>
                                        <td><?php echo $value->employee ?></td>
                                        <td><?php echo $value->position ?></td>

                                        <td><?php echo 'Rp. '.rupiah($value->kes_karyawan) ?></td>
                                        <td><?php echo ($value->kes_karyawan / $value->kes_total) * 100 ?>%</td>
                                        <td><?php echo 'Rp. '.rupiah($value->kes_perusahaan) ?></td>
                                        <td><?php echo ($value->kes_perusahaan / $value->kes_total) * 100 ?>%</td>
                                        <td><?php echo 'Rp. '.rupiah($value->kes_total) ?></td>
                                        <td><?php echo $value->kes_persen ?>%</td>

                                        <td><?php echo 'Rp. '.rupiah($value->naker_karyawan) ?></td>
                                        <td><?php echo ($value->naker_karyawan / $value->gaji_bruto) * 100 ?>%</td>
                                        <td><?php echo 'Rp. '.rupiah($value->naker_perusahaan) ?></td>
                                        <td><?php echo ($value->naker_perusahaan / $value->gaji_bruto) * 100 ?>%</td>
                                        <td><?php echo 'Rp. '.rupiah($value->naker_total) ?></td>
                                        <td><?php echo $value->naker_persen ?>%</td>


                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    <?php endif ?>
                </div>
                <div class="row mt-3">
                    <div class="col-8">
                        
                    </div>
                    <div class="col-4 text-right">
                        <a href="<?php echo base_url() ?>hrd/insurancemodul" class="btn btn-primary"><i class="fa fa-arrow-circle-left mr-2"></i> Back</a>
                        <a href="<?php echo base_url() ?>hrd/print-all/<?php echo $month ?>" id="print-all-bpjs" class="btn btn-success"><i class="fa fa-print mr-2"></i> Print All</a>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

