<?php
$postid = get_the_ID();
get_header();
$upid = $post->post_author;
$user_info = get_userdata($upid);
$avt = get_field('user_avatar', 'user_' . $upid);
$author_url = get_author_posts_url($upid);
$medically_reviewed = get_field('select_author', $postid);
$couponid = !empty($_GET['couponid']) ? $_GET['couponid'] : '';
the_post();
$post_terms = wp_get_post_terms($postid, 'category');
$author_id = get_post_field('post_author', $postid);
$display_name = get_the_author_meta('nickname', $upid);
$author_url = get_author_posts_url($upid);
$post_type = $post->post_type;
$user_description = get_field('story', 'user_' . $upid);
?>
<main id="content">
    <div class="container">
        <div class="single-top">
            <div class="list-flex flex-center flex-middle">
                <?php
                if (function_exists('yoast_breadcrumb')) {
                    yoast_breadcrumb('<div id="breadcrumbs" class="breacrump">', '</div>');
                }
                ?>
            </div>
        </div>
        <div class="single-main list-flex">
            <?php get_sidebar(); ?>
            <div class="sg-right">
                <h1><?php the_title(); ?></h1>
                <div class="social on-pc">
                    <p class="has-small-font-size pri-color-2" style="margin-bottom: 0">Follow us: </p>
                    <?php
                    $social = get_field('social', 'option');
                    if ($social) {
                        foreach ($social as $social) {
                            ?>
                            <a target="_blank" href="<?php echo $social['link']; ?>"><img
                                    src="<?php echo $social['icon']; ?>" /></a>
                        <?php }
                    } ?>
                </div>
                <article class="sg-custom">
                    <?php $coupon_list = get_field('coupon_list', $postid);
                    if ($coupon_list) {
                        $c1 = $coupon_list[0];
                        $ctype = wp_get_post_terms($c1, 'coupon_type');
                        $date_type = get_field('date_type', $c1);
                        $date_ex = get_field('coupon_date', $c1);
                        if ($date_ex) {
                            $date_current = strtotime(date('Y-m-d'));
                            $date_ex = strtotime($date_ex);
                        }
                        ?>
                        <div class="line-content"></div>
                        <div class="hot-deal">
                            <h2>Exclusive for Blurt's Community</h2>
                            <div class="coupon-item-detail all coupon">
                                <div class="coupon-top hot-deal">
                                    <div class="flex">
                                        <div class="hightlight relative-section">
                                            <div class="inner">
                                                <div class="coupon-special text-center">
                                                    <?php
                                                    $originalString = get_field('coupon_text', $c1);
                                                    preg_match('/<span>(.*?)<\/span>/', $originalString, $matches);
                                                    $remainingString = str_replace($matches[0], '', $originalString);
                                                    if (isset($matches[1])) {
                                                        $content = $matches[1];

                                                        $number = '';
                                                        $specialChar = '';

                                                        for ($i = 0; $i < strlen($content); $i++) {
                                                            $char = $content[$i];
                                                            // Kiểm tra nếu là ký tự số
                                                            if (is_numeric($char)) {
                                                                $number .= $char;
                                                            } else {
                                                                $specialChar .= $char;
                                                            }
                                                        }

                                                        // Tạo hai thẻ span mới
                                                        $span1 = "<span class='number-coupon'>" . $number . "</span>";
                                                        $span2 = "<span>" . $specialChar . "</span>" . $remainingString;

                                                        // In ra kết quả
                                                        echo $span1 . $span2;
                                                    } else {
                                                        echo get_field('coupon_text', $c1);
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="action">
                                                <a href="<?php echo get_field('coupon_link', $c1); ?>"
                                                    class="get-code text-uppercase" data-id="<?php echo $c1; ?>"
                                                    target="_blank"><span><?php echo get_field('coupon_btn', $c1); ?></span></a>
                                            </div>
                                            <div class="date has-small-font-size pri-color-2 <?php if ($date_type == 1 && $date_current > $date_ex)
                                                echo 'has-expired'; ?>">
                                                Expired:
                                                <?php if ($date_type == 1)
                                                    echo get_field('coupon_date', $c1);
                                                else
                                                    echo "Doesn't expire"; ?>
                                            </div>
                                        </div>
                                        <div class="info">
                                            <div class="relative-section">
                                                <p class="has-large-font-size"><?php echo get_the_title($c1); ?></p>
                                            </div>
                                            <div class="des">
                                                <?php echo get_field('coupon_description', $c1); ?>
                                            </div>
                                            <div class="relative-section mail-ds">
                                                <a style="text-decoration: none"
                                                    href="mailto:?subject=<?php echo get_permalink($postid); ?>"
                                                    class="send-mail">Send to my email</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        if (count($coupon_list) > 1) { ?>
                            <div class="offers">
                                <h2>Offers for you</h2>
                                <?php foreach ($coupon_list as $c => $cp) {
                                    if ($c > 0) {
                                        $ctype = wp_get_post_terms($cp, 'coupon_type');
                                        $date_type = get_field('date_type', $cp);
                                        $date_ex = get_field('coupon_date', $cp);
                                        if ($date_ex) {
                                            $date_change = new DateTime($date_ex);
                                            $date_current = strtotime(date('Y-m-d'));
                                            $date_ex = strtotime($date_ex);
                                        }
                                        $ct = $cp;
                                        ?>
                                        <div class="coupon-item-detail all coupon-light coupon">
                                            <div class="coupon-top offers">
                                                <div class="flex">
                                                    <div class="hightlight relative-section">
                                                        <div class="inner">
                                                            <div class="coupon-special text-center">
                                                                <?php
                                                                $originalString = get_field('coupon_text', $cp);
                                                                preg_match('/<span>(.*?)<\/span>/', $originalString, $matches);
                                                                $remainingString = str_replace($matches[0], '', $originalString);
                                                                if (isset($matches[1])) {
                                                                    $content = $matches[1];

                                                                    $number = '';
                                                                    $specialChar = '';

                                                                    for ($i = 0; $i < strlen($content); $i++) {
                                                                        $char = $content[$i];
                                                                        // Kiểm tra nếu là ký tự số
                                                                        if (is_numeric($char)) {
                                                                            $number .= $char;
                                                                        } else {
                                                                            $specialChar .= $char;
                                                                        }
                                                                    }

                                                                    // Tạo hai thẻ span mới
                                                                    $span1 = "<span class='number-coupon'>" . $number . "</span>";
                                                                    $span2 = "<span>" . $specialChar . "</span>" . $remainingString;

                                                                    // In ra kết quả
                                                                    echo $span1 . $span2;
                                                                } else {
                                                                    echo get_field('coupon_text', $c1);
                                                                }
                                                                ?>
                                                            </div>
                                                        </div>
                                                        <div class="action">
                                                            <a href="<?php echo get_field('coupon_link', $c1); ?>"
                                                                class="get-code text-uppercase" data-id="<?php echo $c1; ?>"
                                                                target="_blank"><span><?php echo get_field('coupon_btn', $c1); ?></span></a>
                                                        </div>
                                                        <div class="date <?php if ($date_type == 1 && $date_current > $date_ex)
                                                            echo 'has-expired'; ?>">
                                                            Expired:
                                                            <?php if ($date_ex)
                                                                echo $date_change->format('d F, Y');
                                                            else
                                                                echo "Doesn't expire"; ?>
                                                        </div>
                                                </div>
                                                <div class="info">
                                                    <div class="relative-section">
                                                        <p class="has-large-font-size"><?php echo get_the_title($cp); ?></p>
                                                    </div>
                                                    <div class="des">
                                                        <?php echo get_field('coupon_description', $cp); ?>
                                                    </div>
                                                    <div class="relative-section mail-ds">
                                                        <a style="text-decoration: none"
                                                            href="mailto:?subject=<?php echo get_permalink($postid); ?>"
                                                            class="send-mail">Send to my email</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php }
                                } ?>
                    </div>
                <?php }
                    } ?>
            <div class="sg-editor">
                <?php the_content(); ?>
            </div>
            <?php
            if (get_field('enable_source', 'option') == true && $checktime == false) {
                ?>
                <div class="sg-resources box-grey pd-main on-pc">
                    <h4>Resources</h4>
                    <div class="intro">
                        <?= get_field('source_intro', 'option'); ?>
                    </div>
                    <?php $source_content = get_field('source_content', $postid);
                    if ($source_content)
                        echo $source_content;
                    ?>
                </div>
            <?php } ?>
            <div class="author-about pd-main">
                <h3>About the Author</h3>
                <div class="author-write">
                    <div class="author-link">
                        <?php
                        if ($avt) {
                            ?>
                            <a href="<?php echo $author_url; ?>"><img src="<?php echo $avt; ?>" alt=""></a>
                        <?php } else { ?>
                            <a href="<?php echo $author_url; ?>"><img
                                    src="<?php echo get_field('avatar_default', 'option'); ?>" alt="">
                            <?php } ?>
                            <p class="has-large-font-size"><a style="color: var(--pri-color-2) !important;"
                                    href="<?php echo $author_url; ?>"><?php the_author(); ?>
                                </a>
                                <span class="has-small-font-size sec-color-3">
                                    <?php echo get_field('position', 'user_' . $author_id);
                                    ; ?></span>
                            </p>
                            <div class="social-author">
                                <?php
                                $user_linkedin = get_field('user_linkedin', 'user_' . $author_id);
                                $user_website = get_field('user_website', 'user_' . $author_id);
                                $user_fb = get_field('user_fb', 'user_' . $author_id);
                                $user_instagram = get_field('user_instagram', 'user_' . $author_id);
                                $user_twitter = get_field('user_twitter', 'user_' . $author_id);
                                ?>
                                <?php if ($user_linkedin) { ?><a class="share-linkedin"
                                        href="<?php echo $user_linkedin; ?>" target="_blank" rel="noopener"><img
                                            src="<?php echo get_template_directory_uri(); ?>/assets/img/so-linkein.svg"
                                            alt=""></a><?php } ?>
                                <?php if ($user_website) { ?><a class="share-link" href="<?php echo $user_website; ?>"
                                        target="_blank" rel="noopener"><img
                                            src="<?php echo get_template_directory_uri(); ?>/assets/img/so-website.svg"
                                            alt=""></a><?php } ?>
                                <?php if ($user_fb) { ?><a class="share-linkedin" href="<?php echo $user_fb; ?>"
                                        target="_blank" rel="noopener"><img
                                            src="<?php echo get_template_directory_uri(); ?>/assets/img/so-facebook.svg"
                                            alt=""></a><?php } ?>
                                <?php if ($user_instagram) { ?><a class="share-linkedin"
                                        href="<?php echo $user_instagram; ?>" target="_blank" rel="noopener"><img
                                            src="<?php echo get_template_directory_uri(); ?>/assets/img/so-instagram.svg"
                                            alt=""></a><?php } ?>
                                <?php if ($user_twitter) { ?><a class="share-linkedin"
                                        href="<?php echo $user_twitter; ?>" target="_blank" rel="noopener"><img
                                            src="<?php echo get_template_directory_uri(); ?>/assets/img/so-twitter.svg"
                                            alt=""></a><?php } ?>
                            </div>
                    </div>
                    <?php if ($user_description) { ?>
                        <div class="author-info">
                            <p><?php echo $user_description ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
            </article>
        </div>
    </div>
    </div>
</main>
<?php
if (isset($couponid) && $couponid != '') {
    $keyid = $postid;
    $brandid = $_GET['couponid'];
    $post_brand = wp_get_post_terms($brandid, 'brand');
    $brand_link = get_field('brand_link', $post_brand[0]);
    $date_type2 = get_field('date_type', $brandid);
    ?>
    <div class="modal fade" id="couponModal" tabindex="-1" role="dialog" aria-labelledby="couponModalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="show-code-top">
                        <div class="coupon-top">
                            <?php $logo = get_field('logo', 'option'); ?>
                            <img src="<?php echo $logo; ?>" alt="logo">
                            <p>Exp:
                                <?php if ($date_type2 == 1)
                                    echo get_field('coupon_date', $brandid);
                                else
                                    echo "Doesn't expire"; ?>
                            </p>
                        </div>
                        <p class="has-large-font-size text-center"><?php echo get_the_title($brandid); ?></p>
                        <div class="coupon-md-form">
                            <p><b>1</b> Copy this promo code <a href="<?php echo $brand_link; ?>" target="_blank"></a></p>
                            <div class="coupon-copy">
                                <input class="coupon-code" id="couponCode"
                                    value="<?php echo get_field('coupon_code', $brandid); ?>" disabled />
                                <a href="" class="copy btn">Copy</a>
                            </div>
                        </div>
                        <div class="coupon-md-form">
                            <p><b>2</b> Paste the code when you are at the checkout</p>
                        </div>
                        <div class="coupon-md-form">
                            <p><b>3</b> Let us know if <a href="">it worked</a> or <a href="">didn’t work</a></p>
                        </div>
                        <div class="text-center coupon-btn-pink">
                            <a href="<?php echo get_field('coupon_link', $brandid); ?>">Go to offer</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php }
get_footer();
if (isset($couponid) && $couponid != '') {
    ?>
    <script>
        jQuery(function ($) {
            $('#couponModal').modal('show');
            $('.coupon-rate').on('click', function () {
                $(this).parents('li').find('span').html('Thank you for responding.');
                $ctitle = '<?php echo get_the_title($brandid); ?>';
                $ptitle = '<?php echo get_the_title($postid); ?>';
                $crstate = 'Worked';
                if ($(this).hasClass('coupon-dontworked')) $crstate = 'Didn’t worked';
                $('#rateCouponTitle').attr('value', $ctitle).val($ctitle);
                $('#rateCouponPost').attr('value', $ptitle).val($ptitle);
                $('#rateCouponStatus').attr('value', $crstate).val($crstate);
                $('#crateSubmit').click();
                return false;
            });
        });
    </script>
<?php }
$enable_schma = get_field('enable_schma', $postid);
if ($enable_schma == true && get_field('rating_enable', $postid) == true) {
    $schema_type = get_field('schema_type', $postid);
    if ($schema_type == 'Product') {
        $schema_product = get_field('schema_product', $postid);
        ?>
        <script>
            jQuery(function ($) {
                var bodyt = $('.extra-content h2').first().next().text();
                var html = '<script type="application/ld+json">' +
                    '{' +
                    '"@type": "Product",' +
                    '"name": "<?php echo $schema_product['agg_name']; ?>",' +
                    '"image": "<?php the_post_thumbnail_url(); ?>",' +
                    '"url": "<?php the_permalink(); ?>",' +
                    '"sku": "<?php echo $schema_product['sku']; ?>",' +
                    '"mpn": "<?php echo $schema_product['global_identifier']; ?>",' +
                    '"brand": {' +
                    '"@type": "Brand"' +
                    '},' +
                    '"aggregateRating": {' +
                    '"@type": "AggregateRating",' +
                    '"bestRating": "<?php echo $schema_product['agg_bestrating']; ?>",' +
                    '"ratingValue": "<?php echo $rating_tb; ?>",' +
                    '"reviewCount": "<?php echo $rating_number; ?>"' +
                    '},' +
                    '"description": "' + bodyt + '",' +
                    '"@context": "https://schema.org"';
                var offers_check = '<?php echo $schema_product['offer_currency']; ?>';
                if (offers_check != '') html += '"offers": {' +
                    '"@type": "AggregateOffer",' +
                    '"priceCurrency": "<?php echo $schema_product['offer_currency']; ?>",' +
                    '"price": "<?php echo $schema_product['offer_price']; ?>",' +
                    '"highPrice": "<?php echo $schema_product['offer_highprice']; ?>",' +
                    '"lowPrice": "<?php echo $schema_product['offer_lowprice']; ?>",' +
                    '"offerCount": "<?php echo $schema_product['offer_offercount']; ?>"' +
                    '}';
                html += '}';
                $('head').append(html);
            });
        </script>
    <?php }
} ?>
<script>
    jQuery(function ($) {
        $('.get-code').on('click', function () {
            var id = $(this).attr('data-id');
            if (id) window.open('<?php echo get_permalink($postid); ?>?couponid=' + id, '_blank');
        });
        $('.filter-nav a').on('click', function () {
            $('.filter-nav a').removeClass('active');
            $(this).addClass('active');
            $claa = $(this).find('input').val();
            if ($claa == 'all') $('.primary-content .coupon-item-detail').show();
            else {
                $('.primary-content .coupon-item-detail').hide();
                $('.primary-content .coupon-item-detail').each(function () {
                    if ($(this).hasClass($claa)) $(this).show();
                });
            }
            return false;
        });
        $('body').on('click', '.copy', function () {
            var copyText = document.getElementById("couponCode");
            copyText.select();
            copyText.setSelectionRange(0, 99999);
            navigator.clipboard.writeText(copyText.value);
            alert("Copied the text: " + copyText.value);
            return false;
        });
        $('.oil-item h3').each(function () {
            var ib = $(this).attr('id');
            $(this).prepend('<span>' + ib + '. </span>')
        });
        $('#couponRating').on('change', function () {
            $.ajax({
                url: '<?php echo get_option('home') ?>/',
                type: 'GET',
                cache: false,
                dataType: "json",
                data: {
                    keyid: <?php echo $postid; ?>,
                    keyval: $(this).val(),
                    'update_coupon_rating': true
                },
                success: function (data) {
                    $('.rating-info').html(data);
                    $('.rating-info input.rating').rating();
                    $('.rating-large').addClass('has-rating');
                }
            });
        });
        $('#ratingForm').on('submit', function () {
            $('#ratingForm .loading-json').show();
            $.ajax({
                url: '<?php echo get_option('home') ?>/',
                type: 'GET',
                cache: false,
                dataType: "json",
                data: {
                    keyid: <?php echo $postid; ?>,
                    keyname: $('#ratingName').val(),
                    keyrate: $('#ratingNumber').val(),
                    keycomt: $('#ratingCmt').val(),
                    'get_rating2': true
                },
                success: function (data) {
                    $('#ratingForm .loading-json').hide();
                    $('#ratingForm .alert').show();
                }
            });
            return false;
        });
    });
</script>