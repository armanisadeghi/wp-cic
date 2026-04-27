<?php
/**
 * Clean Divi Header (secure version)
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>

<meta charset="<?php bloginfo( 'charset' ); ?>" />

<?php
    elegant_description();
    elegant_keywords();
    elegant_canonical();
?>

<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<!-- Font Preload -->
<link rel="preload" href="<?php echo site_url(); ?>/wp-content/themes/divi-child/fonts/open-sans-v26-latin-regular.woff2" as="font" type="font/woff2" crossorigin>
<link rel="preload" href="<?php echo site_url(); ?>/wp-content/themes/divi-child/fonts/open-sans-v26-latin-600.woff2" as="font" type="font/woff2" crossorigin>
<link rel="preload" href="<?php echo site_url(); ?>/wp-content/themes/divi-child/fonts/lato-v20-latin-regular.woff2" as="font" type="font/woff2" crossorigin>
<link rel="preload" href="<?php echo site_url(); ?>/wp-content/themes/divi-child/fonts/lato-v20-latin-300.woff2" as="font" type="font/woff2" crossorigin>

<?php wp_head(); ?>

<!-- Facebook Pixel -->
<script>
!function(f,b,e,v,n,t,s){
if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)
}(window, document,'script',
'https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '735045333751939');
fbq('track', 'PageView');
</script>

<!-- Google Tag Manager -->
<script>
(function(w,d,s,l,i){
w[l]=w[l]||[];
w[l].push({'gtm.start': new Date().getTime(), event:'gtm.js'});
var f=d.getElementsByTagName(s)[0],
j=d.createElement(s), dl=l!='dataLayer'?'&l='+l:'';
j.async=true;
j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;
f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-MQ5T38WG');
</script>

</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page-container">

<header id="main-header">
    <div class="container clearfix et_menu_container">

        <?php
        $logo = ( $user_logo = et_get_option( 'divi_logo' ) ) && ! empty( $user_logo )
            ? $user_logo
            : get_template_directory_uri() . '/images/logo.png';
        ?>

        <div class="logo_container">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                <img src="<?php echo esc_url( $logo ); ?>" alt="<?php bloginfo( 'name' ); ?>" id="logo" />
            </a>
        </div>

        <div id="et-top-navigation">

            <nav id="top-menu-nav">
                <?php
                wp_nav_menu( array(
                    'theme_location' => 'primary-menu',
                    'container' => '',
                    'menu_class' => 'nav',
                    'menu_id' => 'top-menu'
                ) );
                ?>
            </nav>

            <div id="et_top_search">
                <span id="et_search_icon"></span>
            </div>

        </div>

    </div>
</header>

<div id="et-main-area">