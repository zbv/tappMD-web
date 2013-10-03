<?php

		$typography_font_content = csc_option('csc_font_content');
		if($typography_font_content) {
           $font_content = $typography_font_content['face'];
		   $fontFamily_font_content = str_replace('+', ' ', $font_content);
		   $fontSize_font_content = $typography_font_content['size']; 
		   $fontColor_font_content = $typography_font_content['color'];
		   $fontStyle_font_content = $typography_font_content['style']; 
	    }
		
		$typography_font_title_page = csc_option('csc_font_title_page');
		if($typography_font_title_page) {
           $font_title_page = $typography_font_title_page['face'];
		   $fontFamily_font_title_page = str_replace('+', ' ', $font_title_page);
		   $fontSize_font_title_page = $typography_font_title_page['size']; 
		   $fontColor_font_title_page = $typography_font_title_page['color'];
		   $fontStyle_font_title_page = $typography_font_title_page['style']; 
	    }
		
		$typography_font_title_page2 = csc_option('csc_font_title_page2');
		if($typography_font_title_page2) {
           $font_title_page2 = $typography_font_title_page2['face'];
		   $fontFamily_font_title_page2 = str_replace('+', ' ', $font_title_page2);
		   $fontSize_font_title_page2 = $typography_font_title_page2['size']; 
		   $fontColor_font_title_page2 = $typography_font_title_page2['color'];
		   $fontStyle_font_title_page2 = $typography_font_title_page2['style']; 
	    }
		
		$typography_font_title_page3 = csc_option('csc_font_title_page3');
		if($typography_font_title_page3) {
           $font_title_page3 = $typography_font_title_page3['face'];
		   $fontFamily_font_title_page3 = str_replace('+', ' ', $font_title_page3);
		   $fontSize_font_title_page3 = $typography_font_title_page3['size']; 
		   $fontColor_font_title_page3 = $typography_font_title_page3['color'];
		   $fontStyle_font_title_page3 = $typography_font_title_page3['style']; 
	    }
		
		//$typography_font_content_links = csc_option('csc_font_content_links');
//		if($typography_font_content_links) {
//           $font_content_links = $typography_font_content_links['face'];
//		   $fontFamily_font_content_links = str_replace('+', ' ', $font_content_links);
//		   $fontSize_font_content_links = $typography_font_content_links['size']; 
//		   $fontColor_font_content_links = $typography_font_content_links['color'];
//		   $fontStyle_font_content_links = $typography_font_content_links['style'];
//	    }
		
		$typography_font_title_pages = csc_option('csc_page_title');
		if($typography_font_title_pages) {
           $font_title_pages = $typography_font_title_pages['face'];
		   $fontFamily_font_title_pages = str_replace('+', ' ', $font_title_pages);
		   $fontStyle_font_title_pages = $typography_font_title_pages['style']; 
		   $fontColor_font_title_pages = $typography_font_title_pages['color'];
		   $fontSize_font_title_pages = $typography_font_title_pages['size'];
	    }
		
		
		$typography_font_title_menu = csc_option('csc_menu_fonts');
		if($typography_font_title_menu) {
           $font_title_menu = $typography_font_title_menu['face'];
		   $fontFamily_font_title_menu = str_replace('+', ' ', $font_title_menu);
		   $fontStyle_font_title_menu = $typography_font_title_menu['style']; 
		   $fontColor_font_title_menu = $typography_font_title_menu['color'];
		   $fontSize_font_title_menu = $typography_font_title_menu['size'];
	    }
		
		//$typography_font_title_slogan = csc_option('csc_font_title_slogan');
//		if($typography_font_title_slogan) {
//           $font_title_slogan = $typography_font_title_slogan['face'];
//		   $fontFamily_font_title_slogan = str_replace('+', ' ', $font_title_slogan);
//		   $fontStyle_font_title_slogan = $typography_font_title_slogan['style']; 
//		   $fontColor_font_title_slogan = $typography_font_title_slogan['color'];
//		   $fontSize_font_title_slogan = $typography_font_title_slogan['size'];
//	    }
		
		$typography_font_title_body = csc_option('csc_font_title_body');
		if($typography_font_title_body) {
           $font_title_body = $typography_font_title_body['face'];
		   $fontFamily_font_title_body = str_replace('+', ' ', $font_title_body);
		   $fontStyle_font_title_body = $typography_font_title_body['style']; 
		   $fontColor_font_title_body = $typography_font_title_body['color'];
		   $fontSize_font_title_body = $typography_font_title_body['size'];
	    }
		
		$typography_font_logo = csc_option('csc_font_logo');
		if($typography_font_logo) {
           $font_logo = $typography_font_logo['face'];
		   $fontFamily_font_logo = str_replace('+', ' ', $font_logo);
		   $fontStyle_font_logo = $typography_font_logo['style']; 
		   $fontColor_font_logo = $typography_font_logo['color'];
		   $fontSize_font_logo = $typography_font_logo['size'];
	    }
		
		$typography_font_sub_logo = csc_option('csc_font_sub_logo');
		if($typography_font_sub_logo) {
           $font_sub_logo = $typography_font_sub_logo['face'];
		   $fontFamily_font_sub_logo = str_replace('+', ' ', $font_sub_logo);
		   $fontStyle_font_sub_logo = $typography_font_sub_logo['style']; 
		   $fontColor_font_sub_logo = $typography_font_sub_logo['color'];
		   $fontSize_font_sub_logo = $typography_font_sub_logo['size'];
	    }

?>
