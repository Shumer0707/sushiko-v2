<?php

return [

    // header
    'home' => 'Acasă',
    'about' => 'Despre noi',
    'contact' => 'Contacte',
    'phone_time' => 'de la 11:00 la 21:45. Livrarea durează în medie 60 de minute.',
    'navigation' => 'Navigare',
    'menu' => 'Meniu',
    'language' => 'Limba',
    'cart' => 'Coș',
    'go_cart' => 'Mergi la coș',
    'go_back' => 'Continuă cumpărăturile',
    'item_1' => 'produs',     // 1 produs
    'item_2' => 'produse',    // 2 produse
    'item_5' => 'produse',    // 5 produse (множественное)

    // home
    'home_page_title' => 'Acasă',
    'home_page_description' => 'Bine ați venit la SUSHIKO - cel mai bun sushi și rulouri în Chișinău',

    //banners
    'home_ban_title_1' => 'Sushiko - sushi nr.1',
    'home_ban_description_1' => 'Cel mai bun sushi din Chișinău. Ingrediente proaspete, rețete tradiționale',
    'home_ban_button_1' => 'Vezi meniul',

    'home_ban_title_2' => 'Livrare gratuită',
    'home_ban_description_2' => 'La comenzi de la ' . config('shop.free_delivery_amount') . ' lei livrăm gratuit în tot Chișinăul',
    'home_ban_button_2' => 'Comandă acum',

    'home_ban_title_3' => 'Roluri proaspete în fiecare zi',
    'home_ban_description_3' => 'Preparăm roluri doar din produse proaspete. Fără congelate!',
    'home_ban_button_3' => 'Află mai mult',

    'home_ban_title_4' => 'Oferte speciale',
    'home_ban_description_4' => 'În fiecare săptămână noi promoții și seturi combo speciale',
    'home_ban_button_4' => 'Vezi promoțiile',

    'home_ban_title_5' => 'Bucătărie japoneză',
    'home_ban_description_5' => 'Rețete autentice de la bucătarii noștri japonezi',
    'home_ban_button_5' => 'Află mai mult',

    // seo
    'home_seo_title' => 'Sushi și roluri cu livrare în Chișinău',
    'home_seo_des' => 'Sushiko - bucătărie tradițională japoneză cu ingrediente proaspete premium. Preparăm roluri după rețete autentice și livrăm rapid în toată Chișinăul.',
    'home_seo_1_title' => 'Produse proaspete',
    'home_seo_1_des' => 'Doar ingrediente premium. Livrare de pește în fiecare zi.',
    'home_seo_2_title' => 'Livrare rapidă',
    'home_seo_2_des' => 'Livrare în 60 de minute. Gratuit de la ' . config('shop.free_delivery_amount') . ' lei.',
    'home_seo_3_title' => 'Maeștri în domeniul lor',
    'home_seo_3_des' => 'Bucătarii noștri sunt profesioniști cu experiență. Gătim cu atenție și suflet.',

    // cat
    'home_cat_title' => 'Meniul nostru',
    'home_cat_des' => 'Alegeți categoria și descoperiți lumea bucătăriei japoneze',
    'home_cat_go' => 'Mergi',

    // menu
    'home_menu_not_item' => 'Nu s-au găsit produse',
    'home_menu_col_1' => 'produs',
    'home_menu_col_2' => 'produse',
    'home_menu_col_3' => 'produse',
    'home_menu_more' => 'Detalii',
    'home_menu_in_cart' => 'În coș',

    // Contacte - pagina
    'contacts_page_title' => 'Contacte',
    'contacts_page_description' => 'Contactați SUSHIKO - adresă, telefon, program de lucru și formular de contact',
    'contacts_hero_title' => 'Contactați-ne',
    'contacts_hero_description' => 'Suntem întotdeauna bucuroși să răspundem la întrebările și sugestiile dumneavoastră. Alegeți metoda convenabilă de contact!',

    // Componenta ContactInfo
    'contacts_info_title' => 'Contactele noastre',
    'contacts_address_label' => 'Adresa',
    'contacts_address_text' => 'str. Ismail 86, Chișinău, Moldova',
    'contacts_phone_label' => 'Telefon',
    'contacts_phone_number' => config('shop.phone_shop'),
    'contacts_email_label' => 'Email',
    'contacts_email_address' => 'sushikoevgheni@gmail.com',
    'contacts_hours_label' => 'Program de lucru',
    'contacts_hours_weekdays' => 'Lun-Dum:',
    'contacts_hours_weekdays_time' => '11:00 - 21:45',
    'contacts_hours_weekend' => 'Sâm-Dum:',
    'contacts_hours_weekend_time' => '11:00 - 00:00',
    'contacts_social_title' => 'Suntem în rețelele sociale',

    // Componenta ContactForm
    'contacts_form_title' => 'Scrieți-ne',
    'contacts_form_success' => 'Mulțumim! Mesajul dumneavoastră a fost trimis cu succes.',
    'contacts_name_label' => 'Nume',
    'contacts_name_placeholder' => 'Numele dumneavoastră',
    'contacts_email_label' => 'Email',
    'contacts_email_placeholder' => 'your@email.com',
    'contacts_phone_label' => 'Telefon',
    'contacts_phone_placeholder' => '+373 XX XXX XXX',
    'contacts_message_label' => 'Mesaj',
    'contacts_message_placeholder' => 'Scrieți mesajul dumneavoastră...',
    'contacts_submit_button' => 'Trimite mesajul',

    // Pagina produsului
    'product_back_to_menu' => 'Înapoi',
    'product_photo_soon' => 'Fotografia va apărea curând',
    'product_description_title' => 'Descriere',
    'product_ingredients_title' => 'Compoziție',
    'product_add_to_cart' => 'Adaugă în coș',
    'product_remove_from_cart' => 'Șterge din coș',

    // Coș - pagina
    'cart_page_title' => 'Coș',
    'cart_items_count' => 'produs|produse|produse',

    // CartEmpty
    'cart_empty_title' => 'Coșul este gol',
    'cart_empty_description' => 'Adăugați produse din meniu',
    'cart_empty_button' => 'Mergi la meniu',

    // CartItem
    'cart_item_remove' => 'Șterge',
    'cart_item_confirm_remove' => 'Ștergeți produsul din coș?',
    'cart_item_removed' => 'Produsul a fost șters din coș',

    // Undo
    'common_undo' => 'Anulează',

    // CartSummary
    'cart_summary_title' => 'Comanda dvs.',
    'cart_summary_products' => 'Produse',
    'cart_summary_delivery' => 'Livrare',
    'cart_summary_free_delivery' => 'Gratuit',
    'cart_summary_until_free' => 'Adăugați încă',
    'cart_summary_until_free_text' => 'pentru livrare gratuită (gratuit de la ' . config('shop.free_delivery_amount') . ' lei)',
    'cart_summary_total' => 'De plată:',
    'cart_summary_checkout' => 'Plasați comanda',
    'cart_summary_continue' => 'Continuă cumpărăturile',
    'cart_summary_clear' => 'Goliți coșul',
    'cart_confirm_clear' => 'Goliți tot coșul?',

    // După plasarea comenzii
    'cart_order_success' => 'Mulțumim pentru comandă',
    'cart_order_contact' => 'Vă vom contacta la numărul de telefon',

    // Modalul de plasare a comenzii
    'checkout_title' => 'Plasarea comenzii',
    'checkout_total_label' => 'Total de plată:',
    'checkout_items_in_order' => 'în comandă',

    // Formular - Date de contact
    'checkout_name_label' => 'Numele dvs.',
    'checkout_name_placeholder' => 'Ion Popescu',
    'checkout_phone_label' => 'Telefon',
    'checkout_phone_placeholder' => '12 345 678',
    'checkout_phone_error' => 'Introduceți un număr de telefon valid (minim 10 cifre)',
    'checkout_email_label' => 'Email',
    'checkout_email_placeholder' => 'your@email.com',

    // Metoda de primire
    'checkout_delivery_method_label' => 'Metoda de primire',
    'checkout_pickup' => 'Ridicare personală',
    'checkout_delivery' => 'Livrare',
    'checkout_pickup_address_label' => 'Adresa de ridicare:',
    'checkout_pickup_address' => 'str. Ismail 10, Chișinău, Moldova',
    'checkout_pickup_hours' => 'Program: ' . config('shop.work_time') . '',

    // Adresa de livrare
    'checkout_address_type_label' => 'Tipul adresei',
    'checkout_house' => 'Casă privată',
    'checkout_apartment' => 'Bloc de apartamente',
    'checkout_street_label' => 'Strada',
    'checkout_street_placeholder' => 'str. Exemplu',
    'checkout_house_number_label' => 'Casa',
    'checkout_house_number_placeholder' => '10',
    'checkout_apartment_number_label' => 'Apartamentul',
    'checkout_apartment_number_placeholder' => '25',
    'checkout_entrance_label' => 'Scara',
    'checkout_entrance_placeholder' => '1',
    'checkout_entrance_hint' => 'Dacă nu există scară — indicați 1',
    'checkout_floor_label' => 'Etajul',
    'checkout_floor_placeholder' => '5',
    'checkout_intercom_label' => 'Domofon',
    'checkout_intercom_placeholder' => '1234',
    'checkout_floor_hint' => 'Dacă nu există etaj — indicați 1',

    // Metoda de plată
    'checkout_payment_label' => 'Metoda de plată',
    'checkout_cash' => 'Numerar',
    'checkout_card' => 'Card',

    // Comentariu
    'checkout_comment_label' => 'Comentariu la comandă',
    'checkout_comment_placeholder' => 'Dorințe speciale, ora livrării...',

    // Butoane
    'checkout_submit' => 'Plasați comanda',
    'checkout_submitting' => 'Se trimite...',
    'checkout_cancel' => 'Anulare',

    // Mesaje
    // 'checkout_success' => 'Comanda a fost plasată cu succes! Vă vom contacta în curând.',
    'checkout_required' => '*',
    'checkout_success_title' => 'Comanda a fost primită',
    'checkout_success_message' => 'Comanda dvs. a fost trimisă. Așteptați apelul operatorului.',
    'checkout_success_close' => 'Închide',

    // Email - șabloane de email
    'email_contact_subject' => 'Mesaj de pe site',
    'email_contact_title' => 'Mesaj nou de pe site-ul SUSHIKO',
    'email_name_label' => 'Nume:',
    'email_email_label' => 'Email:',
    'email_phone_label' => 'Telefon:',
    'email_message_label' => 'Mesaj:',

    // Email pentru utilizator (răspuns automat)
    'email_user_subject' => 'Mulțumim pentru mesaj!',
    'email_user_title' => 'Am primit mesajul dumneavoastră',
    'email_user_greeting' => 'Bună ziua',
    'email_user_text' => 'Mulțumim pentru mesajul dumneavoastră! Am primit mesajul și vă vom contacta în curând.',
    'email_user_your_message' => 'Mesajul dumneavoastră:',
    'email_user_footer' => 'Cu stimă, echipa SUSHIKO',

    // footer
    'footer_home' => 'Acasă',
    'footer_about' => 'Despre noi',
    'footer_contacts' => 'Contacte',
    'footer_adress' => 'Chișinău, str. Ismail 123',
    'footer_navigation' => 'Navigare',
    'footer_des_1' => 'Cel mai bun sushi și roluri în Chișinău. Ingrediente proaspete, rețete tradiționale, livrare rapidă.',
    'footer_des_2' => 'Mascota noastră supraveghează calitatea fiecărui sul!',
    'footer_des_prava' => 'Toate drepturile rezervate.',

    // 404 Error Page
    'error_404_title' => 'Pagina nu a fost găsită - 404',
    'error_404_description' => 'Din păcate, pagina solicitată nu a fost găsită. Reveniți la pagina principală și comandați sushi delicioși!',
    'error_404_heading' => 'Pagina nu a fost găsită',
    'error_404_text' => 'Din păcate, această pagină nu mai există sau a fost mutată. Dar nu vă faceți griji - sushi-ul nostru este încă aici!',
    'error_404_button_home' => 'Pagina principală',
    'error_404_button_back' => 'Înapoi',
    'error_404_hint' => 'Poate ați accesat un link vechi sau pagina a fost ștearsă.',
];
