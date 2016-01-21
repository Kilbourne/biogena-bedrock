
  <script id="area-skin-care" type="text/template" >

 <div class="background-container">
 <picture>
   <source media="(max-width: 49.999em)" srcset='<%  arrStr = first.thumbnail.split('src="').pop().split('"').shift() %><%= arrStr %> 280w' sizes="(max-width: 280px) 100vw, 280px">
   <img  class="attachment-post-thumbnail wp-post-image" src="<%= first['fields']['immagine_full_width']['url'] %>"   alt="">
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
                                <div class="flag-body"><div class="desc-foto"><img src="<%= first['fields']['foto_descrizione']%>" alt=""></div><%= first['content'] %><% if((first['content'].match(/<\/p>/g) || []).length>1){ %><span class="readmore-box"><?php _e("Leggi Tutto","sage"); ?></span><% } %> </div>
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/dist/images/doctor-1.jpg" alt="">
                                </div>
              </div><div class="box2 boxx">
                <div  class="boxx-wrapper left"><h3><?php _e("La soluzione Biogena","sage"); ?></h3>
                                                 <div class="flag-body">
                                <p class="soluzione-text"><?php _e("Garantiamo al consumatore prodotti e soluzioni che soddisfano i più elevati standard di qualità, sicurezza ed efficacia e di innovazione scientifica.","sage"); ?></p>
                                 <p><%= first['fields']['prevenzione'] %></p>
                                  <span class="readmore-box"><?php _e("Leggi Tutto","sage"); ?></span>
                                 </div>
                                 <img src="<?php echo get_stylesheet_directory_uri(); ?>/dist/images/lab-2.jpg" alt="">
                                </div>
              </div><div class="box3 boxx">
                         <div  class="boxx-wrapper left">
                  <h3>FAQ</h3>
                  <div class="flag-body">
                    <p class="faq-text"><?php _e("Consulta le nostre FAQ per avere risposta alle tue domande più frequenti","sage"); ?> </p>
                    <span class="readmore-box"><?php _e("Leggi Tutto","sage"); ?></span>
                  </div>
                  <img src="<?php echo get_stylesheet_directory_uri(); ?>/dist/images/woman-ask.png" alt="">
                </div>
              </div>
              </div>
                  <% fotoprotezione=first['fields']['fotoprotezione_1'];fotoprotezione2=first['fields']['fotoprotezione_2'];fotoprotezione3=first['fields']['fotoprotezione_3'];if(fotoprotezione){
%>
<hr>
<div class="fotoprotezione-wrapper content-wrapper">
<div class="fotop1 fotop boxx"><div class="boxx-wrapper"><h3><?php _e("Che cosa sono i raggi UVA e UVB?","sage"); ?></h3><div class="flag-body fotop-content"> <%= fotoprotezione %> <span class="readmore-box"><?php _e("Leggi Tutto","sage"); ?></span></div></div></div><div class="fotop2 fotop boxx"><div class="boxx-wrapper"><h3><?php _e("Lo sapevi che…","sage"); ?></h3><div class="flag-body fotop-content"> <%= fotoprotezione2 %> <span class="readmore-box"><?php _e("Leggi Tutto","sage"); ?></span></div></div></div><div class="fotop3 fotop boxx"><div class="boxx-wrapper"><h3><?php _e("Guida al corretto “uso” del sole","sage"); ?></h3><div class="fotop-content flag-body "> <%= fotoprotezione3 %><span class="readmore-box"><?php _e("Leggi Tutto","sage"); ?></span> </div> </div></div>
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
