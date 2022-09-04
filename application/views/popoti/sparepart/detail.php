<div class="row">
	<div class="col">
		<table class="table">
			<tr>
				<th>Kode</th>
				<td>:</td>
				<td><?php echo $row->kode ?></td>
			</tr>
			<tr>
				<th>Nama</th>
				<td>:</td>
				<td><?php echo $row->nama ?></td>
			</tr>
			<tr>
				<th>Category</th>
				<td>:</td>
				<td><?php echo $row->category ?></td>
			</tr>
			<tr>
				<th>Merk</th>
				<td>:</td>
				<td><?php echo $row->merk ?></td>
			</tr>
			<tr>
				<th>HPP Lama</th>
				<td>:</td>
				<td><?php echo rupiah($row->harga) ?></td>
			</tr>
			<tr>
				<th>HPP Baru</th>
				<td>:</td>
				<td><?php echo rupiah($row->hpp_baru) ?></td>
			</tr>
			<tr>
				<th>HPP Average</th>
				<td>:</td>
				<td><?php echo rupiah($row->hpp_average) ?></td>
			</tr>
			<tr>
				<th>HPP Average</th>
				<td>:</td>
				<td><?php echo rupiah($row->hpp_average) ?></td>
			</tr>
			<tr>
				<th>HET</th>
				<td>:</td>
				<td><?php echo rupiah($row->het) ?></td>
			</tr>
			<tr>
				<th>Margin</th>
				<td>:</td>
				<td><?php echo rupiah($row->margin) ?></td>
			</tr>
			<tr>
				<th>HET 1</th>
				<td>:</td>
				<td><?php echo rupiah($row->het1) ?></td>
			</tr>
			<tr>
				<th>Margin1</th>
				<td>:</td>
				<td><?php echo rupiah($row->margin1) ?></td>
			</tr>
			<tr>
				<th>HET 2</th>
				<td>:</td>
				<td><?php echo rupiah($row->het2) ?></td>
			</tr>
			<tr>
				<th>Margin 2</th>
				<td>:</td>
				<td><?php echo rupiah($row->margin2) ?></td>
			</tr>
			<tr>
				<th>HET 3</th>
				<td>:</td>
				<td><?php echo rupiah($row->het3) ?></td>
			</tr>
			<tr>
				<th>Margin 3</th>
				<td>:</td>
				<td><?php echo rupiah($row->margin3) ?></td>
			</tr>
			<tr>
				<th>Grosir</th>
				<td>:</td>
				<td><?php echo rupiah($row->grosir) ?></td>
			</tr>
			<tr>
				<th>Margin Grosir</th>
				<td>:</td>
				<td><?php echo rupiah($row->margin_grosir) ?></td>
			</tr>
			<tr>
				<th>Last Update</th>
				<td>:</td>
				<td><?php echo tgl($row->tanggal) ?></td>
			</tr>

		</table>
	</div>
</div>