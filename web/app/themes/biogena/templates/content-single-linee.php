<?php $arrayC=biogenaData::data(get_the_permalink(),'linee'); $first=$arrayC->first;$next=$arrayC->next;$prev=$arrayC->prev; ?>
 <script id="patologia" type="text/template" >
      <% var first=arrayC[index],next=(index+1)<arrayC.length?index+1:0,prev=(index-1)>-1?(index-1):arrayC.length-1 %>
           <div class="flag-media">
                <div class="flag-thumb"><%= first.thumb %></div><div class="flag-body"><%  first.content = first.content.replace(/<\/?[^>]+(>|$)/g, "").trim();if(first.content==''||first.content=='I TRATTAMENTI COADIUVANTI' || first.content=='BIOGENA: I TRATTAMENTI COADIUVANTI'){first.content='Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'} %> <%= first.content  %></div>
                </div>
                  <hr>
        <div class="down-nav">
<div class="line">
          <span class="prev"><a href="<%= arrayC[prev].permalink %>" title=""><svg class="svg-icon" viewBox="0 0 20 20">
              <path fill="none" d="M8.388,10.049l4.76-4.873c0.303-0.31,0.297-0.804-0.012-1.105c-0.309-0.304-0.803-0.293-1.105,0.012L6.726,9.516c-0.303,0.31-0.296,0.805,0.012,1.105l5.433,5.307c0.152,0.148,0.35,0.223,0.547,0.223c0.203,0,0.406-0.08,0.559-0.236c0.303-0.309,0.295-0.803-0.012-1.104L8.388,10.049z"></path>
            </svg></a></span>

            <span class="title" ><%= first.title %></span><span class="next"><a href="<%= arrayC[next].permalink %>" title=""><svg class="svg-icon" viewBox="0 0 20 20">
              <path fill="none" d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
            </svg></a></span></div></div>
            <hr>
            <div class="content-wrapper">
                <h3>Trattamento coadiuvante per <a href="<%= first.right_obj_plink %>" title=""><%= first.right_obj_title %></a></h3>
                <div class="products">


                  <% _.each(first.conn_arr,function(prod){ %>
                                <div class="product flag-media"><div class="flag-thumb"> <a href="<%= prod.permalink %>"><%= prod.thumb %> <div><h3><%= prod.title %> </h3> </div> </a></div><div class="flag-body"><%= prod.content %></div> </div>
                  <% } )%>
                  </div>
              </div>




 </script>
 <div class="content">
                 <div class="flag-media">
                <div class="flag-thumb"><?php echo $first->thumb;?></div><div class="flag-body"><?php $content=strip_tags($first->content); if($content=='' || 'BIOGENA: I TRATTAMENTI COADIUVANTI'){$content='Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.';}echo $content; ?></div>
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
                                <div class="product flag-media"><div class="flag-thumb"> <a href="<?= $prod->permalink; ?>"><?= $prod->thumb; ?> <div><h3><?= $prod->title; ?> </h3> </div> </a></div><div class="flag-body"><?= $prod->content; ?></div> </div>
                  <?php } ?>
                  </div>
              </div>
 </div>