<script id="linee" type="text/template" >
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
               <div class="attivi-wrapper">
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
                <% if(!no_or_single){ %>
                  <h3><?php _e("Trattamenti coadiuvanti per","sage"); ?> <a href="<%= first['area-skin-care']['permalink'] %>" title=""><%= first['area-skin-care']['title'] %></a></h3>
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