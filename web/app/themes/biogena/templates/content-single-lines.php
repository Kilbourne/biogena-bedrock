<?php
$title=get_the_title();

if($title !== __('Linea Osmin','sage')){

  $title=is_single()?html_entity_decode(get_the_title()):0;
  $by_index=is_single()?false:true;
  $arrayC=biogenaData::data(get_post_type(),$title,true,$by_index); $first=$arrayC->first;$next=$arrayC->next;$prev=$arrayC->prev;
  $special_field=( isset($first['fields']['no_area_skin_care']) && $first['fields']['no_area_skin_care']===TRUE )  || (isset($first['fields']['prodotto_singolo']) && $first['fields']['prodotto_singolo']===TRUE);
  $no_asc=( isset($first['fields']['no_area_skin_care']) && $first['fields']['no_area_skin_care']===TRUE );
  $singolo=isset($first['fields']['prodotto_singolo']) && $first['fields']['prodotto_singolo']===TRUE;
  $no_or_single=( isset($first['fields']['no_area_skin_care']) && $first['fields']['no_area_skin_care']===TRUE )   || (isset($first['fields']['riservato']) && $first['fields']['riservato']===TRUE);
  $riservato=isset($first['fields']['riservato']) && $first['fields']['riservato']===TRUE;
  $double=isset($first['fields']['double']) && $first['fields']['double']===TRUE;
  $paginazione=isset($first['fields']['paginazione'])?intval($first['fields']['paginazione']):FALSE;
?>

<?php
$default_attr = array(
  'class' => "wp-post-image"
);
if($no_asc){
  $claim=$first['fields']['claim_'];
}else{
  $claim=$first['area-skin-care']['fields']['claim_'];
}
$claim=str_replace ('<br></br>','',$claim);
$claim=str_replace ('<br>','',$claim);
$claim=str_replace ('<br/>','',$claim);
$attivi=$first['fields']['attivi_di_linea'];
if(!$double && !($singolo && count($attivi)===0)){
  echo '<div class="background-container specialita">';
echo $claim;
  the_post_thumbnail( );
  echo ' </div>';

}elseif(!($singolo && count($attivi)===0)){
$double_claim=$first['fields']['double_claim'];
$double_claim=str_replace ('<br></br>','',$double_claim);
$double_claim=str_replace ('<br>','',$double_claim);
$double_claim=str_replace ('<br/>','',$double_claim);
  ?>
   <div class="background-container specialita double">
    <div class="swiper-wrapper">
      <div class="swiper-slide">
        <?= $claim.the_post_thumbnail( );   ?>
      </div>
      <div class="swiper-slide">
      <?=  $double_claim. wp_get_attachment_image($first['fields']['second_thumb']['id'],'full',false,$default_attr) ; ?>
      </div>
    </div>
    </div>
<?php } ?>
<div class="content">
    <div class="desc <?php  if(count($attivi)===0){ echo 'no-pad';} if($singolo && count($attivi)===0){ echo ' singolo-no-attivi'; } ?>">


      <div class="down-nav">
        <div class="line">
          <span class="prev"><a href="<?= $prev['permalink']; ?>" title=""><svg class="svg-icon" viewBox="0 0 20 20">
              <path fill="none" d="M8.388,10.049l4.76-4.873c0.303-0.31,0.297-0.804-0.012-1.105c-0.309-0.304-0.803-0.293-1.105,0.012L6.726,9.516c-0.303,0.31-0.296,0.805,0.012,1.105l5.433,5.307c0.152,0.148,0.35,0.223,0.547,0.223c0.203,0,0.406-0.08,0.559-0.236c0.303-0.309,0.295-0.803-0.012-1.104L8.388,10.049z"></path>
          </svg></a></span><span class="title" ><?= $first['title']; ?></span><span class="next"><a href="<?= $next['permalink']; ?>" title=""><svg class="svg-icon" viewBox="0 0 20 20">
              <path fill="none" d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
          </svg></a></span></div></div>

          <?php $count=count($attivi); if($count>0){ ?>
            <div class="attivi-wrapper <?php  if($count===2){echo " two ";};?> <?php  if($count===3){echo " three  ";};?> ">
               <h3><?php _e("Gli Attivi di Linea","sage");?> </h3>
               <ul class="attivi">
                 <?php foreach ($attivi as $key => $attivo):
                 $image=$attivo['immagine_attivo'];
                 if($count>3){$count=3;}
                 ?>
                  <li class="attivo inline-block <?= 'w'.$count ?>"><img src="<?php echo $image['url']; ?>"  alt="<?php echo $image['alt']; ?>" /><?= $attivo['attivo']."<div class='attivo-desc'>".$attivo['descrizione_attivo']."</div>" ?></li>
                 <?php endforeach ?>
               </ul>
            </div>
          <?php } ?>
    </div>
    <div class="content-wrapper <?php if(count($first['prodotti'])<2){ echo 'single-product-wrapper ';} if(count($attivi)===0){ echo 'no-pad';}?>">
      <?php if( !$no_or_single ){
$vowels =
    'aàáâãāăȧäảåǎȁąạḁẚầấẫẩằắẵẳǡǟǻậặæǽǣ' .
    'AÀÁÂÃĀĂȦÄẢÅǍȀȂĄẠḀẦẤẪẨẰẮẴẲǠǞǺẬẶÆǼǢ' .
    'EÈÉÊẼĒĔĖËẺĚȄȆẸȨĘḘḚỀẾỄỂḔḖỆḜ' .
    'eèéêẽēĕėëẻěȅȇẹȩęḙḛềếễểḕḗệḝ' .
    'IÌÍÎĨĪĬİÏỈǏỊĮȈȊḬḮ' .
    'iìíîĩīĭıïỉǐịįȉȋḭḯ' .
    'OÒÓÔÕŌŎȮÖỎŐǑȌȎƠǪỌØỒỐỖỔȰȪȬṌṐṒỜỚỠỞỢǬỘǾŒ' .
    'oòóôõōŏȯöỏőǒȍȏơǫọøồốỗổȱȫȭṍṏṑṓờớỡởợǭộǿœ' .
    'UÙÚÛŨŪŬÜỦŮŰǓȔȖƯỤṲŲṶṴṸṺǛǗǕǙỪỨỮỬỰ' .
    'uùúûũūŭüủůűǔȕȗưụṳųṷṵṹṻǖǜǘǖǚừứữửự'
;

$isVowel=strpos($vowels,substr($first['area-skin-care']['title'], 0, 1));
$art=$isVowel?'l’':'la ';
        ?>
          <h3><?php _e("Trattamenti coadiuvanti per","sage");?> <a href="<?= $first['area-skin-care']['permalink']; ?>" title=""><?= $art.$first['area-skin-care']['title']; ?></a></h3>
      <?php } ?>
      <div class="products">
      <?php if(count($first['prodotti'])>1){ ?>
      <?php if(count($first['prodotti'])>3){ echo '<div class="swiper-wrapper">';} ?>
        <?php foreach($first['prodotti'] as $key=> $prod){ ?>
        <?php if(count($first['prodotti'])>3 && ($key===0 || (($key % 3 === 0 && !$paginazione)|| $key===$paginazione))){ echo '<div class="swiper-slide">';} ?>
            <div class="product flag-media <?php echo $key % 2 == 0?'odd':'even'; ?>">

                <div>

                <h3 class='product-title'>
                     <?php if(!$riservato){ ?>
              <a href="<?= $prod['permalink']; ?>">
            <?php } ?>
                <?= $prod['title']; ?>
                <?php if(!$riservato){ ?>
              </a>
            <?php } ?>
                </h3> </div>

              <div class="flag-thumb">
              <?php if(!$riservato){ ?>
                <a href="<?= $prod['permalink']; ?>">
              <?php } ?>
                  <?= $prod['thumbnail']; ?>
              <?php if(!$riservato){ ?>
                </a>
              <?php } ?>
              </div><div class="flag-body">
                <?= $prod['content']; ?>
                <div class="more">
                <?php if($riservato){

                  echo '<a href="'.get_page_link(634).'" class="ajax-popup-link" >'.__("Accedi alla nostra area riservata.","sage").'</a>';
                } else{?>
                  <a href="<?= $prod['permalink']; ?>"  title=""><?php _e("Vai alla scheda prodotto","sage");?></a>
                <?php } ?>
                </div>
              </div>
            </div>
             <?php if(count($first['prodotti'])>3 && (  (($key+1) % 3 === 0 && !$paginazione)||($key===$paginazione-1) || $key===(count($first['prodotti'])-1))){ ?> <?= ' </div>'; ?> <?php } ?>
         <?php }} ?>
         <?php if(count($first['prodotti'])>3  ){ echo '</div>';} ?>
         <?php if((count($first['prodotti'])>3 && !$paginazione ) || ( $paginazione!==count($first['prodotti']) && !!$paginazione)){ echo '<div class="arrows-wrapper"><div class="swiper-button-prev"></div><p>'.__("Altri Prodotti","sage").'</p> <div class="swiper-button-next"></div></div><hr>';} ?>
        <?php if(count($first['prodotti'])<2){
          $title=isset($first['prodotti'][0])?$first['prodotti'][0]['title']:get_the_title();
          global $post;
              $post = get_page_by_title( $title, 'OBJECT', __('prodotti','sage') );
          query_posts( array('p'=>$post->ID,'post_type'=>__('prodotti','sage'))); ?>
          <div class="single-linea"><?php include_once(locate_template('templates/content-single-'.__('prodotti','sage').'.php')); ?></div>      <?php
        } ?>
      </div>
    </div>
</div>
<?php }elseif($title ===__('Linea Osmin','sage')){
  get_template_part( 'templates/content-osmin');
}?>
