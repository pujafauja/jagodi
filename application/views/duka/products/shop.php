<main>
    <!-- breadcrumb__area-start -->
    <!-- <section class="breadcrumb__area box-plr-75">
        <div class="container">
            <div class="row">
                <div class="col-xxl-12">
                    <div class="breadcrumb__wrapper">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                              <li class="breadcrumb-item active" aria-current="page">Shop</li>
                            </ol>
                          </nav>
                    </div>
                </div>
            </div>
        </div>
    </section> -->
    <!-- breadcrumb__area-end -->

    <!-- shop-area-start -->
    <div class="shop-area mb-20 mt-20">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-4">
                    <div class="product-widget mb-30">
                        <h5 class="pt-title">Kategori</h5>
                        <div class="widget-category-list mt-20">
                            <form action="#">
                                <?php foreach($this->data['categories']->result() as $cat): ?>
                                <div class="single-widget-category">
                                    <input type="checkbox" id="cat-item-<?php echo $cat->id ?>" name="cat-item" <?php echo in_array($cat->id, $kategoriid) || $cat->id == decode($_GET['kategori']) ? 'checked=""' : '' ?> value="<?php echo encode($cat->id) ?>">
                                    <label for="cat-item-<?php echo $cat->id ?>"><?php echo $cat->nama ?> <!-- <span>(12)</span> --></label>
                                </div>
                                <?php endforeach; ?>
                            </form>
                        </div>
                    </div>
                    <div class="product-widget mb-30">
                        <h5 class="pt-title">Pilih Ukuran</h5>
                        <div class="widget-category-list mt-20">
                            <form action="#">
                                <div class="single-widget-category">
                                    <input type="checkbox" id="choose-item-1" name="choose-item" value="S">
                                    <label for="choose-item-1">S <!-- <span>(12)</span> --></label>
                                </div>
                                <div class="single-widget-category">
                                    <input type="checkbox" id="choose-item-2" name="choose-item" value="L">
                                    <label for="choose-item-2">L <!-- <span>(60)</span> --></label>
                                </div>
                                <div class="single-widget-category">
                                    <input type="checkbox" id="choose-item-3" name="choose-item" value="M">
                                    <label for="choose-item-3">M <!-- <span>(41)</span> --></label>
                                </div>
                                <div class="single-widget-category">
                                    <input type="checkbox" id="choose-item-4" name="choose-item" value="XXL">
                                    <label for="choose-item-4">XXL <!-- <span>(28)</span> --></label>
                                </div>
                                <div class="single-widget-category">
                                    <input type="checkbox" id="choose-item-5" name="choose-item" value="2XL">
                                    <label for="choose-item-5">2XL <!-- <span>(21)</span> --></label>
                                </div>
                                <div class="single-widget-category">
                                    <input type="checkbox" id="choose-item-7" name="choose-item" value="3XL">
                                    <label for="choose-item-7">3XL <!-- <span>(62)</span> --></label>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-xl-9 col-lg-8">
                    <div class="product-lists-top">
                        <div class="product__filter-wrap">
                            <div class="row align-items-center">
                                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6">
                                    <div class="product__filter d-sm-flex align-items-center">
                                        <div class="product__col">
                                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                                <li class="nav-item" role="presentation">
                                                  <button class="nav-link active" id="FourCol-tab" data-bs-toggle="tab" data-bs-target="#FourCol" type="button" role="tab" aria-controls="FourCol" aria-selected="true">
                                                    <i class="fal fa-th"></i>
                                                  </button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                  <button class="nav-link" id="FiveCol-tab" data-bs-toggle="tab" data-bs-target="#FiveCol" type="button" role="tab" aria-controls="FiveCol" aria-selected="false">
                                                    <i class="fal fa-list"></i>
                                                  </button>
                                                </li>
                                              </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6">
                                    <div class="product__filter-right d-flex align-items-center justify-content-md-end">
                                        <div class="product__sorting product__show-no">
                                            <select id="perPage">
                                                <option value="10">10</option>
                                                <option value="20" selected="">20</option>
                                                <option value="30">30</option>
                                                <option value="40">40</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-content" id="productGridTabContent">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- shop-area-end -->

</main>