<?php

class Snowdog_SnowComparers_Model_Comparers_Google extends Snowdog_SnowComparers_Model_Scheme_CSV {

	public function getDeafultFieldSeparator() {
		return "\t";
	}

	public function getDefaultContent() {
		$content_array = array(
			'id' => 'sku',
			'title' => 'name',
			'link' => 'productUrl',
			'price' => 'finalPrice',
			'description' => 'description',
			// 'condition' => '',
			// 'gtin' => '',
			// 'brand' => '',
			'mpn' => 'sku',
			'image_link' => 'smallImage',
			//   'google_product_category' => '',
			//  'product_type' => '',
			// 'quantity' => '',
			//  'availability' => '',
			//  'shipping' => '',
			//  'tax' => '',
			// 'feature' => '',
			//  'online_only' => '',
			'manufacturer' => 'producer',
			//    'expiration_date' => '',
			//   'shipping_weight' => '',
			//    'product_review_average' => '',
			//   'product_review_count' => '',
			//   'genre' => '',
			//   'featured_product' => '',
			//   'excluded_destination' => '',
			//   'gender' => '',
			//	    'age_group' => '',
			//	    'item_group_id' => '',
			//	    'additional_image_link' => '',
			//	    'color' => '',
			//	    'material' => '',
			//	    'pattern' => '',
			//	    'size' => '',
			//	    'year' => '',
			//	    'author' => '',
			//	    'edition' => '',
			//	    'sale_price' => '',
			//	    'sale_price_effective_date' => '',
			//	    'adwords_grouping' => '',
			//	    'adwords_labels' => '',
			//	    'adwords_publish' => '',
			//	    'adwords_redirect' => '',
			//	    'adwords_queryparam ' => '',
		);

		$content = '';
		foreach ($content_array as $key => $value) {
			$content .= $key . ':' . $value . "\n";
		}
		return $content;
	}

}

