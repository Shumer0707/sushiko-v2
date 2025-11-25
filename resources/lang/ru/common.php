<?php

return [

    // header

    'home' => 'Главная',
    'about' => 'О нас',
    'contact' => 'Контакты',
    'phone_time' => 'с 11:00 до 21:45 Доставка занимает в среднем 60 минут.',
    'navigation' => 'Навигация',
    'menu' => 'Меню',
    'language' => 'Язык',
    'cart' => 'Корзина',
    'go_cart' => 'Перейти в корзину',
    'go_back' => 'Продолжить покупки',
    'item_1' => 'товар',      // 1 товар
    'item_2' => 'товара',     // 2 товара
    'item_5' => 'товаров',    // 5 товаров

    // home
    'home_page_title' => 'Главная',
    'home_page_description' => 'Добро пожаловать в SUSHIKO - лучшие суши и роллы в Кишиневе',
    // banners
    'home_ban_title_1' => 'Sushiko - суши №1',
    'home_ban_description_1' => 'Лучшие суши в Кишиневе. Свежие ингредиенты, традиционные рецепты',
    'home_ban_button_1' => 'Посмотреть меню',

    'home_ban_title_2' => 'Бесплатная доставка',
    'home_ban_description_2' => 'При заказе от ' . config('shop.free_delivery_amount') . ' лей доставляем бесплатно по всему Кишиневу',
    'home_ban_button_2' => 'Заказать сейчас',

    'home_ban_title_3' => 'Свежие роллы каждый день',
    'home_ban_description_3' => 'Готовим роллы только из свежих продуктов. Никаких заморозок!',
    'home_ban_button_3' => 'Узнать больше',

    'home_ban_title_4' => 'Специальные предложения',
    'home_ban_description_4' => 'Каждую неделю новые акции и специальные комбо-наборы',
    'home_ban_button_4' => 'Смотреть акции',

    'home_ban_title_5' => 'Японская кухня',
    'home_ban_description_5' => 'Аутентичные рецепты от наших японских шеф-поваров',
    'home_ban_button_5' => 'Узнать больше',

    // seo
    'home_seo_title' => 'Суши и роллы с доставкой в Кишиневе',
    'home_seo_des' => 'Sushiko - это традиционная японская кухня с использованием только свежих продуктов премиум качества. Готовим роллы по аутентичным рецептам и доставляем быстро по всему Кишиневу.',
    'home_seo_1_title' => 'Свежие продукты',
    'home_seo_1_des' => 'Только премиум ингредиенты. Доставка рыбы каждый день.',
    'home_seo_2_title' => 'Быстрая доставка',
    'home_seo_2_des' => 'Доставка за 60 минут. Бесплатно от ' . config('shop.free_delivery_amount') . ' лей.',
    'home_seo_3_title' => 'Мастера своего дела',
    'home_seo_3_des' => 'Наши повара — опытные профессионалы. Готовим с вниманием и душой.',

    // cat
    'home_cat_title' => 'Наше меню',
    'home_cat_des' => 'Выберите категорию и откройте мир японской кухни',
    'home_cat_go' => 'Перейти',

    // menu

    'home_menu_not_item' => 'Товары не найдены',
    'home_menu_col_1' => 'товар',
    'home_menu_col_2' => 'товара',
    'home_menu_col_3' => 'товаров',
    'home_menu_more' => 'Подробнее',
    'home_menu_in_cart' => 'В корзину',

    // Контакты - страница
    'contacts_page_title' => 'Контакты',
    'contacts_page_description' => 'Свяжитесь с SUSHIKO - адрес, телефон, время работы и форма обратной связи',
    'contacts_hero_title' => 'Свяжитесь с нами',
    'contacts_hero_description' => 'Мы всегда рады вашим вопросам и предложениям. Выберите удобный способ связи!',

    // ContactInfo компонент
    'contacts_info_title' => 'Наши контакты',
    'contacts_address_label' => 'Адрес',
    'contacts_address_text' => 'ул. Измаил 86, Кишинёв, Молдова',
    'contacts_phone_label' => 'Телефон',
    'contacts_phone_number' => '+373 781 25 553',
    'contacts_email_label' => 'Email',
    'contacts_email_address' => 'sushikoevgheni@gmail.com',
    'contacts_hours_label' => 'Часы работы',
    'contacts_hours_weekdays' => 'Пн-Вс:',
    'contacts_hours_weekdays_time' => '' . config('shop.work_time') . '',
    'contacts_hours_weekend' => 'Пн-Вс:',
    'contacts_hours_weekend_time' => '11:00 - 00:00',
    'contacts_social_title' => 'Мы в соцсетях',

    // ContactForm компонент
    'contacts_form_title' => 'Напишите нам',
    'contacts_form_success' => 'Спасибо! Ваше сообщение успешно отправлено.',
    'contacts_name_label' => 'Имя',
    'contacts_name_placeholder' => 'Ваше имя',
    'contacts_email_label' => 'Email',
    'contacts_email_placeholder' => 'your@email.com',
    'contacts_phone_label' => 'Телефон',
    'contacts_phone_placeholder' => '+373 XX XXX XXX',
    'contacts_message_label' => 'Сообщение',
    'contacts_message_placeholder' => 'Напишите ваше сообщение...',
    'contacts_submit_button' => 'Отправить сообщение',

    // Страница продукта
    'product_back_to_menu' => 'Вернуться к меню',
    'product_photo_soon' => 'Фото скоро появится',
    'product_description_title' => 'Описание',
    'product_ingredients_title' => 'Состав',
    'product_add_to_cart' => 'Добавить в корзину',
    'product_remove_from_cart' => 'Удалить из корзины',

    // Корзина - страница
    'cart_page_title' => 'Корзина',

    // CartEmpty
    'cart_empty_title' => 'Корзина пуста',
    'cart_empty_description' => 'Добавьте товары из меню',
    'cart_empty_button' => 'Перейти к меню',

    // CartItem
    'cart_item_remove' => 'Удалить',
    'cart_item_confirm_remove' => 'Удалить товар из корзины?',

    // CartSummary
    'cart_summary_title' => 'Ваш заказ',
    'cart_summary_products' => 'Товары',
    'cart_summary_delivery' => 'Доставка',
    'cart_summary_free_delivery' => 'Бесплатно',
    'cart_summary_until_free' => 'Добавьте ещё',
    'cart_summary_until_free_text' => 'для бесплатной доставки (бесплатно от ' . config('shop.free_delivery_amount') . 'лей)',
    'cart_summary_total' => 'К оплате:',
    'cart_summary_checkout' => 'Оформить заказ',
    'cart_summary_continue' => 'Продолжить покупки',
    'cart_summary_clear' => 'Очистить корзину',
    'cart_confirm_clear' => 'Очистить всю корзину?',

    // После оформления заказа
    'cart_order_success' => 'Спасибо за заказ',
    'cart_order_contact' => 'Мы свяжемся с вами по телефону',

    // Модалка оформления заказа
    'checkout_title' => 'Оформление заказа',
    'checkout_total_label' => 'Итого к оплате:',
    'checkout_items_in_order' => 'в заказе',

    // Форма - Контактные данные
    'checkout_name_label' => 'Ваше имя',
    'checkout_name_placeholder' => 'Иван Петров',
    'checkout_phone_label' => 'Телефон',
    'checkout_phone_placeholder' => '12 345 678',
    'checkout_phone_error' => 'Введите корректный номер телефона (минимум 10 цифр)',
    'checkout_email_label' => 'Email',
    'checkout_email_placeholder' => 'your@email.com',

    // Способ получения
    'checkout_delivery_method_label' => 'Способ получения',
    'checkout_pickup' => 'Самовывоз',
    'checkout_delivery' => 'Доставка',
    'checkout_pickup_address_label' => 'Адрес самовывоза:',
    'checkout_pickup_address' => 'ул. Измаил 86, Кишинёв, Молдова',
    'checkout_pickup_hours' => 'Время работы: ' . config('shop.work_time') . '',

    // Адрес доставки
    'checkout_address_type_label' => 'Тип адреса',
    'checkout_house' => 'Частный дом',
    'checkout_apartment' => 'Многоквартирный',
    'checkout_street_label' => 'Улица',
    'checkout_street_placeholder' => 'ул. Примерная',
    'checkout_house_number_label' => 'Дом',
    'checkout_house_number_placeholder' => '10',
    'checkout_apartment_number_label' => 'Квартира',
    'checkout_apartment_number_placeholder' => '25',
    'checkout_entrance_label' => 'Подъезд',
    'checkout_entrance_placeholder' => '1',
    'checkout_entrance_hint' => 'Если нет подъезда — укажите 1',
    'checkout_floor_label' => 'Этаж',
    'checkout_floor_placeholder' => '5',
    'checkout_intercom_label' => 'Домофон',
    'checkout_intercom_placeholder' => '1234',
    'checkout_floor_hint' => 'Если нет этажа — укажите 1',

    // Способ оплаты
    'checkout_payment_label' => 'Способ оплаты',
    'checkout_cash' => 'Наличными',
    'checkout_card' => 'Картой',

    // Комментарий
    'checkout_comment_label' => 'Комментарий к заказу',
    'checkout_comment_placeholder' => 'Особые пожелания, время доставки...',

    // Кнопки
    'checkout_submit' => 'Оформить заказ',
    'checkout_submitting' => 'Отправка...',
    'checkout_cancel' => 'Отмена',

    // Сообщения
    // 'checkout_success' => 'Заказ успешно оформлен! Мы свяжемся с вами в ближайшее время.',
    'checkout_required' => '*', // звездочка для обязательных полей

    'checkout_success_title' => 'Заказ принят',
    'checkout_success_message' => 'Ваш заказ успешно оформлен. Ожидайте звонка оператора.',
    'checkout_success_close' => 'Закрыть',

    // Email - шаблоны писем
    'email_contact_subject' => 'Сообщение с сайта',
    'email_contact_title' => 'Новое сообщение с сайта SUSHIKO',
    'email_name_label' => 'Имя:',
    'email_email_label' => 'Email:',
    'email_phone_label' => 'Телефон:',
    'email_message_label' => 'Сообщение:',

    // Email для пользователя (автоответ)
    'email_user_subject' => 'Спасибо за обращение!',
    'email_user_title' => 'Мы получили ваше сообщение',
    'email_user_greeting' => 'Здравствуйте',
    'email_user_text' => 'Спасибо за ваше обращение! Мы получили ваше сообщение и свяжемся с вами в ближайшее время.',
    'email_user_your_message' => 'Ваше сообщение:',
    'email_user_footer' => 'С уважением, команда SUSHIKO',

    // footer
    'footer_home' => 'Главная',
    'footer_about' => 'О нас',
    'footer_contacts' => 'Контакты',
    'footer_adress' => 'Кишинёв, ул. Измаил 86',
    'footer_navigation' => 'Навигация',
    'footer_des_1' => 'Лучшие суши и роллы в Кишиневе. Свежие ингредиенты, традиционные рецепты, быстрая доставка.',
    'footer_des_2' => 'Наш талисман следит за качеством каждого ролла!',
    'footer_des_prava' => 'Все права защищены.',

    // 404 Error Page
    'error_404_title' => 'Страница не найдена - 404',
    'error_404_description' => 'К сожалению, запрашиваемая страница не найдена. Вернитесь на главную и закажите вкусные суши!',
    'error_404_heading' => 'Страница не найдена',
    'error_404_text' => 'К сожалению, эта страница больше не существует или была перемещена. Но не переживайте - наши суши никуда не делись!',
    'error_404_button_home' => 'На главную',
    'error_404_button_back' => 'Назад',
    'error_404_hint' => 'Возможно, вы перешли по старой ссылке или страница была удалена.',
];
