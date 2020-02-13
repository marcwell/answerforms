<?php
ini_set('session.cookie_domain', str_replace('www.','',$_SERVER['SERVER_NAME']));
require_once("cart.php");
session_start();
if(!session_is_registered("cart")) {

	$cart=new Cart();

	$_SESSION["cart"]=$cart;

}
?>
<!doctype html>
<html lang="en-us">

  <head>
  <title>
<?=($title)?$title:"AnswerForms.Com"?>
</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,700|Oswald:400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Muli|Open+Sans|Open+Sans+Condensed:300&display=swap" rel="stylesheet"> 

    <link rel="stylesheet" href="fonts/icomoon/style.css">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/jquery.fancybox.min.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">
    <link rel="stylesheet" href="css/aos.css">

    <!-- MAIN CSS -->
    <link rel="stylesheet" href="css/style.css">

  </head>

  <body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">


    <div id="overlayer"></div>
    <div class="loader">
      <div class="spinner-border text-primary" role="status">
        <span class="sr-only">Loading...</span>
      </div>
    </div>

    <div class="site-wrap" id="home-section">

      <div class="site-mobile-menu site-navbar-target">
        <div class="site-mobile-menu-header">
          <div class="site-mobile-menu-close mt-3">
            <span class="icon-close2 js-menu-toggle"></span>
          </div>
        </div>
        <div class="site-mobile-menu-body"></div>
      </div>


      <div class="top-bar">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <span class="mx-md-2 d-inline-block"></span>
              <a href="#" class=""><span class="mr-2  icon-phone"></span> <span class="d-none d-md-inline-block">Customer Service: (212) 382 0062</span></a>


              <div class="float-right">
<a href="shopping-cart.php" class=""><span class="d-none d-md-inline-block">View Cart</span></a>
                <span class="mx-md-2 d-inline-block"></span>
<a href="#" class=""><span class="d-none d-md-inline-block"><span id='no_items_in_cart'><?=$_SESSION["cart"]->no_items_in_cart()?></span> Items in Cart</span></a>
                <span class="mx-md-2 d-inline-block"></span>
<a href="payment.php" class=""><span class="d-none d-md-inline-block">Checkout</span></a>
                <span class="mx-md-2 d-inline-block"></span>

              </div>

            </div>

          </div>

        </div>
      </div>

      <header class="site-navbar js-sticky-header site-navbar-target" role="banner">

        <div class="container">
          <div class="row align-items-center position-relative">


            <div class="site-logo">
              <a href="index.php" class="text-black"><span class="text-primary"><img src="images/ANSWER(1).png" alt=""></a>
            </div>

            <div class="col-12">
              <nav class="site-navigation text-right ml-auto " role="navigation">

                <ul class="site-menu main-menu js-clone-nav ml-auto d-none d-lg-block">
                  <li><a href="index.php" class="nav-link">Home</a></li>
                  <li><a href="#services-section" class="nav-link">Services</a></li>
                  <li><a href="#faq-section" class="nav-link">FAQ</a></li>
                  <li><a href="#why-us-section" class="nav-link">Why Us</a></li>
                  <li><a href="blog.php" class="nav-link">Blog</a></li><li class="has-children">
                    <a href="#" class="nav-link">Forms</a>
                    <ul class="dropdown arrow-top">
                      <li><a href="divorce-complaints.php" class="nav-link">Divorce Complaints</a></li>
                      <li><a href="eviction-landlord-tenant-complaints.php" class="nav-link">Eviction / Landloard-Tenant Complaints</a></li>
                      <li><a href="debt-collection-complaints.php" class="nav-link">Debt Collection Complaints</a></li>
                      <li><a href="foreclosure-complaints.php" class="nav-link">Foreclosure Complaints</a></li>
                      <li><a href="personal-injury-negligence-complaints.php" class="nav-link">Personal Injury and Negligence Complaints</a></li>
                      <li><a href="breach-contract-complaints.php" class="nav-link">Breach of Contract Complaints</a></li>
                    </ul>
                  </li>
                  <li><a href="#contact-section" class="nav-link">Contact</a></li>
                </ul>
              </nav>

            </div>

            <div class="toggle-button d-inline-block d-lg-none"><a href="#" class="site-menu-toggle py-5 js-menu-toggle text-black"><span class="icon-menu h3"></span></a></div>

          </div>
        </div>

      </header>
      
      