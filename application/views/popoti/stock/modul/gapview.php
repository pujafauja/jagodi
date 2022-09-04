<form action="<?php echo base_url('stock/addgap') ?>" method="post" id="form-gap">
    <table id="actual-editable" class="table table-centered mb-0" id="picking-editable">
        <thead>
            <tr>
                <th>No</th>
                <th>Sparepart</th>
                <th>Het</th>
                <th>Current Stock</th>
                <th>Actual Stock</th>
                <th>Margin</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php if($data->num_rows() > 0): ?>
                <?php $no = 1;$total = 0 ; foreach($data->result() as $it): ?>
                    <tr>
                        <td><?php echo $no ?></td>
                        <td><?php echo $it->sparepart ?></td>
                        <td>Rp. <?php echo $it->het ?></td>
                        <td><?php echo $it->qty ?></td>
                        <td><?php echo $it->actualQty ?></td>
                        <td><?php echo $it->margin ?></td>
                        <td><?php echo 'Rp. '.rupiah($it->subtotal) ?></td>
                    </tr>
                    <?php $total += $it->subtotal ?>
                <?php $no++; endforeach; ?>
            <?php endif; ?>
        </tbody>
        <input type="hidden" name="actualid" value="<?php echo $id ?>">
        <input type="hidden" name="tanggal" value="<?php echo $tanggal ?>">
        <input type="hidden" name="total" value="<?php echo $total ?>">
        <tfoot>
            <tr>
                <td colspan="4"></td>
                <td colspan="2">Total</td>
                <td>Rp. <?php echo rupiah($total) ?></td>
            </tr>
            <tr>
                <td colspan="4"></td>
                <td>COA</td>
                <td colspan="2">
                    <select class="form-control" name="coa" id="">
                        <option value="1">COA</option>
                    </select>
                </td>
            </tr>
        </tfoot>
    </table>    
</form>
<div class="row mt-2">
    <div class="col">
        <div id="ResponseInput"></div>
    </div>
</div>
