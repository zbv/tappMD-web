<?php
if (is_category()) {
	
$category_background='';
$category_ID = get_query_var('cat');
$category_color = get_tax_meta($category_ID,'ba_color_field_id');
$category_background = get_tax_meta($category_ID,'ba_image_field_id');	
?>
<style>
<?php	
if (!empty($category_color)) { echo('
nav#menu-top ul li.current-menu-item a, nav#menu-top ul li.current-category-ancestor a, nav#menu-top ul li.current-menu-parent a, nav#menu-top ul li.current-post-ancestor a, nav#menu-top ul.sub-menu,  nav#menu-top ul.sub-menu,nav#menu-top ul li.current-menu-item a, nav#menu-top ul li.current-category-ancestor a, nav#menu-top ul li.current-menu-parent a, nav#menu-top ul li.current-post-ancestor a,nav ul li.current-menu-item > a,nav#menu-top ul li.current-menu-item.sfHover > a:hover,.post-format span,.post-format-s span,.news-infop div.posts,.blog-meta .post-format span,#wp-calendar thead th,#col2cat a.button:hover,.scorehomebig,.scorehome,.widget-title h3,.pagenavi .current,.nav-tabs li.active a,.caption-static{background-color:'.$category_color.'  !important;}
#footers .tagcloud a:hover{background-color:'.$category_color.';color:#f8f8f8}
#magflexslider .slider-caption a h1, .flex-control-paging li a.flex-active, .flex-control-paging li a:hover, #magflexslider .flex-control-paging li a.flex-active, #magflexslider .flex-control-paging li a:hover{background-color:'.$category_color.';}
.nav-tabs > li.active > a,.nav-tabs > li.active > a:hover,.nav-tabs > li > a:hover  { border-top:'.$category_color.' 3px solid;}
.color_t,.breadcrumbs_menu .current{color:'.$category_color.';}
');
}?>
</style>

<?php if (!empty($category_background)) {

$category_src = $category_background['src'];
	
?>
<script type="text/javascript">
jQuery( function() {
	
jQuery.vegas( 'slideshow', { 

backgrounds:[ <?php echo '{ src:\''.$category_src.'\'},'?>],
fade: 10,
delay: 10,
valign:'center', 
align:'center' 
    
	});

});
</script>
<?php }?>
<?php } ?>