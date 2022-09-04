<!-- Blog loop(Grid) -->
<div class="blog-loop grid-blog row justify-content-center">
    <?php
    if ($articles['query']->num_rows() > 0): 
        foreach($articles['query']->result() as $article):
            $judul = $this->lang->line('judularticle');
            $content = $this->lang->line('contentarticle');
    ?>
    <!-- Single Post -->
    <div class="col-lg-6 col-md-6 col-10 col-tiny-12">
        <div class="single-post-box">
            <div class="post-thumb">
                <img src="<?php echo base_url('media/article/'.$article->gambar) ?>" alt="<?php echo $article->$judul ?>">
            </div>
            <div class="post-content bg-white">
                <span class="post-date"><i class="far fa-calendar-alt"></i><?php echo tgl($article->created_at) ?></span>
                <h3 class="title">
                    <a href="<?php echo base_url(create_slug($article->$judul)) ?>">
                        <?php echo $article->$judul ?>
                    </a>
                </h3>
                <p>
                    <?php echo html_cut($article->$content, 150) ?>
                </p>
                <a href="<?php echo base_url(create_slug($article->$judul)) ?>" class="post-link">
                    <?php echo $this->lang->line('read-more') ?> <i class="far fa-long-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
    <!-- Single Post -->
    <?php
    endforeach;
    endif;
    ?>
</div>

<?php 
$totPage = ceil($articles['totalData'] / $postPerPage);
?>

<!-- Pagination -->
<div class="pagination-wrap">
    <ul>
        <?php if($hlm > 1): ?>
        <li><a href="#article-content" class="handle-pagination" data-page="<?php echo $hlm - 1 ?>"><i class="far fa-angle-left"></i></a></li>
        <?php endif; ?>
        <?php for($p = 1; $p <= $totPage; $p++): ?>
            <li class="<?php echo $p == $hlm ? 'active' : '' ?>"><a href="#article-content" class="handle-pagination" data-page="<?php echo $p ?>"><?php echo $p ?></a></li>
        <?php endfor; ?>
        <?php if($hlm < $totPage): ?>
        <li><a href="#" class="handle-pagination" data-page="<?php echo $hlm + 1 ?>"><i class="far fa-angle-right"></i></a></li>
        <?php endif; ?>
    </ul>
</div>