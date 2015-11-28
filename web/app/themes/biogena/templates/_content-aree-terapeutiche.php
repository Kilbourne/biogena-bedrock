<?php
  $results=array();
  $slug = get_post_field( 'post_name', get_post() );
  if($slug === 'aree-terapeutiche'){ $type='aree-terapeutiche';}
  $args = array(
  'posts_per_page'   => -1,
  'orderby'          => 'title',
  'order'            => 'ASC',
  'post_type'        => $type,
  );
  $posts_array = get_posts( $args );
  // if posts
  foreach ( $posts_array as $key=>$patologia ){
      $resp= new stdClass();
      $conn_arr=array();
      $connected = new WP_Query( array(
        'connected_type' => 'patologie_to_linee',
        'connected_items' => $patologia,
        'nopaging' => true
      ));

      if ( $connected->have_posts() ){
        // if more than one linea
        $linea=$connected->posts[0];

        $titolo_linea=$linea->post_title;
        $titolo_perma=get_permalink ( $linea->ID );
        $connected2 = get_posts( array(
          'connected_type' => 'linee_to_prodotti',
          'connected_items' => $linea,
          'nopaging' => true
        ));


        if ( count($connected2)>0 ){

          foreach ( $connected2 as $key2=>$prodotto ){


            $conn=new stdClass();
            $conn->title=$prodotto->post_title;
            $conn->permalink = get_post_permalink($prodotto->ID);
            $conn->thumb=get_the_post_thumbnail($prodotto->ID,'full');
            $conn_arr[]=$conn;

          }

        }

      }

      $resp->title = $patologia->post_title;
      $resp->permalink = get_post_permalink($patologia->ID);
      $resp->thumb=get_the_post_thumbnail(  $patologia->ID,'full');
       $resp->linea_title=$titolo_linea;
       $resp->linea_plink=$titolo_perma;
      $prevenzione=get_post_meta(  $patologia->ID,'prevenzione',true);
      $bits = explode("\n", $prevenzione);

$newstring = "<ul>";
foreach($bits as $bit)
{
  $newstring .= "<li><span>" . $bit . "</span></li>";
}
$newstring .= "</ul>";
      $resp->prevenzione= $newstring;
      $resp->conn_arr=$conn_arr;
      $resp->content=$patologia->post_content;
      $results[]=$resp;

  };
  wp_reset_postdata();
  $json = json_encode($results);
  wp_localize_script( 'sage/js', 'collegamenti', $json );
?>

 <script id="patologia" type="text/template" >
      <% var first=arrayC[index],next=(index+1)<arrayC.length?index+1:0,prev=(index-1)>-1?(index-1):arrayC.length-1 %>

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
                <%= first.content %>
          <hr>
          <div class="u-1/2 inline-block prevenzione" >
            <h3>Norme generali di prevenzione</h3><%= first.prevenzione %>
          </div><div class="u-1/2 inline-block lineas" >
          <a href="<%= first.linea_plink %> " title=""></a>

          <%= first.thumb %>
          <h3><%= first.linea_title %>  </h3>
          </div>
          <hr>
          <div class="slideshow correlati">
            <h3>  Prodotti Correlati </h3>
                <div class=" slider-patologie active" >
                    <div class="swiper-wrapper">
                  <% _.each(first.conn_arr,function(prod){ %>
                                <div class="swiper-slide"><a href="<%= prod.permalink %>"><%= prod.thumb %> <div><h3><%= prod.title %> </h3> </div> </a></div>
                  <% } )%>
                    </div>
                </div>
          </div>
              </div>



 </script>
 <div class="content"></div>
