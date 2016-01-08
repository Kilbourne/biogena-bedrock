 <script id="linee" type="text/template" >
 <% var special_field=( (!!first['fields']['no_area_skin_care'] && first['fields']['no_area_skin_care']===true )  || (!!first['fields']['prodotto_singolo'] && first['fields']['prodotto_singolo']===true)),
  no_asc=( !!first['fields']['no_area_skin_care'] && first['fields']['no_area_skin_care']===true ),
  singolo=!!first['fields']['prodotto_singolo'] && first['fields']['prodotto_singolo']===true,
  no_or_single=( !!first['fields']['no_area_skin_care'] && first['fields']['no_area_skin_care']===true )   || (!!first['fields']['riservato'] && first['fields']['riservato']===true),
  riservato=!!first['fields']['riservato'] && first['fields']['riservato']===true;

  %>
      <div class="background-container specialita">
      <% var claim=no_asc?first['fields']['claim_']:first['area-skin-care']['fields']['claim_']; %>
        <%= claim %>
        <%= first['thumbnail'] %>

      </div>

 <div class="content">


                              <div class="desc">


        <div class="down-nav">
<div class="line">
          <span class="prev"><a href="<%= prev.permalink %>" title=""><svg class="svg-icon" viewBox="0 0 20 20">
              <path fill="none" d="M8.388,10.049l4.76-4.873c0.303-0.31,0.297-0.804-0.012-1.105c-0.309-0.304-0.803-0.293-1.105,0.012L6.726,9.516c-0.303,0.31-0.296,0.805,0.012,1.105l5.433,5.307c0.152,0.148,0.35,0.223,0.547,0.223c0.203,0,0.406-0.08,0.559-0.236c0.303-0.309,0.295-0.803-0.012-1.104L8.388,10.049z"></path>
            </svg></a></span><span class="title" ><%= first.title %></span><span class="next"><a href="<%= next.permalink %>" title=""><svg class="svg-icon" viewBox="0 0 20 20">
              <path fill="none" d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
            </svg></a></span></div></div>

               <% attivi=first['fields']['attivi_di_linea']; if(attivi && attivi instanceof Array&&attivi.length ){ %>
               <div class="attivi-wrapper">
               <h3>Gli Attivi di Linea </h3>
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

            <div class="content-wrapper <% if(first['prodotti'].length===0){ %> <%= 'single-product-wrapper' %> <% } %>">
                <% if(!no_or_single){ %>
                  <h3>Trattamenti coadiuvanti per <a href="<%= first['area-skin-care']['permalink'] %>" title=""><%= first['area-skin-care']['title'] %></a></h3>
                <% } %>
                <div class="products">
                  <% _.each(first.prodotti,function(prod,key){ %>
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
                          <a href="http://localhost/biogena/area-riservata/" class="ajax-popup-link" title="">Accedi alla nostra area riservata.</a>
                        <% }else{ %>
                          <a href="<%= prod['permalink'] %>" title="">Vai alla scheda prodotto</a>
                        <% } %>
                        </div>
                      </div>
                    </div>
                  <% } )%>

        <% if(first['prodotti'].length===0){ %>
 <div class="single-linea"> </div>
<%        } %>
      </div>
              </div>
 </div>
 </script>
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
                <h3>Parliamo di...</h3>
                <div class="flag-body collapsed"><%= first['content'] %><% if((first['content'].match(/<\/p>/g) || []).length>1){ %><span class="readmore-box1">Leggi Tutto</span><% } %> </div>
              </div><div class="box2 boxx">
                <h3>La soluzione Biogena</h3>
                <div class="soluzione-text">Garantiamo al consumatore prodotti e soluzioni che soddisfano i più elevati standard di qualità, sicurezza ed efficacia e di innovazione scientifica.<span class="readmore-box2">Leggi Tutto</span></div>
              </div><div class="box3 boxx">
                <h3>FAQ</h3>
                <div class="soluzione-text">Garantiamo al consumatore prodotti e soluzioni che soddisfano i più elevati standard di qualità, sicurezza ed efficacia e di innovazione scientifica.<span class="readmore-box2">Leggi Tutto</span></div>
              </div>
              </div>
              <div class="slideshow correlati">
              <hr>
          <h4>  Scopri <%= first.linea.title %>  </h4>
<hr>
              <% if(first['prodotti'].length>1){ %>
                <div class=" slider-patologie2 active <%= first['prodotti'].length===2?'two':'three' %>" >
<% }else { %> <%= '<div class=" no-slider " >' %><% } %>
                    <div class="swiper-wrapper">
                  <% _.each(first.prodotti,function(prod){ %>
                                <div class="swiper-slide"><a href="<%= prod.permalink %>"><%= prod.thumbnail %> <div><h3><%= prod.title %> </h3> </div> </a></div>
                  <% } )%>
                    </div>
              <% if(first['prodotti'].length>1){ %>
                                  <div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div>
              <% } %>

                </div>
          </div>

</main>

 </script>
