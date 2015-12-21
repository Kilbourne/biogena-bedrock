 <script id="linee" type="text/template" >
<div class="background-container">
<%= first['thumbnail'] %>
<%= first['area-skin-care']['fields']['claim_'] %>
 </div>
 <div class="content">


                              <div class="desc">
               <div class="desc-text">     <%= first['content'] %></div>
                                 <hr >
        <div class="down-nav">
<div class="line">
          <span class="prev"><a href="<%= prev.permalink %>" title=""><svg class="svg-icon" viewBox="0 0 20 20">
              <path fill="none" d="M8.388,10.049l4.76-4.873c0.303-0.31,0.297-0.804-0.012-1.105c-0.309-0.304-0.803-0.293-1.105,0.012L6.726,9.516c-0.303,0.31-0.296,0.805,0.012,1.105l5.433,5.307c0.152,0.148,0.35,0.223,0.547,0.223c0.203,0,0.406-0.08,0.559-0.236c0.303-0.309,0.295-0.803-0.012-1.104L8.388,10.049z"></path>
            </svg></a></span>

            <span class="title" ><%= first.title %></span><span class="next"><a href="<%= next.permalink %>" title=""><svg class="svg-icon" viewBox="0 0 20 20">
              <path fill="none" d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
            </svg></a></span></div></div>
            <hr >
               <% attivi=first['fields']['attivi_di_linea']; if(attivi && attivi instanceof Array&&attivi.length ){ %>
               <div class="attivi-wrapper">
               <h3>Attivi di Linea </h3>
               <ul class="attivi">

                 <% _.each(attivi ,function(attivo,i){
                 image=attivo['immagine_attivo'];
                 count=attivi.length;
                 if(attivi.length>4){count=4;}
                 %>
                   <li class="attivo inline-block <%= 'w'+count %>"><img src="<%= image['url'] %>" alt="<%= image ['alt'] %>" /><%= attivo['attivo'] %></li>
                  <% }) %>
               </ul>
               </div>
               <% } %>
               </div>

            <div class="content-wrapper">
                <h3>Trattamento coadiuvante per <a href="<%= first['area-skin-care']['permalink'] %>" title=""><%= first['area-skin-care']['title'] %></a></h3>
                <div class="products">


                  <% _.each(first.prodotti,function(prod,key){ %>
                                <div class="product flag-media <%= key % 2 == 0?'odd':'even' %>"><a href="<%= prod.permalink %>"><div><h3><%= prod.title %> </h3> </div> </a><div class="flag-thumb"><a href="<%= prod.permalink %>"> <%= prod.thumbnail %></a> </div><div class="flag-body"><%= prod.content %><div class="more"><a href="<%= prod['permalink'] %>" title="">Vai alla scheda prodotto</a> </div></div> </div>
                  <% } )%>
                  </div>
              </div>




 </script>
  <script id="area-skin-care" type="text/template" >

 <div class="background-container">
 <img  class="attachment-post-thumbnail wp-post-image" src="<%= first['fields']['immagine_full_width']['url'] %>" alt="">
 <%= first.fields.claim_ %>
 </div>


 <div class="content">
        <div class="down-nav">
<div class="line">
          <span class="prev"><a href="<%= prev.permalink %>" title=""><svg class="svg-icon" viewBox="0 0 20 20">
              <path fill="none" d="M8.388,10.049l4.76-4.873c0.303-0.31,0.297-0.804-0.012-1.105c-0.309-0.304-0.803-0.293-1.105,0.012L6.726,9.516c-0.303,0.31-0.296,0.805,0.012,1.105l5.433,5.307c0.152,0.148,0.35,0.223,0.547,0.223c0.203,0,0.406-0.08,0.559-0.236c0.303-0.309,0.295-0.803-0.012-1.104L8.388,10.049z"></path>
            </svg></a></span>

            <span class="title" ><%= first.title %></span><span class="next"><a href="<%= next.permalink %>" title=""><svg class="svg-icon" viewBox="0 0 20 20">
              <path fill="none" d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
            </svg></a></span></div></div>
            <hr>
            <div class="content-wrapper">
                <div class="flag-media">

                 <div class="flag-body"><%= first.content %></div>
                </div>

          <hr>
          <div class="inline-block prevenzione" >
            <h3>La soluzione Biogena</h3><div class="flag-media">

                 <div class="flag-body"><p><%= first.fields.prevenzione %></p></div></div>
          </div><div class="inline-block lineas" >

          <a href="<%= first.linea.permalink %> " title="">

          <%= first.linea.thumbnail %>
          </a>
          </div>
                                             <% attivi=first['linea']['fields']['attivi_di_linea']; if(attivi && attivi instanceof Array&&attivi.length ){ %>
               <div class="attivi-wrapper">
               <h3>Attivi di Linea </h3>
               <ul class="attivi">

                 <% _.each(attivi ,function(attivo,i){
                 image=attivo['immagine_attivo'];
                 %>
                   <li class="attivo inline-block"><div class="attivo-img-container"> <img src="<%= image['url'] %>" alt="<%= image ['alt'] %>" /></div><div class="attivo-desc-body">
                     <h3><%= attivo['attivo'] %></h3>
                     <div class="attivo desc"><%= attivo['descrizione_attivo'] %></div>
                   </div> </li>
                  <% }) %>
               </ul>
               </div>
                <% } %>
          <hr>
          <div class="slideshow correlati">
          <h4>  Scopri la linea <%= first.linea.title %>  </h4>

                <div class=" slider-patologie active three" >
                    <div class="swiper-wrapper">
                  <% _.each(first.prodotti,function(prod){ %>
                                <div class="swiper-slide"><a href="<%= prod.permalink %>"><%= prod.thumbnail %> <div><h3><%= prod.title %> </h3> </div> </a></div>
                  <% } )%>
                    </div>
<div class="navigation"></div>
                </div>
          </div>
              </div>

</main>

 </script>
