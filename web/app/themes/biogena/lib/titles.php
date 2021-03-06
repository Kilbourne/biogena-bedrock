<?php

namespace Roots\Sage\Titles;

/**
 * Page titles
 */
function title() {
  if (is_home()) {
    if (get_option('page_for_posts', true)) {
      return get_the_title(get_option('page_for_posts', true));
    } else {
      return __('Ultimi post', 'sage');
    }
  } elseif (is_archive()) {
    return get_the_archive_title();
  } elseif (is_search()) {
    return sprintf(__('Risultati di ricerca per %s', 'sage'), get_search_query());
  } elseif (is_404()) {
    return __('Collegamento non trovato', 'sage');
  } else {
    return get_the_title();
  }
}
