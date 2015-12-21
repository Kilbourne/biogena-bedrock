<?php
//delete_transient( 'biogena_data_aree-terapeutiche');
$title=is_single()?get_the_title():0;
$by_index=is_single()?false:true;

$arrayC=biogenaData::data(get_post_type(),$title,true,$by_index); $first=$arrayC->first;$next=$arrayC->next;$prev=$arrayC->prev;
$default_attr = array(
  'class' => "wp-post-image"
);
?>
<div class="background-container">
<?= wp_get_attachment_image($first['fields']['immagine_full_width']['id'],'full',false,$default_attr).$first['fields']['claim_'] ; ?>

 </div>
 <div class="content">

    <div class="down-nav">
      <div class="line">
        <span class="prev"><a href="<?= $prev['permalink']; ?>" title=""><svg class="svg-icon" viewBox="0 0 20 20">
              <path fill="none" d="M8.388,10.049l4.76-4.873c0.303-0.31,0.297-0.804-0.012-1.105c-0.309-0.304-0.803-0.293-1.105,0.012L6.726,9.516c-0.303,0.31-0.296,0.805,0.012,1.105l5.433,5.307c0.152,0.148,0.35,0.223,0.547,0.223c0.203,0,0.406-0.08,0.559-0.236c0.303-0.309,0.295-0.803-0.012-1.104L8.388,10.049z"></path>
            </svg></a></span>

            <span class="title" ><?= $first['title']; ?></span><span class="next"><a href="<?= $next['permalink']; ?>" title=""><svg class="svg-icon" viewBox="0 0 20 20">
              <path fill="none" d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
            </svg></a></span></div></div>
            <hr>
            <div class="content-wrapper">
                <div class="flag-media">

                 <div class="flag-body"><?= $first['content'];?></div>
                </div>

          <hr>
          <div class="inline-block prevenzione" >
            <h3>La soluzione Biogena</h3><div class="flag-media">
                 <div class="flag-body"><p><?= $first['fields']['prevenzione'];?></p></div></div>
          </div><div class="inline-block lineas" >

        <a href="<?= $first['linea']['permalink']; ?> " title="">

          <?= $first['linea']['thumbnail']; ?>
          </a>
          </div>
                                   <?php $attivi=$first['linea']['fields']['attivi_di_linea']; if(count($attivi)>0){ ?>
               <div class="attivi-wrapper">
               <h3>Attivi di Linea </h3>
               <ul class="attivi">

                 <?php foreach ($attivi as $key => $attivo):
                 $image=$attivo['immagine_attivo'];
                 ?>
                   <li class="attivo inline-block"><div class="attivo-img-container"> <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" /></div><div class="attivo-desc-body">
                     <h3><?= $attivo['attivo'] ?></h3>
                     <div class="attivo desc"><?= $attivo['descrizione_attivo'] ?></div>
                   </div> </li>
                 <?php endforeach ?>
               </ul>
               </div>
               <?php } ?>
          <hr>
          <div class="slideshow correlati">
              <h4>  Scopri la linea <?= $first['linea']['title']; ?></h4>
                <div class=" slider-patologie active three" >
                    <div class="swiper-wrapper">
                  <?php foreach($first['prodotti'] as $key=> $prod){ ?>
                                <div class="swiper-slide"><a href="<?= $prod['permalink']; ?>"><?= $prod['thumbnail']; ?> <div><h3><?= $prod['title']; ?> </h3> </div> </a></div>
                  <?php } ?>
                    </div>
                    <div class="navigation"></div>
                </div>
          </div>
              </div>
 </div>
