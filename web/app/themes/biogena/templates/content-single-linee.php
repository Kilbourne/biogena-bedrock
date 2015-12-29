<?php
$title=get_the_title();

if($title !=='Osmin' && $title !=='Specialità Medicinali'){

$title=is_single()?html_entity_decode(get_the_title()):0;
$by_index=is_single()?false:true;

$arrayC=biogenaData::data(get_post_type(),$title,true,$by_index); $first=$arrayC->first;$next=$arrayC->next;$prev=$arrayC->prev;

?>
<div class="background-container">
<?= the_post_thumbnail( ); ?> <?php if(isset($first['area-skin-care'])){ echo $first['area-skin-care']['fields']['claim_'] ;} ?>
 </div>
 <div class="content">

               <div class="desc">
               <div class="desc-text">   <?php $content=$first['content']; echo $content; ?></div>
                <hr >
    <div class="down-nav">
      <div class="line">
        <span class="prev"><a href="<?= $prev['permalink']; ?>" title=""><svg class="svg-icon" viewBox="0 0 20 20">
              <path fill="none" d="M8.388,10.049l4.76-4.873c0.303-0.31,0.297-0.804-0.012-1.105c-0.309-0.304-0.803-0.293-1.105,0.012L6.726,9.516c-0.303,0.31-0.296,0.805,0.012,1.105l5.433,5.307c0.152,0.148,0.35,0.223,0.547,0.223c0.203,0,0.406-0.08,0.559-0.236c0.303-0.309,0.295-0.803-0.012-1.104L8.388,10.049z"></path>
            </svg></a></span>

            <span class="title" ><?= $first['title']; ?></span><span class="next"><a href="<?= $next['permalink']; ?>" title=""><svg class="svg-icon" viewBox="0 0 20 20">
              <path fill="none" d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
            </svg></a></span></div></div>
            <hr >
               <?php $attivi=$first['fields']['attivi_di_linea'];$count=count($attivi); if($count>0){ ?>
               <div class="attivi-wrapper">
               <h3>Gli Attivi di Linea </h3>
               <ul class="attivi">

                 <?php foreach ($attivi as $key => $attivo):
                 $image=$attivo['immagine_attivo'];
                 if($count>4){$count=4;}
                 ?>
                   <li class="attivo inline-block <?= 'w'.$count ?>"><img src="<?php echo $image['url']; ?>"  alt="<?php echo $image['alt']; ?>" /><?= $attivo['attivo']."<div class='attivo-desc'>".$attivo['descrizione_attivo']."</div>" ?></li>
                 <?php endforeach ?>
               </ul>
               </div>
               <?php } ?>
               </div>


            <div class="content-wrapper">
                <?php if(isset($first['area-skin-care'])){ ?><h3>Trattamenti coadiuvanti per <a href="<?= $first['area-skin-care']['permalink']; ?>" title=""><?= $first['area-skin-care']['title']; ?></a></h3><?php } ?>
                <div class="products">


                  <?php foreach($first['prodotti'] as $key=> $prod){ ?>
                                <div class="product flag-media <?php echo $key % 2 == 0?'odd':'even'; ?>"><a href="<?= $prod['permalink']; ?>"> <div><h3 class='product-title'><?= $prod['title']; ?> </h3> </div> </a><div class="flag-thumb"> <a href="<?= $prod['permalink']; ?>"><?= $prod['thumbnail']; ?>  </a></div><div class="flag-body"><?= $prod['content']; ?><div class="more"><a href="<?= $prod['permalink']; ?>" title="">Vai alla scheda prodotto</a> </div> </div> </div>
                  <?php } ?>
                  </div>
              </div>
 </div>
<?php }elseif($title ==='Osmin'){
 $first=biogenaData::data('linee',get_the_title());
 $default_attr = array(
  'class' => "wp-post-image"
);
?>
<div class="osmin background-container">
<?= wp_get_attachment_image($first['fields']['immagine_full_width']['id'],'full',false,$default_attr).$first['fields']['claim_'] ; ?>

 </div>
 <div class="osmin content">

            <div class="content-wrapper">
                <div class="flag-media">

                 <div class="flag-body collapsed"><?= $first['content'];?><?php if(substr_count($first['content'], '</p>')>1){ // 2 ?><span class="readmore1">Leggi Tutto</span><?php } ?></div>
                </div>

          <hr>
          <div class="inline-block prevenzione" >
            <h3>La soluzione Biogena</h3><div class="flag-media">
                 <div class="flag-body"><p><?= $first['fields']['prevenzione'];?></p></div></div>
          </div><div class="inline-block lineas" >

        <a href="<?= $first['permalink']; ?> " title="">

          <?= $first['thumbnail']; ?>
          </a>
          </div>
            <hr >
               <?php $attivi=$first['fields']['attivi_di_linea'];$count=count($attivi); if($count>0){ ?>
               <div class="attivi-wrapper">
               <h3>Gli Attivi di Linea </h3>
               <ul class="attivi">

                 <?php foreach ($attivi as $key => $attivo):
                 $image=$attivo['immagine_attivo'];
                 if($count>4){$count=4;}
                 ?>
                   <li class="attivo inline-block <?= 'w'.$count ?>"><img src="<?php echo $image['url']; ?>"  alt="<?php echo $image['alt']; ?>" /><?= $attivo['attivo']."<div class='attivo-desc'>".$attivo['descrizione_attivo']."</div>" ?></li>
                 <?php endforeach ?>
               </ul>
               </div>
               <?php } ?>
       <div class="content-wrapper">

                <div class="products">


                  <?php foreach($first['prodotti'] as $key=> $prod){ ?>
                                <div class="product flag-media <?php echo $key % 2 == 0?'odd':'even'; ?>"><a href="<?= $prod['permalink']; ?>"> <div><h3 class='product-title'><?= $prod['title']; ?> </h3> </div> </a><div class="flag-thumb"> <a href="<?= $prod['permalink']; ?>"><?= $prod['thumbnail']; ?>  </a></div><div class="flag-body"><?= $prod['content']; ?><div class="more"><a href="<?= $prod['permalink']; ?>" title="">Vai alla scheda prodotto</a> </div> </div> </div>
                  <?php } ?>
                  </div>
              </div>
              </div>
 </div>
<?php }elseif($title ==='Specialità Medicinali'){

$arrayC=biogenaData::data(get_post_type(),$title,true,false); $first=$arrayC->first;$next=$arrayC->next;$prev=$arrayC->prev;
?>
<div class="background-container specialita">
<?php echo $first['fields']['claim_'] ; ?><?= the_post_thumbnail( ); ?>
 </div>
 <div class="content">

               <div class="desc">
               <div class="desc-text">   <?php $content=$first['content']; echo $content; ?></div>
                <hr >
    <div class="down-nav">
      <div class="line">
        <span class="prev"><a href="<?= $prev['permalink']; ?>" title=""><svg class="svg-icon" viewBox="0 0 20 20">
              <path fill="none" d="M8.388,10.049l4.76-4.873c0.303-0.31,0.297-0.804-0.012-1.105c-0.309-0.304-0.803-0.293-1.105,0.012L6.726,9.516c-0.303,0.31-0.296,0.805,0.012,1.105l5.433,5.307c0.152,0.148,0.35,0.223,0.547,0.223c0.203,0,0.406-0.08,0.559-0.236c0.303-0.309,0.295-0.803-0.012-1.104L8.388,10.049z"></path>
            </svg></a></span>

            <span class="title" ><?= $first['title']; ?></span><span class="next"><a href="<?= $next['permalink']; ?>" title=""><svg class="svg-icon" viewBox="0 0 20 20">
              <path fill="none" d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
            </svg></a></span></div></div>
            <hr >
               <?php $attivi=$first['fields']['attivi_di_linea'];$count=count($attivi); if($count>0){ ?>
               <div class="attivi-wrapper">
               <h3>Gli Attivi di Linea </h3>
               <ul class="attivi">

                 <?php foreach ($attivi as $key => $attivo):
                 $image=$attivo['immagine_attivo'];
                 if($count>4){$count=4;}
                 ?>
                   <li class="attivo inline-block <?= 'w'.$count ?>"><img src="<?php echo $image['url']; ?>"  alt="<?php echo $image['alt']; ?>" /><?= $attivo['attivo']."<div class='attivo-desc'>".$attivo['descrizione_attivo']."</div>" ?></li>
                 <?php endforeach ?>
               </ul>
               </div>
               <?php } ?>
               </div>


            <div class="content-wrapper">

                <div class="products">


                  <?php foreach($first['prodotti'] as $key=> $prod){ ?>
                                <div class="product flag-media <?php echo $key % 2 == 0?'odd':'even'; ?>"><a href="<?= $prod['permalink']; ?>"> <div><h3 class='product-title'><?= $prod['title']; ?> </h3> </div> </a><div class="flag-thumb"> <a href="<?= $prod['permalink']; ?>"><?= $prod['thumbnail']; ?>  </a></div><div class="flag-body"><?= $prod['content']; ?><div class="more"> Informazioni riservate al solo personale medico registrato </div> </div> </div>
                  <?php } ?>
                  </div>
              </div>
 </div>

<?php }?>
