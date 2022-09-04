<div class="row">
	<div class="col">
		<div class="card-box">
			<div class="card-body">
				<table id="" class="table dt-responsive nowrap w-100 table-sm">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th class="no-sort">Location</th>
                            <th class="no-sort">Total Item</th>
                            <!-- <th class="no-sort">Action</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $no = 1;foreach($location as $loc): ?>
                                <tr>
                                    <td><?php echo $no ?></td>
                                    <td>
                                        <?php if (!$loc->has): ?>
                                            <a href="<?php echo base_url('stock/input-actual/'.encode($loc->id)) ?>"><?php echo $loc->nama ?></a>
                                        <?php else: ?>
                                            <?php echo $loc->nama ?>
                                        <?php endif ?>
                                    </td>
                                    <td><?php echo rupiah($loc->totalItems) ?> Item(s) <?php echo ($loc->has) ? '<i class="fa fa-check text-success mh-2"></i>' : '<i class="text-danger fa fa-times mh-2"></i>' ?></td>
                                </tr>
                            <?php $no++; endforeach;
                        ?>
                    </tbody>
                </table>
			</div>
		</div>
	</div>
</div>