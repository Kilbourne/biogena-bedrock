<?php 
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