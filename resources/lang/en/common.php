<?php

return [

    // header
    'home' => 'Home',
    'about' => 'About Us',
    'contact' => 'Contacts',
    'phone_time' => 'from 11:00 to 21:45. Delivery takes an average of 60 minutes.',
    'navigation' => 'Navigation',
    'menu' => 'Menu',
    'language' => 'Language',
    'cart' => 'Cart',
    'go_cart' => 'Go to cart',
    'go_back' => 'Continue shopping',
    'item_1' => 'item',
    'item_2' => 'items',
    'item_5' => 'items',

    // home
    'home_page_title' => 'Home',
    'home_page_description' => 'Welcome to SUSHIKO - the best sushi and rolls in Chisinau',

    // banners
    'home_ban_title_1' => 'Sushiko - sushi #1',
    'home_ban_description_1' => 'The best sushi in Chisinau. Fresh ingredients, traditional recipes',
    'home_ban_button_1' => 'View menu',

    'home_ban_title_2' => 'Free delivery',
    'home_ban_description_2' => 'Free delivery throughout Chisinau for orders over ' . config('shop.free_delivery_amount') . ' lei',
    'home_ban_button_2' => 'Order now',

    'home_ban_title_3' => 'Fresh rolls every day',
    'home_ban_description_3' => 'We make rolls only from fresh products. No frozen ingredients!',
    'home_ban_button_3' => 'Learn more',

    'home_ban_title_4' => 'Special offers',
    'home_ban_description_4' => 'New promotions and special combo sets every week',
    'home_ban_button_4' => 'View promotions',

    'home_ban_title_5' => 'Japanese cuisine',
    'home_ban_description_5' => 'Authentic recipes from our Japanese chefs',
    'home_ban_button_5' => 'Learn more',

    // seo
    'home_seo_title' => 'Sushi and rolls with delivery in Chisinau',
    'home_seo_des' => 'Sushiko is traditional Japanese cuisine using only fresh premium quality products. We prepare rolls according to authentic recipes and deliver quickly throughout Chisinau.',
    'home_seo_1_title' => 'Fresh products',
    'home_seo_1_des' => 'Only premium ingredients. Fish delivery every day.',
    'home_seo_2_title' => 'Fast delivery',
    'home_seo_2_des' => 'Delivery in 60 minutes. Free from ' . config('shop.free_delivery_amount') . ' lei.',
    'home_seo_3_title' => 'Masters of Their Craft',
    'home_seo_3_des' => 'Our chefs are experienced professionals. We cook with care and heart.',

    // cat
    'home_cat_title' => 'Our menu',
    'home_cat_des' => 'Choose a category and discover the world of Japanese cuisine',
    'home_cat_go' => 'Go',

    // menu
    'home_menu_not_item' => 'No products found',
    'home_menu_col_1' => 'item',
    'home_menu_col_2' => 'items',
    'home_menu_col_3' => 'items',
    'home_menu_more' => 'Details',
    'home_menu_in_cart' => 'Add to cart',

    // Contacts - page
    'contacts_page_title' => 'Contacts',
    'contacts_page_description' => 'Contact SUSHIKO - address, phone, working hours and contact form',
    'contacts_hero_title' => 'Contact Us',
    'contacts_hero_description' => 'We are always happy to answer your questions and suggestions. Choose a convenient way to contact us!',

    // ContactInfo component
    'contacts_info_title' => 'Our Contacts',
    'contacts_address_label' => 'Address',
    'contacts_address_text' => 'Ismail str. 10, Chisinau, Moldova',
    'contacts_phone_label' => 'Phone',
    'contacts_phone_number' => '+373 781 25 553',
    'contacts_email_label' => 'Email',
    'contacts_email_address' => 'sushikoevgheni@gmail.com',
    'contacts_hours_label' => 'Working Hours',
    'contacts_hours_weekdays' => 'Mon-Sun:',
    'contacts_hours_weekdays_time' => '11:00 - 21:45',
    'contacts_hours_weekend' => 'Sat-Sun:',
    'contacts_hours_weekend_time' => '11:00 - 00:00',
    'contacts_social_title' => 'Follow Us',

    // ContactForm component
    'contacts_form_title' => 'Write to Us',
    'contacts_form_success' => 'Thank you! Your message has been sent successfully.',
    'contacts_name_label' => 'Name',
    'contacts_name_placeholder' => 'Your name',
    'contacts_email_label' => 'Email',
    'contacts_email_placeholder' => 'your@email.com',
    'contacts_phone_label' => 'Phone',
    'contacts_phone_placeholder' => '+373 XX XXX XXX',
    'contacts_message_label' => 'Message',
    'contacts_message_placeholder' => 'Write your message...',
    'contacts_submit_button' => 'Send Message',

    // Product page
    'product_back_to_menu' => 'Back',
    'product_photo_soon' => 'Photo coming soon',
    'product_description_title' => 'Description',
    'product_ingredients_title' => 'Ingredients',
    'product_add_to_cart' => 'Add to cart',
    'product_remove_from_cart' => 'Remove from cart',

    // Cart - page
    'cart_page_title' => 'Cart',

    // CartEmpty
    'cart_empty_title' => 'Cart is empty',
    'cart_empty_description' => 'Add items from the menu',
    'cart_empty_button' => 'Go to menu',

    // CartItem
    'cart_item_remove' => 'Remove',
    'cart_item_confirm_remove' => 'Remove this item from the cart?',
    'cart_item_removed' => 'Item removed from the cart',

    // Undo
    'common_undo' => 'Undo',

    // CartSummary
    'cart_summary_title' => 'Your order',
    'cart_summary_products' => 'Products',
    'cart_summary_delivery' => 'Delivery',
    'cart_summary_free_delivery' => 'Free',
    'cart_summary_until_free' => 'Add',
    'cart_summary_until_free_text' => 'more for free delivery (free delivery for orders over ' . config('shop.free_delivery_amount') . ' lei)',
    'cart_summary_total' => 'Total:',
    'cart_summary_checkout' => 'Checkout',
    'cart_summary_continue' => 'Continue shopping',
    'cart_summary_clear' => 'Clear cart',
    'cart_confirm_clear' => 'Clear entire cart?',

    // After order placed
    'cart_order_success' => 'Thank you for your order',
    'cart_order_contact' => 'We will contact you at',

    // Checkout modal
    'checkout_title' => 'Checkout',
    'checkout_total_label' => 'Total to pay:',
    'checkout_items_in_order' => 'in order',

    // Form - Contact details
    'checkout_name_label' => 'Your name',
    'checkout_name_placeholder' => 'John Doe',
    'checkout_phone_label' => 'Phone',
    'checkout_phone_placeholder' => '12 345 678',
    'checkout_phone_error' => 'Enter a valid phone number (at least 10 digits)',
    'checkout_email_label' => 'Email',
    'checkout_email_placeholder' => 'your@email.com',

    // Delivery method
    'checkout_delivery_method_label' => 'Delivery method',
    'checkout_pickup' => 'Pickup',
    'checkout_delivery' => 'Delivery',
    'checkout_pickup_address_label' => 'Pickup address:',
    'checkout_pickup_address' => 'Ismail str. 10, Chisinau, Moldova',
    'checkout_pickup_hours' => 'Working hours: ' . config('shop.work_time') . '',

    // Delivery address
    'checkout_address_type_label' => 'Address type',
    'checkout_house' => 'Private house',
    'checkout_apartment' => 'Apartment building',
    'checkout_street_label' => 'Street',
    'checkout_street_placeholder' => 'Example str.',
    'checkout_house_number_label' => 'House',
    'checkout_house_number_placeholder' => '10',
    'checkout_apartment_number_label' => 'Apartment',
    'checkout_apartment_number_placeholder' => '25',
    'checkout_entrance_label' => 'Entrance',
    'checkout_entrance_placeholder' => '1',
    'checkout_entrance_hint' => 'If no entrance — enter 1',
    'checkout_floor_label' => 'Floor',
    'checkout_floor_placeholder' => '5',
    'checkout_intercom_label' => 'Intercom',
    'checkout_intercom_placeholder' => '1234',
    'checkout_floor_hint' => 'If no floor — enter 1',

    // Payment method
    'checkout_payment_label' => 'Payment method',
    'checkout_cash' => 'Cash',
    'checkout_card' => 'Card',

    // Comment
    'checkout_comment_label' => 'Order comment',
    'checkout_comment_placeholder' => 'Special requests, delivery time...',

    // Buttons
    'checkout_submit' => 'Place order',
    'checkout_submitting' => 'Submitting...',
    'checkout_cancel' => 'Cancel',

    // Messages
    'checkout_success' => 'Order placed successfully! We will contact you shortly.',
    'checkout_required' => '*',
    'checkout_success_title' => 'Order received',
    'checkout_success_message' => 'Your order has been placed. Please wait for our operator to call you.',
    'checkout_success_close' => 'Close',

    // Email - email templates
    'email_contact_subject' => 'Message from website',
    'email_contact_title' => 'New message from SUSHIKO website',
    'email_name_label' => 'Name:',
    'email_email_label' => 'Email:',
    'email_phone_label' => 'Phone:',
    'email_message_label' => 'Message:',

    // Email for user (auto-reply)
    'email_user_subject' => 'Thank you for contacting us!',
    'email_user_title' => 'We received your message',
    'email_user_greeting' => 'Hello',
    'email_user_text' => 'Thank you for your message! We have received it and will contact you shortly.',
    'email_user_your_message' => 'Your message:',
    'email_user_footer' => 'Best regards, SUSHIKO team',

    // footer
    'footer_home' => 'Home',
    'footer_about' => 'About Us',
    'footer_contacts' => 'Contacts',
    'footer_adress' => 'Chisinau, Ismail Street 123',
    'footer_navigation' => 'Navigation',
    'footer_des_1' => 'The best sushi and rolls in Chisinau. Fresh ingredients, traditional recipes, fast delivery.',
    'footer_des_2' => 'Our mascot ensures the quality of every roll!',
    'footer_des_prava' => 'All rights reserved.',

    // 404 Error Page
    'error_404_title' => 'Page Not Found - 404',
    'error_404_description' => 'Sorry, the page you are looking for could not be found. Return to the homepage and order delicious sushi!',
    'error_404_heading' => 'Page Not Found',
    'error_404_text' => 'Unfortunately, this page no longer exists or has been moved. But don\'t worry - our sushi is still here!',
    'error_404_button_home' => 'Home',
    'error_404_button_back' => 'Go Back',
    'error_404_hint' => 'You may have followed an old link or the page has been deleted.',
];
