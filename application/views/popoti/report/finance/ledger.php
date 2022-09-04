<div class="row">
	<div class="col-12">
		<div class="card-group">
			<div class="card">
				<div class="card-body">
					<div class="custom-dd dd" id="nestable_list_1">
                        <ol class="dd-list">
                        	<?php if($coa->num_rows()): ?>
                        		<?php foreach($coa->result() as $c): ?>
                        			<li class="dd-item" data-id="1">
                        			    <div class="dd-handle">
                        			        <?php echo $c->kode . ' ' . $c->nama ?>
                        			    </div>
                        			    <?php echo nestedCOA2(ordered_menu(json_decode($c->coa, true))) ?>
                        			</li>
                        		<?php endforeach; ?>
                        	<?php endif; ?>
                        </ol>
                    </div>
				</div>
			</div>
			<div class="card">
				<div class="card-body">
					
				</div>
			</div>
		</div>
	</div>
</div>