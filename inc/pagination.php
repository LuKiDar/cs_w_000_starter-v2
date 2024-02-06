<?php
/**
 * Pagination
 */

function cs__the_pagination( $type='' ){
    $links = paginate_links(array(
        'prev_text' => 'Previous',
        'next_text' => 'Next',
        'type' => 'array'
    ));

    if ( !empty($links) ){ ?>
        <nav class="pagination">
            <div class="nav-links">
                <?php if ( !strpos($links[0], 'Previous') ){ ?>
                    <span class="prev page-numbers disabled">Previous</span>
                <?php } ?>

                <?php foreach ( $links as $item ){ ?>    
                    <?= $item; ?>
                <?php } ?>

                <?php if ( !strpos($links[count($links)-1], 'Next') ){ ?>
                    <span class="next page-numbers disabled">Next</span>
                <?php } ?>

                <div class="break"></div>
            </div>
        </nav>
    <?php }
}