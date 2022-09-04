<?php if($articles['query']->num_rows() > 0): ?>
<ul class="message-list">
    <?php foreach($articles['query']->result() as $article): ?>
    <li class="">
        <div class="col-mail col-mail-1">
            <a href="<?php echo base_url('articles/post-article/'.encode($article->id)) ?>" class="title">
                <h5>
                    <span data-target="<?php echo base_url('articles/delete/'.encode($article->id)) ?>" class="hapus-article"><i class="fas fa-trash mr-2 text-danger"></i></span><?php echo $article->title ?><br>
                    <small class="text-muted"><?php echo $article->judul ?></small>
                </h5>
            </a>
        </div>
        <div class="col-mail col-mail-2">
            <a href="<?php echo base_url('articles/post-article/'.encode($article->id)) ?>" class="subject"><?php echo strip_tags($article->content) ?></a>
            <div class="date"><?php echo tgl($article->created_at) ?></div>
        </div>
    </li>
    <?php endforeach; ?>
</ul>
<?php endif; ?>

<div class="row">
    <div class="col-7 mt-1">
        Showing <?php echo $start ?> - <?php echo $start ?> of <?php echo $articles['totalData'] ?>
    </div> <!-- end col-->
    <div class="col-5">
        <div class="btn-group float-right">
            <button type="button" class="btn btn-light btn-sm"><i class="mdi mdi-chevron-left"></i></button>
            <button type="button" class="btn btn-info btn-sm"><i class="mdi mdi-chevron-right"></i></button>
        </div>
    </div> <!-- end col-->
</div>
<!-- end row-->