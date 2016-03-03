 <script id="<?php _e("linee","sage")?>" type="text/template" >
 <% var special_field=( (!!first['fields']['no_area_skin_care'] && first['fields']['no_area_skin_care']===true )  || (!!first['fields']['prodotto_singolo'] && first['fields']['prodotto_singolo']===true)),
  no_asc=( !!first['fields']['no_area_skin_care'] && first['fields']['no_area_skin_care']===true ),
  singolo=!!first['fields']['prodotto_singolo'] && first['fields']['prodotto_singolo']===true,
  no_or_single=( !!first['fields']['no_area_skin_care'] && first['fields']['no_area_skin_care']===true )   || (!!first['fields']['riservato'] && first['fields']['riservato']===true),
  riservato=!!first['fields']['riservato'] && first['fields']['riservato']===true,
  double=!!first['fields']['double'] && first['fields']['double']===true,
  paginazione=!!first['fields']['paginazione']?Number(first['fields']['paginazione']):false;
  %>

<% var regex = /<br\s*[\/]?>/gi;var claim=no_asc?first['fields']['claim_'].replace(regex,''):first['area-skin-care']['fields']['claim_'].replace(regex,'');

var double_claim= !!first['fields']['double_claim'] ? first['fields']['double_claim'].replace(regex,'') : '';
var attivi=first['fields']['attivi_di_linea'];


 %>
<% if(!double && !(singolo && attivi.length===0)) { %>
        <div class="background-container specialita">
          <%= claim %>
          <%= first['thumbnail'] %>
      </div>
<% } else if(!(singolo && attivi.length===0)) { %>
       <div class="background-container specialita double">
        <div class="swiper-wrapper">
          <div class="swiper-slide">
                    <%= claim %>
                    <%= first['thumbnail'] %>
          </div>
          <div class="swiper-slide">
            <%=  double_claim  %> <img  class="attachment-post-thumbnail wp-post-image" src="<%= first['fields']['second_thumb']['url'] %>"   alt="">
                  </div>
    </div>
    </div>
<% } %>

 <div class="content">


                              <div class="desc <%  if(attivi.length===0){ %> <%= 'no-pad' %> <% } %>">


        <div class="down-nav">
<div class="line">
          <span class="prev"><a href="<%= prev.permalink %>" title=""><svg class="svg-icon" viewBox="0 0 20 20">
              <path fill="none" d="M8.388,10.049l4.76-4.873c0.303-0.31,0.297-0.804-0.012-1.105c-0.309-0.304-0.803-0.293-1.105,0.012L6.726,9.516c-0.303,0.31-0.296,0.805,0.012,1.105l5.433,5.307c0.152,0.148,0.35,0.223,0.547,0.223c0.203,0,0.406-0.08,0.559-0.236c0.303-0.309,0.295-0.803-0.012-1.104L8.388,10.049z"></path>
            </svg></a></span><span class="title" ><%= first.title %></span><span class="next"><a href="<%= next.permalink %>" title=""><svg class="svg-icon" viewBox="0 0 20 20">
              <path fill="none" d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
            </svg></a></span></div></div>

               <%  if(attivi && attivi instanceof Array&&attivi.length ){ %>
               <div class="attivi-wrapper <%  if(attivi.length===2){ %> <%= " two " %> <% } %> <%  if(attivi.length===3){ %> <%= " three  " %> <% } %>">
               <h3><?php _e("Gli Attivi di Linea","sage"); ?> </h3>
               <ul class="attivi">

                 <% _.each(attivi ,function(attivo,i){
                 image=attivo['immagine_attivo'];
                 count=attivi.length;
                 if(attivi.length>3){count=3  ;}
                 %>
                   <li class="attivo inline-block <%= 'w'+count %>"><img src="<%= image['url'] %>"  alt="<%= image ['alt'] %>" /><%= attivo['attivo']+"<div class='attivo-desc'>"+attivo['descrizione_attivo']+"</div>" %></li>
                  <% }) %>
               </ul>
               </div>
               <% } %>
               </div>

            <div class="content-wrapper <% if(first['prodotti'].length<2){ %> <%= 'single-product-wrapper' %> <% } %> <% if(attivi.length===0){ %> <%= 'no-pad' %> <% } %>">
                <% if(!no_or_single){
vowels =
    'aàáâãāăȧäảåǎȁąạḁẚầấẫẩằắẵẳǡǟǻậặæǽǣ' +
    'AÀÁÂÃĀĂȦÄẢÅǍȀȂĄẠḀẦẤẪẨẰẮẴẲǠǞǺẬẶÆǼǢ' +
    'EÈÉÊẼĒĔĖËẺĚȄȆẸȨĘḘḚỀẾỄỂḔḖỆḜ' +
    'eèéêẽēĕėëẻěȅȇẹȩęḙḛềếễểḕḗệḝ' +
    'IÌÍÎĨĪĬİÏỈǏỊĮȈȊḬḮ' +
    'iìíîĩīĭıïỉǐịįȉȋḭḯ' +
    'OÒÓÔÕŌŎȮÖỎŐǑȌȎƠǪỌØỒỐỖỔȰȪȬṌṐṒỜỚỠỞỢǬỘǾŒ' +
    'oòóôõōŏȯöỏőǒȍȏơǫọøồốỗổȱȫȭṍṏṑṓờớỡởợǭộǿœ' +
    'UÙÚÛŨŪŬÜỦŮŰǓȔȖƯỤṲŲṶṴṸṺǛǗǕǙỪỨỮỬỰ' +
    'uùúûũūŭüủůűǔȕȗưụṳųṷṵṹṻǖǜǘǖǚừứữửự'
;

isVowel=vowels.indexOf(first['area-skin-care']['title'][0])!==-1;
art=isVowel?<?php echo "'".__('l’','sage')."'"; ?>:<?php echo "'".__('la ','sage')."'"; ?>
                	%>
                  <h3><?php _e("Trattamenti coadiuvanti per","sage"); ?> <a href="<%= first['area-skin-care']['permalink'] %>" title=""><%= art %><%= first['area-skin-care']['title'] %></a></h3>
                <% } %>
                <div class="products">
                <% if(first.prodotti.length>1){ %>
                <% if(first.prodotti.length>3){ %> <%= '<div class="swiper-wrapper">' %>  <% } %>
                  <% _.each(first.prodotti,function(prod,key){ %>

                  <% if(first.prodotti.length >3 && (key===0 || ((key % 3 === 0 && !paginazione) || key===paginazione ))){ %> <%= '<div class="swiper-slide">' %> <% } %>
                    <div class="product flag-media <%= key % 2 == 0?'odd':'even' %>">

                        <div><h3 class='product-title' >
                         <% if(!riservato){ %>
                      <a href="<%= prod.permalink %>">
                    <% } %>
                    <%= prod.title %>
                    <% if(!riservato){ %>
                      </a>
                    <% } %>
                     </h3> </div>

                      <div class="flag-thumb">
                        <% if(!riservato){ %>
                          <a href="<%= prod.permalink %>">
                        <% } %>
                            <%= prod.thumbnail %>
                        <% if(!riservato){ %>
                          </a>
                        <% } %>
                      </div><div class="flag-body">
                        <%= prod.content %>
                        <div class="more">
                        <% if(riservato){ %>
                          <a href="<?= get_page_link(634);?>" class="ajax-popup-link" title=""><?php _e("Accedi alla nostra area riservata","sage"); ?>.</a>
                        <% }else{ %>
                          <a href="<%= prod['permalink'] %>" title=""><?php _e("Vai alla scheda prodotto","sage"); ?></a>
                        <% } %>
                        </div>
                      </div>
                    </div>
                    <% if(first.prodotti.length >3 && (((key+1) % 3 === 0 && !paginazione)||key===paginazione-1 || key===(first.prodotti.length-1))){ %> <%= '</div>' %> <% } %>
                  <% } )} %>

                  <% if(first.prodotti.length>3 ){ %> <%= '</div>' %>   <% } %>
                  <% if((first.prodotti.length>3 && !paginazione) || (paginazione !== first.prodotti.length && !!paginazione ) ){ %>
                  <%= '<div class="arrows-wrapper"><div class="swiper-button-prev"></div><p>' %> <?php _e("Altri Prodotti","sage"); ?> <%= '</p> <div class="swiper-button-next"></div></div><hr>' %>
                  <% } %>
        <% if(first['prodotti'].length<2){ %>
 <div class="single-linea"><div class="cube1"></div><div class="cube2"></div> </div>
<%        } %>
      </div>
              </div>
 </div>
 </script>
  <script id="<?php _e("area-skin-care","sage")?>" type="text/template" >

 <div class="background-container">
 <picture>
   <source media="(max-width: 49.999em)" srcset='<%  arrStr = first.thumbnail.split('src="').pop().split('"').shift() %><%= arrStr %> 801w' sizes="(max-width: 801px) 100vw, 801px">
   <img  class="attachment-post-thumbnail wp-post-image" srcset="<%= first['fields']['immagine_full_width']['url'] %> 1440w" sizes="(max-width: 1440px) 100vw, 1440px"  alt="">
 </picture>
 <%= first.fields.claim_ %>
 </div>


 <div class="content">
        <div class="down-nav">
<div class="line">
          <span class="prev"><a href="<%= prev.permalink %>" title=""><svg class="svg-icon" viewBox="0 0 20 20">
              <path fill="none" d="M8.388,10.049l4.76-4.873c0.303-0.31,0.297-0.804-0.012-1.105c-0.309-0.304-0.803-0.293-1.105,0.012L6.726,9.516c-0.303,0.31-0.296,0.805,0.012,1.105l5.433,5.307c0.152,0.148,0.35,0.223,0.547,0.223c0.203,0,0.406-0.08,0.559-0.236c0.303-0.309,0.295-0.803-0.012-1.104L8.388,10.049z"></path>
            </svg></a></span><span class="title" ><%= first.title %></span><span class="next"><a href="<%= next.permalink %>" title=""><svg class="svg-icon" viewBox="0 0 20 20">
              <path fill="none" d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
            </svg></a></span></div></div>
            <hr>
            <div class="content-wrapper">
               <div class="box1 boxx">
                <div class="boxx-wrapper left"><h3><?php _e("Parliamo di...","sage"); ?></h3>
                                <div class="flag-body"><% if(first['fields']['foto_descrizione']){ %><div class="desc-foto"><img src="<%= first['fields']['foto_descrizione'] %>" alt=""></div><% } %><%= first['content'] %><% if((first['content'].match(/<\/p>/g) || []).length>1){ %><span class="readmore-box"><?php _e("Leggi Tutto","sage"); ?></span><% } %> </div>
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/dist/images/doctor-1.jpg" alt="">
                                </div>
              </div><div class="box2 boxx">
                <div  class="boxx-wrapper left"><h3><?php _e("La soluzione Biogena","sage"); ?></h3>
                                                 <div class="flag-body">
                                <p class="soluzione-text"><?php _e("Garantiamo al consumatore prodotti e soluzioni che soddisfano i più elevati standard di qualità, sicurezza ed efficacia.","sage"); ?></p>
                                 <p><%= first['fields']['prevenzione'] %></p>
                                  <span class="readmore-box"><?php _e("Leggi Tutto","sage"); ?></span>
                                 </div>
                                 <img src="<?php echo get_stylesheet_directory_uri(); ?>/dist/images/lab-2.jpg" alt="">
                                </div>
              </div><div class="box3 boxx">
                         <div  class="boxx-wrapper left">
                  <h3>FAQ</h3>
                  <div class="flag-body">
                    <%

                      function recursive(el,content) {
                        if(!content)content='';
  next=jQuery(el).next();



  if(!next.length || next[0].nodeName==='OL'){

    return content;
  }else if(next[0].nodeName==='P'){
    content+=next.text();

    return recursive(next,content);
  }

}
final_faq='';
is_faq=!!first['fields']['faq'] && first['fields']['faq']!=='';
if(is_faq){
  faq = first['fields']['faq'];

  ol=jQuery(faq).filter('ol');

  ol.each(function(key){
    text=jQuery(this).text();

    content=recursive(this);

    accordion='<div class="accordion"><div class="dt"><a href="#faq_'+key+'" aria-expanded="false" aria-controls="faq_'+key+'" class="accordion-title accordionTitle js-accordionTrigger fa fa-caret-right"><p><strong>'+(key+1)+'. '+text+' </strong></p></a></div><div class="accordion-content accordionItem is-collapsed" aria-hidden="true" id="faq_'+key+'"><p>'+content+'</p></div></div>';
    final_faq+=accordion;

  })
  faq_text="<?php _e("Consulta le nostre FAQ per avere risposta alle tue domande più frequenti","sage"); ?>"
  final_faq+='<p class="by-cura">'+ '<?php echo __('A cura di AIDECO (Associazione Italiana di Dermatologia e Cosmetologia) ','sage'); ?>'+'</p>';
}else{
	vowels =
    'aàáâãāăȧäảåǎȁąạḁẚầấẫẩằắẵẳǡǟǻậặæǽǣ' +
    'AÀÁÂÃĀĂȦÄẢÅǍȀȂĄẠḀẦẤẪẨẰẮẴẲǠǞǺẬẶÆǼǢ' +
    'EÈÉÊẼĒĔĖËẺĚȄȆẸȨĘḘḚỀẾỄỂḔḖỆḜ' +
    'eèéêẽēĕėëẻěȅȇẹȩęḙḛềếễểḕḗệḝ' +
    'IÌÍÎĨĪĬİÏỈǏỊĮȈȊḬḮ' +
    'iìíîĩīĭıïỉǐịįȉȋḭḯ' +
    'OÒÓÔÕŌŎȮÖỎŐǑȌȎƠǪỌØỒỐỖỔȰȪȬṌṐṒỜỚỠỞỢǬỘǾŒ' +
    'oòóôõōŏȯöỏőǒȍȏơǫọøồốỗổȱȫȭṍṏṑṓờớỡởợǭộǿœ' +
    'UÙÚÛŨŪŬÜỦŮŰǓȔȖƯỤṲŲṶṴṸṺǛǗǕǙỪỨỮỬỰ' +
    'uùúûũūŭüủůűǔȕȗưụṳųṷṵṹṻǖǜǘǖǚừứữửự'
;
isVowel=vowels.indexOf(first['title'][0])!==-1;

art=isVowel?<?php echo "'".__('sull’','sage')."'"; ?>:<?php echo "'".__('sulla ','sage')."'"; ?>;
	faq_t="<?php _e('Scopri le nostre FAQ ','sage') ?>"+art+ first['title'] +"<?php _e(' da aprile 2016.','sage') ?>";
	faq_text="<strong>"+faq_t+"</strong>";
}
                    %>
                    <p class="faq-text"><%= faq_text %> </p>
                    <div class="list-wrapper"><%= final_faq %></div>
                    <% if(is_faq){ %><span class="readmore-box"><?php _e("Leggi Tutto","sage"); ?></span><% } %>
                  </div>
                  <img src="<?php echo get_stylesheet_directory_uri(); ?>/dist/images/woman-ask.png" alt="">
                </div>
              </div>
              </div>
                  <% fotoprotezione=first['fields']['fotoprotezione_1'];fotoprotezione2=first['fields']['fotoprotezione_2'];fotoprotezione3=first['fields']['fotoprotezione_3'];if(fotoprotezione){
%>
<hr>
<div class="fotoprotezione-wrapper content-wrapper">
<div class="fotop1 fotop boxx"><img class="img-cont" src="<%= first['fields']['fotoprotezione_1_img'] %>" alt=""><div class="boxx-wrapper"><h3><?php _e("Cosa sono i raggi UVA e UVB?","sage"); ?></h3><div class="flag-body fotop-content"> <%= fotoprotezione %> <span class="readmore-box"><?php _e("Leggi Tutto","sage"); ?></span></div></div></div><div class="fotop2 fotop boxx"><img class="img-cont" src="<%= first['fields']['fotoprotezione_2_img'] %>" alt=""><div class="boxx-wrapper"><h3><?php _e("Lo sapevi che…","sage"); ?></h3><div class="flag-body fotop-content"> <%= fotoprotezione2 %> <span class="readmore-box"><?php _e("Leggi Tutto","sage"); ?></span></div></div></div><div class="fotop3 fotop boxx"><img class="img-cont" src="<%= first['fields']['fotoprotezione_3_img'] %>" alt=""><div class="boxx-wrapper"><h3><?php _e("Guida al corretto “uso” del sole","sage"); ?></h3><div class="fotop-content flag-body "> <%= fotoprotezione3 %><span class="readmore-box"><?php _e("Leggi Tutto","sage"); ?></span> </div> </div></div>
</div>
  <% } %>
            <hr>
              <div class="slideshow correlati">

          <h4>  <a href="<%= first.linea.permalink %>" title=""><?php _e("Scopri","sage"); ?> <% if(first.linea.title.slice(0, 'Linea'.length) == 'Linea'){ %><?php _e(" la","sage"); ?><% } %> <%= first.linea.title %></a>  </h4>
              <% if(first['prodotti'].length>1){ %>
                <div class=" slider-patologie active <%= first['prodotti'].length===2?'two':'three' %> <%= first['prodotti'].length>3?'multi':'' %> <%= first['prodotti'].length>2?'multi2':'' %>" >
<% }else { %> <%= '<div class=" no-slider " >' %><% } %>
                    <div class="swiper-wrapper">
                  <% _.each(first.prodotti,function(prod){ %>
                                <div class="swiper-slide"><a href="<%= first['prodotti'].length>1?prod.permalink:first.linea.permalink %>"><%= prod.thumbnail %> <div><h3><%= prod.title %> </h3> </div> </a></div>
                  <% } )%>
                    </div>
              <% if(first['prodotti'].length>1){ %>
                                  <div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div>
    <div class="swiper-pagination"></div>
              <% } %>

                </div>
          </div>

</main>

 </script>
