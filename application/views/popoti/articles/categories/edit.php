<form action="<?php echo base_url('articles/save-category') ?>" method="post" id="edit-category">
    <div class="form-group">
        <input type="hidden" name="id" value="<?php echo $category->id ?>">
        <label for="">Category Name</label>
        <input type="text" name="name" class="form-control" value="<?php echo $category->name ?>">
    </div>
</form>