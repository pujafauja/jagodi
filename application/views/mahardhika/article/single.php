<?php 
$judul = $this->lang->line('judularticle');
$content = $this->lang->line('contentarticle');
?>
<!--====== Blog Section Start ======-->
<section class="blog-section grey-bg pt-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <!-- Blog Details -->
                <div class="post-details-wrap">
                    <div class="post-thumb">
                        <img src="<?php echo base_url('media/article/'.$article->gambar) ?>" alt="Image">
                    </div>
                    <div class="post-meta">
                        <ul>
                            <li><i class="far fa-user"></i><?php echo $article->USE_NAMA ?></li>
                            <li><i class="far fa-calendar-alt"></i><a href="#"><?php echo tgl($article->created_at) ?></a></li>
                        </ul>
                    </div>
                    <div class="post-content bg-white px-4 py-4">
                        <h3 class="title">
                            <?php echo $article->$judul ?>
                        </h3>
                        <p>
                            <?php echo $article->$content ?>
                        </p>

                    </div>
                    <div class="post-footer d-md-flex align-items-md-center justify-content-md-between">
                        <div class="post-tag">
                            <ul>
                                <li class="title">Popular Tags :</li>
                                <?php
                                    $tags = json_decode($article->tags);
                                    foreach($tags as $tag):
                                ?>
                                <li><a href="<?php echo base_url('articles/tags/'.create_slug($tag)) ?>"><?php echo $tag ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Related Post -->
                <div class="related-post mt-4">
                    <h3 class="title">Related Post</h3>
                    <div class="latest-post-loop row ">
                        <?php if($related->num_rows() > 0):
                            foreach($related->result() as $rel): ?>
                        <div class="col-lg-6 col-md-6 col-10 col-tiny-12">
                            <div class="latest-post-box-two">
                                <div class="post-thumb-wrap">
                                    <div class="post-thumb bg-img-c"
                                        style="background-image: url(<?php echo base_url('media/article/'.$rel->gambar) ?>);">
                                    </div>
                                    <span class="post-date"><i class="far fa-calendar-alt"></i><?php echo tgl($rel->created_at) ?></span>
                                </div>
                                <div class="post-desc">
                                    <h3 class="title">
                                        <a href="<?php echo create_slug($rel->$judul) ?>">
                                            <?php echo $rel->$judul ?>
                                        </a>
                                    </h3>
                                    <a href="<?php echo create_slug($rel->$judul) ?>" class="post-link">
                                        Read More <i class="far fa-long-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; endif; ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-8">
                <!-- sidebar -->
                <div class="sidebar">
                    <!-- Search Widget -->
                    <div class="widget bg-white search-widget">
                        <form action="#">
                            <input type="text" placeholder="Search here">
                            <button type="submit"><i class="far fa-search"></i></button>
                        </form>
                    </div>
                    <!-- Cat Widget -->
                    <div class="widget bg-white cat-widget">
                        <h4 class="widget-title">Category</h4>

                        <ul>
                            <?php if($categories->num_rows() > 0):
                                foreach($categories->result() as $cat): ?>
                            <li>
                                <a href="<?php echo base_url('article/category/'.encode($cat->id)) ?>"><?php echo $cat->name ?> <span><i class="far fa-angle-right"></i></span></a>
                            </li>
                            <?php endforeach; endif; ?>
                        </ul>
                    </div>
                    <!-- Recent Post Widget -->
                    <div class="widget bg-white recent-post-widget">
                        <h4 class="widget-title">Recent Articles</h4>

                        <div class="post-loops">
                            <?php if($recents->num_rows() > 0): 
                                foreach($recents->result() as $recent): 
                                ?>
                            <div class="single-post">
                                <div class="post-thumb">
                                    <img src="<?php echo base_url('media/article/'.$recent->gambar) ?>" alt="<?php echo $recent->$judul ?>">
                                </div>
                                <div class="post-desc">
                                    <span class="date"><i class="far fa-calendar-alt"></i><?php echo tgl($recent->created_at) ?></span>
                                    <a href="<?php echo create_slug($recent->$judul) ?>">
                                        <?php echo $recent->$judul ?>
                                    </a>
                                </div>
                            </div>
                            <?php endforeach; endif; ?>
                        </div>
                    </div>
                    <!-- Popular Tag Widget -->
                    <!-- <div class="widget bg-white popular-tag-widget">
                        <h4 class="widget-title">Popular Tags</h4>
                        <div class="tags-loop">
                            <a href="#">Business</a>
                            <a href="#">Corporate</a>
                            <a href="#">HTML</a>
                            <a href="#">Finance</a>
                            <a href="#">Investment</a>
                            <a href="#">CSS</a>
                            <a href="#">Planing</a>
                            <a href="#">Creative</a>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</div>
