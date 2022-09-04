<!--====== Breadcrumb part Start ======-->
<!-- <div class="breadcrumb-section bg-img-c" style="background-image: url(assets/img/breadcrumb.jpg);">
    <div class="container">
        <div class="breadcrumb-text">
            <h1 class="page-title">Blog Grid</h1>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li>Blog</li>
            </ul>
        </div>
    </div>
    <div class="breadcrumb-shapes">
        <div class="one"></div>
        <div class="two"></div>
        <div class="three"></div>
    </div>
</div> -->
<!--====== Breadcrumb part End ======-->

<?php
if($this->uri->segment(2) == 'category'): ?>
<input type="hidden" name="additional-filter" value="<?php echo htmlspecialchars('and JSON_CONTAINS(JSON_EXTRACT(categories, \'$**.id\'), \'["'.decode($this->uri->segment(3)).'"]\')') ?>">
<?php elseif($this->uri->segment(2) == 'search'): ?>
<input type="hidden" name="additional-filter" value="<?php echo htmlspecialchars('and (title LIKE \'%'.$_GET['q'].'%\' OR judul LIKE \'%'.$_GET['q'].'%\')') ?>">
<?php elseif($this->uri->segment(2) == 'search'): ?>
<input type="hidden" name="additional-filter" value="<?php echo htmlspecialchars('and (tags LIKE \'%'.$this->uri->segment(3).'%\')') ?>">
<?php endif; ?>

<!--====== Blog Section Start ======-->
<section class="blog-section grey-bg py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8" id="article-content">
                
            </div>
            <div class="col-lg-4 col-md-8">
                <!-- sidebar -->
                <div class="sidebar">
                    <!-- Search Widget -->
                    <div class="widget search-widget">
                        <form action="<?php echo base_url('article/search') ?>">
                            <input type="text" placeholder="Search here" name="q" value="<?php echo $_GET['q'] ? $_GET['q'] : ''?>">
                            <button type="submit"><i class="far fa-search"></i></button>
                        </form>
                    </div>
                    <!-- Cat Widget -->
                    <div class="widget cat-widget">
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
                    <div class="widget recent-post-widget">
                        <h4 class="widget-title">Recent Articles</h4>

                        <div class="post-loops">
                            <?php if($recents->num_rows() > 0): 
                                foreach($recents->result() as $recent): 
                                    $judul = $this->lang->line('judularticle')
                                ?>
                            <div class="single-post">
                                <div class="post-thumb">
                                    <img src="<?php echo base_url('media/article/'.$recent->gambar) ?>" alt="<?php echo $recent->$judul ?>">
                                </div>
                                <div class="post-desc">
                                    <span class="date"><i class="far fa-calendar-alt"></i><?php echo tgl($recent->created_at) ?></span>
                                    <a href="<?php echo base_url(create_slug($recent->$judul)) ?>">
                                        <?php echo $recent->$judul ?>
                                    </a>
                                </div>
                            </div>
                            <?php endforeach; endif; ?>
                        </div>
                    </div>
                    <!-- Popular Tag Widget -->
                    <!-- <div class="widget popular-tag-widget">
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
</section>
<!--====== Blog Section End ======-->