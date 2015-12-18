<?php delete_transient( 'biogena_data_linee'); $arrayC=biogenaData::data(get_the_permalink(),'linee'); $first=$arrayC->first;$next=$arrayC->next;$prev=$arrayC->prev;
?>

 <div class="content">

               <div class="desc">
               <div class="desc-text">   <?php $content=strip_tags($first->content); if($content=='' || 'BIOGENA: I TRATTAMENTI COADIUVANTI'){$content='Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.';}echo $content; ?></div>
               <?php $attivi=$first->attivi; if(count($attivi)>0){ ?>
               <ul class="attivi">
                  <h3>Attivi di Linea: </h3>
                 <?php foreach ($attivi as $key => $attivo): ?>
                   <li class="attivo"><?= $attivo[0] ?></li>
                 <?php endforeach ?>
               </ul>
               <?php } ?>
               </div>

                  <hr>
    <div class="down-nav">
      <div class="line">
        <span class="prev"><a href="<?= $prev->permalink; ?>" title=""><svg class="svg-icon" viewBox="0 0 20 20">
              <path fill="none" d="M8.388,10.049l4.76-4.873c0.303-0.31,0.297-0.804-0.012-1.105c-0.309-0.304-0.803-0.293-1.105,0.012L6.726,9.516c-0.303,0.31-0.296,0.805,0.012,1.105l5.433,5.307c0.152,0.148,0.35,0.223,0.547,0.223c0.203,0,0.406-0.08,0.559-0.236c0.303-0.309,0.295-0.803-0.012-1.104L8.388,10.049z"></path>
            </svg></a></span>

            <span class="title" ><?= $first->title; ?></span><span class="next"><a href="<?= $next->permalink; ?>" title=""><svg class="svg-icon" viewBox="0 0 20 20">
              <path fill="none" d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
            </svg></a></span></div></div>
            <hr>
            <div class="content-wrapper">
                <h3>Trattamento coadiuvante per <a href="<?= $first->right_obj_plink; ?>" title=""><?= $first->right_obj_title; ?></a></h3>
                <div class="products">


                  <?php foreach($first->conn_arr as $key=> $prod){ ?>
                                <div class="product flag-media <?php echo $key % 2 == 0?'odd':'even'; ?>"><a href="<?= $prod->permalink; ?>"> <div><h3 class='product-title'><?= $prod->title; ?> </h3> </div> </a><div class="flag-thumb"> <a href="<?= $prod->permalink; ?>"><?= $prod->thumb; ?>  </a></div><div class="flag-body"><?= $prod->content; ?><div class="more"><a href="<?= $prod->permalink; ?>" title="">Vai alla scheda prodotto</a> </div> </div> </div>
                  <?php } ?>
                  </div>
              </div>
 </div>
