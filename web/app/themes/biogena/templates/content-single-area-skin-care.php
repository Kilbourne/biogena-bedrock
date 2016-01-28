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
use Sunra\PhpSimple\HtmlDomParser;

function recursive($el,$content='') {
  $next=$el->next_sibling();
  if(!isset($next)|| $next === null || $next->tag==='ol'){
    return $content;
  }elseif($next->tag==='p'){
    $content.=implode(" ",$next->find('text'));
    return recursive($next,$content);
  }

}
if(isset($first['fields']['faq']) && $first['fields']['faq'] !=='' && $first['fields']['faq'] !==null){
  $faq = HtmlDomParser::str_get_html( $first['fields']['faq'] );
  $final_faq='';
  $ol=$faq->find('ol');
  foreach( $ol as $key=>$li)
  {
    $text=$li->find('text');
    $content=recursive($li);
    $accordion='<div class="accordion"><div class="dt"><a href="#faq_'.$key.'" aria-expanded="false" aria-controls="faq_'.$key.'" class="accordion-title accordionTitle js-accordionTrigger fa fa-caret-right"><p><strong>'.($key+1).'. '.implode(" ", $text).' </strong></p></a></div><div class="accordion-content accordionItem is-collapsed" aria-hidden="true" id="faq_'.$key.'"><p>'.$content.'</p></div></div>';
    $final_faq.=$accordion;
  }
  $final_faq.='<p class="by-cura">'.__('A cura di AIDECO (Associazione Italiana di Dermatologia e Cosmetologia) ','sage').'</p>';
}
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
            </svg></a></span><span class="title" ><?= $first['title']; ?></span><span class="next"><a href="<?= $next['permalink']; ?>" title=""><svg class="svg-icon" viewBox="0 0 20 20">
              <path fill="none" d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
            </svg></a></span></div></div>
            <hr>
            <div class="content-wrapper">
              <div class="box1 boxx">
                <div class="boxx-wrapper left"><h3><?php _e("Parliamo di...","sage");?></h3>
                                <div class="flag-body "><?php if($first['fields']['foto_descrizione']){ ?><div class="desc-foto"><img src="<?= $first['fields']['foto_descrizione'];?>" alt=""></div><?php } ?><?= $first['content'];?><?php if(substr_count($first['content'], '</p>')>1){  ?><span class="readmore-box"><?php _e("Leggi Tutto","sage");?></span><?php } ?>
                                </div>
<img src="<?php echo get_stylesheet_directory_uri(); ?>/dist/images/doctor-1.jpg" alt="">
                                </div>

              </div><div class="box2 boxx">
                <div  class="boxx-wrapper left"><h3><?php _e("La soluzione Biogena","sage");?></h3>

                                 <div class="flag-body">
                                   <p class="soluzione-text" ><?php _e("Garantiamo al consumatore prodotti e soluzioni che soddisfano i più elevati standard di qualità, sicurezza ed efficacia.","sage");?></p>
                                   <p><?= $first['fields']['prevenzione'];?></p>
                                  <span class="readmore-box"><?php _e("Leggi Tutto","sage");?></span>
                                 </div>
                                 <img src="<?php echo get_stylesheet_directory_uri(); ?>/dist/images/lab-2.jpg" alt="">
                                </div>

              </div><div class="box3 boxx">
                <div  class="boxx-wrapper left">
                  <h3><?php _e("FAQ","sage");?></h3>
                  <div class="flag-body">
                    <p class="faq-text"><?php _e("Consulta le nostre FAQ per avere risposta alle tue domande più frequenti","sage");?> </p>
                    <div class="list-wrapper"><?= $final_faq;?></div>
                    <span class="readmore-box"><?php _e("Leggi Tutto","sage");?></span>
                  </div>
                  <img src="<?php echo get_stylesheet_directory_uri(); ?>/dist/images/woman-ask.png" alt="">
                </div>
              </div>
            </div>
                                      <?php $fotoprotezione=$first['fields']['fotoprotezione_1'];if(isset($fotoprotezione)){
?>
<hr>
<div class="fotoprotezione-wrapper content-wrapper">

    <div class="fotop1 fotop boxx"><img class="img-cont" src="<?= $first['fields']['fotoprotezione_1_img'];?>" alt=""><div class="boxx-wrapper"><h3><?php _e("Cosa sono i raggi UVA e UVB?","sage");?></h3><div class=" flag-body fotop-content"><?php echo $fotoprotezione; ?><span class="readmore-box"><?php _e("Leggi Tutto","sage");?></span></div></div></div><div class="fotop2 fotop boxx"><img class="img-cont" src="<?= $first['fields']['fotoprotezione_2_img'];?>" alt=""><div class="boxx-wrapper"><h3><?php _e("Lo sapevi che…","sage");?></h3><div class="flag-body fotop-content"><?php $fotoprotezione=$first['fields']['fotoprotezione_2']; echo $fotoprotezione; ?> <span class="readmore-box"><?php _e("Leggi Tutto","sage");?></span></div></div></div><div class="fotop3 fotop boxx"><img class="img-cont" src="<?= $first['fields']['fotoprotezione_3_img'];?>" alt=""><div class="boxx-wrapper"><h3><?php _e("Guida al corretto “uso” del sole","sage");?></h3><div class="fotop-content flag-body"><?php $fotoprotezione=$first['fields']['fotoprotezione_3']; echo $fotoprotezione; ?><span class="readmore-box"><?php _e("Leggi Tutto","sage");?></span> </div></div></div>
</div>
  <?php } ?>
          <hr>
          <div class="slideshow correlati">
              <h4>  <a href="<?= $first['linea']['permalink']; ?>" title=""><?= substr($first['linea']['title'], 0,strlen('Linea'))==='Linea'?__("Scopri la","sage"):__("Scopri","sage");?> <?= $first['linea']['title']; ?></a></h4>
              <?php if(count($first['prodotti'])>1){ ?>
                <div class=" slider-patologie active <?= count($first['prodotti'])===2?'two':'three' ?> <?= count($first['prodotti'])>3?'multi':'' ?> <?= count($first['prodotti'])>2?'multi2':'' ?>" >
              <?php }else {echo '<div class=" no-slider active" >';} ?>
                    <div class="swiper-wrapper">
                  <?php foreach($first['prodotti'] as $key=> $prod){ ?>
                                <div class="swiper-slide"><a href="<?= count($first['prodotti'])>1?$prod['permalink']:$first['linea']['permalink']; ?>"><?= $prod['thumbnail']; ?> <div><h3><?= $prod['title']; ?> </h3> </div> </a></div>
                  <?php } ?>
                    </div>
              <?php if(count($first['prodotti'])>1){ ?>
                                                                  <div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div>
    <div class="swiper-pagination"></div>
              <?php } ?>
                </div>
          </div>

 </div>
