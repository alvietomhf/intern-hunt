@extends('layouts.app2')

@section('content-header')
<div class="content-header-left col-md-9 col-12 mb-2">
  <div class="row breadcrumbs-top">
      <div class="col-12">
          <h2 class="content-header-title float-left mb-0">Lowongan</h2>
      </div>
  </div>
</div>
@endsection

@section('content')
<section id="wishlist" class="grid-view wishlist-items">

  <div class="card ecommerce-card">
      <div class="card-content">
          <div class="item-img text-center">
              <a href="app-ecommerce-details.html">
                  <img src="../../../assets/images/pages/eCommerce/1.png" class="img-fluid" alt="img-placeholder">
              </a>
          </div>
          <div class="card-body">
              <div class="item-wrapper">
                  <div class="item-rating">
                      <div class="badge badge-primary badge-md">
                          4 <i class="feather icon-star ml-25"></i>
                      </div>
                  </div>
                  <div>
                      <h6 class="item-price">
                          $19.99
                      </h6>
                  </div>
              </div>
              <div class="item-name">
                  <a href="app-ecommerce-details.html">
                      Sony - ZX Series On-Ear Headphones - Black
                  </a>
              </div>
              <div>
                  <p class="item-description">
                      These Sony ZX Series MDRZX110/BLK headphones feature neodymium magnets and 30mm drivers for powerful,
                      reinforced sound. Enjoy your favorite songs with lush bass response thanks to the Acoustic Bass Booster
                      technology.
                  </p>
              </div>
          </div>
          <div class="item-options text-center">
              <div class="wishlist remove-wishlist">
                  <i class="feather icon-x align-middle"></i> Remove
              </div>
              <div class="cart move-cart">
                  <i class="feather icon-shopping-cart"></i> <span class="add-to-cart">Move to cart</span>
              </div>
          </div>
      </div>
  </div>

</section>
@endsection