<style type="text/css">
    body { padding-top: 50px; }

#myCarousel .carousel-caption {
    left:0;
	right:0;
	bottom:0;
	text-align:left;
	padding:10px;
	background:rgba(0,0,0,0.6);
	text-shadow:none;
}

#myCarousel .list-group {
	position:absolute;
	top:0;
	right:0;
}
#myCarousel .list-group-item {
	border-radius:0px;
	cursor:pointer;
}
#myCarousel .list-group .active {
	background-color:#eee;	
}

@media (min-width: 992px) { 
	#myCarousel {padding-right:33.3333%;}
	#myCarousel .carousel-controls {display:none;} 	
}
@media (max-width: 991px) { 
	.carousel-caption p,
	#myCarousel .list-group {display:none;} 
}
/* GLOBAL STYLES
-------------------------------------------------- */
/* Padding below the footer and lighter body text */

body {
  padding-top: 3rem;
  padding-bottom: 3rem;
  color: #5a5a5a;
}


/* CUSTOMIZE THE CAROUSEL
-------------------------------------------------- */

/* Carousel base class */
.carousel {
  margin-bottom: 4rem;
}
/* Since positioning the image, we need to help out the caption */
.carousel-caption {
  z-index: 10;
  bottom: 3rem;
}

/* Declare heights because of positioning of img element */
.carousel-item {
  height: 32rem;
  background-color: #777;
}
.carousel-item > img {
  position: absolute;
  top: 0;
  left: 0;
  min-width: 100%;
  height: 32rem;
}


/* MARKETING CONTENT
-------------------------------------------------- */

/* Center align the text within the three columns below the carousel */
.marketing .col-lg-4 {
  margin-bottom: 1.5rem;
  text-align: center;
}
.marketing h2 {
  font-weight: normal;
}
.marketing .col-lg-4 p {
  margin-right: .75rem;
  margin-left: .75rem;
}


/* Featurettes
------------------------- */

.featurette-divider {
  margin: 5rem 0; /* Space out the Bootstrap <hr> more */
}

/* Thin out the marketing headings */
.featurette-heading {
  font-weight: 300;
  line-height: 1;
  letter-spacing: -.05rem;
}


/* RESPONSIVE CSS
-------------------------------------------------- */

@media (min-width: 40em) {
  /* Bump up size of carousel content */
  .carousel-caption p {
    margin-bottom: 1.25rem;
    font-size: 1.25rem;
    line-height: 1.4;
  }

  .featurette-heading {
    font-size: 50px;
  }
}

@media (min-width: 62em) {
  .featurette-heading {
    margin-top: 7rem;
  }
}
</style>
<script>
    $(document).ready(function(){
    
	var clickEvent = false;
	$('#myCarousel').carousel({
		interval:   4000	
	}).on('click', '.list-group li', function() {
			clickEvent = true;
			$('.list-group li').removeClass('active');
			$(this).addClass('active');		
	}).on('slid.bs.carousel', function(e) {
		if(!clickEvent) {
			var count = $('.list-group').children().length -1;
			var current = $('.list-group li.active');
			current.removeClass('active').next().addClass('active');
			var id = parseInt(current.data('slide-to'));
			if(count == id) {
				$('.list-group li').first().addClass('active');	
			}
		}
		clickEvent = false;
	});
})

$(window).load(function() {
    var boxheight = $('#myCarousel .carousel-inner').innerHeight();
    var itemlength = $('#myCarousel .item').length;
    var triggerheight = Math.round(boxheight/itemlength+1);
	$('#myCarousel .list-group-item').outerHeight(triggerheight);
});
</script>
<div class="container">
    <h1><?php echo $this->config->item('hlavnistrana_nadpis');?></h1>
  
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
    
      <!-- Wrapper for slides -->
      <div class="carousel-inner">
      
        <div class="item active">
          <img src="<?php echo $this->config->item('hlavnistrana_carousel_img1');?>">
           <div class="carousel-caption">
            <h4><a href="<?php echo $this->config->item('hlavnistrana_carousel_odkaz1');?>"><?php echo $this->config->item('hlavnistrana_carousel_nadpis1');?></a></h4>
            <p><?php echo $this->config->item('hlavnistrana_carousel_text1');?></p>
          </div>
        </div><!-- End Item -->
 
         <div class="item">
          <img style="height:auto;width: auto;" src="<?php echo $this->config->item('hlavnistrana_carousel_img2');?>">
           <div class="carousel-caption">
            <h4><a href="<?php echo $this->config->item('hlavnistrana_carousel_odkaz2');?>"><?php echo $this->config->item('hlavnistrana_carousel_nadpis2');?></a></h4>
            <p><?php echo $this->config->item('hlavnistrana_carousel_text2');?></p>
          </div>
        </div><!-- End Item -->
        
        <div class="item">
          <img src="<?php echo $this->config->item('hlavnistrana_carousel_img3');?>">
           <div class="carousel-caption">
            <h4><a href="<?php echo $this->config->item('hlavnistrana_carousel_odkaz3');?>"><?php echo $this->config->item('hlavnistrana_carousel_nadpis3');?></a></h4>
            <p><?php echo $this->config->item('hlavnistrana_carousel_text3');?></p>
          </div>
        </div><!-- End Item -->
        
        <div class="item">
          <img src="<?php echo $this->config->item('hlavnistrana_carousel_img4');?>">
           <div class="carousel-caption">
            <h4><a href="<?php echo $this->config->item('hlavnistrana_carousel_odkaz4');?>"><?php echo $this->config->item('hlavnistrana_carousel_nadpis4');?></a></h4>
            <p><?php echo $this->config->item('hlavnistrana_carousel_text4');?></p>
          </div>
        </div><!-- End Item -->

        <div class="item">
          <img style="height:auto;width: auto;" src="<?php echo $this->config->item('hlavnistrana_carousel_img5');?>">
           <div class="carousel-caption">
            <h4><a href="<?php echo $this->config->item('hlavnistrana_carousel_odkaz5');?>"><?php echo $this->config->item('hlavnistrana_carousel_nadpis5');?></a></h4>
            <p><?php echo $this->config->item('hlavnistrana_carousel_text5');?></p>
          </div>
        </div><!-- End Item -->
                
      </div><!-- End Carousel Inner -->


    <ul class="list-group col-sm-4">
      <li data-target="#myCarousel" data-slide-to="0" class="list-group-item active"><h4><?php echo $this->config->item('hlavnistrana_carousel_nadpis1');?></h4></li>
      <li data-target="#myCarousel" data-slide-to="1" class="list-group-item"><h4><?php echo $this->config->item('hlavnistrana_carousel_nadpis2');?></h4></li>
      <li data-target="#myCarousel" data-slide-to="2" class="list-group-item"><h4><?php echo $this->config->item('hlavnistrana_carousel_nadpis3');?></h4></li>
      <li data-target="#myCarousel" data-slide-to="3" class="list-group-item"><h4><?php echo $this->config->item('hlavnistrana_carousel_nadpis4');?></h4></li>
      <li data-target="#myCarousel" data-slide-to="4" class="list-group-item"><h4><?php echo $this->config->item('hlavnistrana_carousel_nadpis5');?></h4></li>
    </ul>
    
    
 

      <!-- Controls -->
      <div class="carousel-controls">
          <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
          </a>
          <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
          </a>
      </div>

    </div><!-- End Carousel -->
     <div class="container marketing">

      <!-- Three columns of text below the carousel -->
      <div style="margin-top: 240px" class="row">
        <div class="col-lg-4">
         <h1><?php echo $pocetMap->Pocet; ?></h1>
          <h2>Map</h2>
        
        </div><!-- /.col-lg-4 -->
        <div class="col-lg-4">
          <h1><?php echo $pocetTestu->Pocet; ?></h1>
          <h2>Testů</h2>
        </div><!-- /.col-lg-4 -->
        <div class="col-lg-4">
          <h1><?php echo $pocetLidi->Pocet; ?></h1>
          <h2>Zaregistrovaných <br>uživatelů</h2>
        </div><!-- /.col-lg-4 -->
      </div><!-- /.row -->


    

      <!-- /END THE FEATURETTES -->
    
</div>


