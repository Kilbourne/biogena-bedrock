<?php
//delete_transient( 'biogena_data_aree-terapeutiche');
$title=is_single()?get_the_title():0;
$by_index=is_single()?false:true;

$arrayC=biogenaData::data(get_post_type(),$title,true,$by_index); $first=$arrayC->first;$next=$arrayC->next;$prev=$arrayC->prev;
$default_attr = array(
  'class' => "wp-post-image"
);
?>
<?php
$image_id=get_post_thumbnail_id();
$image_meta = wp_get_attachment_metadata( $image_id );
$image = wp_get_attachment_image_src( $image_id,'full');
if ( $image ) {
    $image_src = $image[0];
    $size_array = array(
        absint( $image[1] ),
        absint( $image[2] )
    );
}
$srcset_value = wp_calculate_image_srcset( $size_array, $image_src, $image_meta );
$sizes_value = wp_get_attachment_image_sizes($image_id, 'full' );
$srcset = $srcset_value ? ' srcset="' . esc_attr( $srcset_value ) . '"' : '';
$sizes = $sizes_value ? ' sizes="' . esc_attr( $sizes_value ) . '"' : '';


?>
<div class="background-container">

<picture>
  <source media="(max-width: 49.999em)" <?php echo $srcset; ?> <?php echo $sizes; ?> >
  <?= wp_get_attachment_image($first['fields']['immagine_full_width']['id'],'full',false,$default_attr) ;?>
</picture>

<?= $first['fields']['claim_'] ; ?>

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

                 <div class="flag-body collapsed"><?= $first['content'];?><?php if(substr_count($first['content'], '</p>')>1){ // 2 ?><span class="readmore1">Leggi Tutto</span><?php } ?> </div>
                </div>

          <hr>
          <div class="content-row">
          <div class="inline-block prevenzione" >
            <h3>La soluzione Biogena</h3><div class="flag-media">
                 <div class="flag-body"><p><?= $first['fields']['prevenzione'];?></p></div></div>
          </div><div class="inline-block lineas" >

        <a href="<?= $first['linea']['permalink']; ?> " title="">

          <?= $first['linea']['thumbnail']; ?>
          </a>
          </div>
</div>
<?php $fotoprotezione=$first['fields']['fotoprotezione_1'];if(isset($fotoprotezione)){
?>
<div class="fotoprotezione-wrapper">
    <div class="fotop1"><h3>Ma che cosa sono le radiazioni UVA e UVB?</h3><div class="fotop-content"> <?php echo $fotoprotezione; ?> </div></div>
    <div class="fotop2"><h3>Lo sapevi che…</h3><div class="fotop-content"> <?php $fotoprotezione=$first['fields']['fotoprotezione_2']; echo $fotoprotezione; ?> </div></div>
    <div class="fotop3"><h3>Guida al corretto “uso” del sole</h3><div class="fotop-content"> <?php $fotoprotezione=$first['fields']['fotoprotezione_3']; echo $fotoprotezione; ?> </div></div>
</div>
  <?php } ?>
                              <?php $attivi=$first['linea']['fields']['attivi_di_linea'];$count=count($attivi); if($count>0){ ?>
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
          <hr>
          <div class="slideshow correlati">
              <h4>  Scopri <?= $first['linea']['title']; ?></h4>
              <?php if(count($first['prodotti'])>1){ ?>
                <div class=" slider-patologie active <?= count($first['prodotti'])===2?'two':'three' ?>" >
              <?php }else {echo '<div class=" no-slider active" >';} ?>
                    <div class="swiper-wrapper">
                  <?php foreach($first['prodotti'] as $key=> $prod){ ?>
                                <div class="swiper-slide"><a href="<?= $prod['permalink']; ?>"><?= $prod['thumbnail']; ?> <div><h3><?= $prod['title']; ?> </h3> </div> </a></div>
                  <?php } ?>
                    </div>
              <?php if(count($first['prodotti'])>1){ ?>
                                    <div class="navigation"></div>
              <?php } ?>
                </div>
          </div>
              </div>
 </div>
