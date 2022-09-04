<!-- Right Sidebar -->
<input type="hidden" name="id" value="<?php echo encode($article->id) ?>" />
<div class="row">
    <div class="col-lg-10 col-md-8">
        <div class="card-group">
            <div class="card">
                <div class="card-body">
                    <h5 class="mb-3">English Version</h5>
                    <form action="" id="english-version">
                        <div class="form-group">
                            <label for="">Title</label>
                            <input type="text" name="title" class="form-control" value="<?php echo $article->title ?>" />
                        </div>
                        <div class="form-group">
                            <div class="article-content" id="contentEN"><?php echo $article->content ?></div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h5 class="mb-3">Versi Indonesia</h5>
                    <form action="" id="versi-indonesia">
                        <div class="form-group">
                            <label for="">Judul</label>
                            <input type="text" name="judul" class="form-control" value="<?php echo $article->judul ?>" />
                        </div>
                        <div class="form-group">
                            <div class="article-content" id="contentINA"><?php echo $article->isi ?></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-2 col-md-4">
        <div class="card">
            <div class="card-body">
                <h5>Article Picture</h5>
                <form action="/" method="post" id="myAwesomeDropzone" enctype="multipart/form-data">
                    <input name="gambar" type="file" data-plugins="dropify" data-height="150" <?php echo ($article->gambar) ? 'data-default-file="'.base_url('media/article/'.$article->gambar).'"' : '' ?> data-allowed-file-extensions="png jpg jpeg" data-max-file-size="3M" />
                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h5>Select Category</h5>
                <div id="selected-category" class="mb-3"></div>
                <div class="input-group">
                    <input type="text" name="" id="find-category"
                            class="form-control"
                            style=" z-index: 2; background: transparent;"/>
                    <input type="text" name="categories" id="categories" class="form-control" style="display: none;" value="<?php echo htmlspecialchars($article->categories) ?>" />
                    <div class="input-group-append">
                        <a class="btn btn-primary new-category" href="<?php echo base_url('articles/add-category')?>"><i class="fe-plus"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h5>Tags</h5>
                <?php
                $tags = array();
                foreach(json_decode($article->tags) as $tag):
                    $tags[] = $tag;
                endforeach;
                ?>
                <input type="text" name="tags" class="selectize-close-btn" value="<?php echo implode(',', $tags) ?>">
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <button class="btn btn-primary save-article col-12">Publish</button>
            </div>
        </div>
    </div>
</div><!-- End row -->