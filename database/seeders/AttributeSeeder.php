<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductAttribute;
use App\Models\AttributeTranslation;
use App\Models\AttributeValue;
use App\Models\AttributeValueTranslation;

class AttributeSeeder extends Seeder
{
    public function run(): void
    {
        // ========== АТРИБУТ 1: СОСТАВ ==========
        $compositionAttr = ProductAttribute::create([
            'type' => 'multiselect',
            'unit' => null,
            'is_filterable' => true,
            'is_variant' => false,
            'sort_order' => 1
        ]);

        // Переводы для атрибута СОСТАВ
        AttributeTranslation::create([
            'attribute_id' => $compositionAttr->id,
            'language' => 'ru',
            'name' => 'СОСТАВ'
        ]);
        AttributeTranslation::create([
            'attribute_id' => $compositionAttr->id,
            'language' => 'ro',
            'name' => 'COMPOZIȚIE'
        ]);
        AttributeTranslation::create([
            'attribute_id' => $compositionAttr->id,
            'language' => 'en',
            'name' => 'INGREDIENTS'
        ]);

        // Значения для состава (ингредиенты)
        $compositionValues = [
            ['ru' => 'Рис', 'ro' => 'Orez', 'en' => 'Rice'],
            ['ru' => 'Огурец', 'ro' => 'Castravete', 'en' => 'Cucumber'],
            ['ru' => 'Авокадо', 'ro' => 'Avocado', 'en' => 'Avocado'],
            ['ru' => 'Сыр', 'ro' => 'Brânză', 'en' => 'Cheese'],
            ['ru' => 'Водоросли', 'ro' => 'Alge', 'en' => 'Seaweed'],
            ['ru' => 'Тунец', 'ro' => 'Ton', 'en' => 'Tuna'],
            ['ru' => 'Лосось', 'ro' => 'Somon', 'en' => 'Salmon'],
            ['ru' => 'Креветка', 'ro' => 'Crevete', 'en' => 'Shrimp'],
            ['ru' => 'Угорь', 'ro' => 'Anghilă', 'en' => 'Eel'],
            ['ru' => 'Кремовый сыр', 'ro' => 'Brânză cremoasă', 'en' => 'Cream cheese'],
            ['ru' => 'Имбирь', 'ro' => 'Ghimbir', 'en' => 'Ginger'],
            ['ru' => 'Васаби', 'ro' => 'Wasabi', 'en' => 'Wasabi'],
            ['ru' => 'Соевый соус', 'ro' => 'Sos de soia', 'en' => 'Soy sauce'],
            ['ru' => 'Красная икра тобико', 'ro' => 'Icre roșii tobiko', 'en' => 'Red tobiko'],
            ['ru' => 'Черная икра тобико', 'ro' => 'Icre negre tobiko', 'en' => 'Black tobiko'],
            ['ru' => 'Соус чили', 'ro' => 'Sos chili', 'en' => 'Chili sauce'],
            ['ru' => 'Соус унаги', 'ro' => 'Sos unagi', 'en' => 'Unagi sauce'],
            ['ru' => 'Семга гриль', 'ro' => 'Somon la grătar', 'en' => 'Grilled salmon'],
            ['ru' => 'Креветка темпура', 'ro' => 'Crevete tempura', 'en' => 'Tempura shrimp'],
            ['ru' => 'Острый соус', 'ro' => 'Sos picant', 'en' => 'Spicy sauce'],
            ['ru' => 'Лук', 'ro' => 'Ceapă', 'en' => 'Onion'],
            ['ru' => 'Спайс соус', 'ro' => 'Sos spicy', 'en' => 'Spicy sauce'],
            ['ru' => 'Унаги', 'ro' => 'Unagi', 'en' => 'Unagi'],
            ['ru' => 'Салат Айсберг', 'ro' => 'Salată Iceberg', 'en' => 'Iceberg lettuce'],
            ['ru' => 'Сыр Чеддер', 'ro' => 'Brânză Cheddar', 'en' => 'Cheddar cheese'],
            ['ru' => 'Пекинская капуста', 'ro' => 'Varză chinezească', 'en' => 'Chinese cabbage'],
            ['ru' => 'Брокколи', 'ro' => 'Broccoli', 'en' => 'Broccoli'],
            ['ru' => 'Лосось в темпуре', 'ro' => 'Somon în tempura', 'en' => 'Salmon in tempura'],
            ['ru' => 'Перец болгарский', 'ro' => 'Ardei gras', 'en' => 'Bell pepper'],
            ['ru' => 'Грибы', 'ro' => 'Ciuperci', 'en' => 'Mushrooms'],
            ['ru' => 'Чеснок', 'ro' => 'Usturoi', 'en' => 'Garlic'],
            ['ru' => 'Имбирь', 'ro' => 'Ghimbir', 'en' => 'Ginger'],
            ['ru' => 'Морковь', 'ro' => 'Morcov', 'en' => 'Carrot'],
            ['ru' => 'Лук', 'ro' => 'Ceapă', 'en' => 'Onion'],
            ['ru' => 'Фасоль стручковая', 'ro' => 'Fasole păstăi', 'en' => 'Green beans'],
            ['ru' => 'Соус терияки', 'ro' => 'Sos teriyaki', 'en' => 'Teriyaki sauce'],
            ['ru' => 'Черри', 'ro' => 'Cherry', 'en' => 'Cherry'],
            ['ru' => 'Фасоль стручковая', 'ro' => 'Fasole verde', 'en' => 'Green beans'],
            ['ru' => 'Кукуруза', 'ro' => 'Porumb', 'en' => 'Corn'],
            ['ru' => 'Яйцо', 'ro' => 'Ou', 'en' => 'Egg'],
            ['ru' => 'Соевый соус', 'ro' => 'Sos de soia', 'en' => 'Soy sauce'],
            ['ru' => 'Мисо бульон', 'ro' => 'Sup miso', 'en' => 'Miso broth'],
            ['ru' => 'Сыр тофу', 'ro' => 'Brânză tofu', 'en' => 'Tofu cheese'],
            ['ru' => 'Водоросли Wakame', 'ro' => 'Alge Wakame', 'en' => 'Wakame seaweed'],
            ['ru' => 'Куриный бульон', 'ro' => 'Sup de pui', 'en' => 'Chicken broth'],
            ['ru' => 'Кокосовое молоко', 'ro' => 'Lapte de cocos', 'en' => 'Coconut milk'],
            ['ru' => 'Рыбный соус', 'ro' => 'Sos de pește', 'en' => 'Fish sauce'],
            ['ru' => 'Лайм', 'ro' => 'Lămâie verde', 'en' => 'Lime'],
            ['ru' => 'Петрушка', 'ro' => 'Pătrunjel', 'en' => 'Parsley'],
            ['ru' => 'Кисло-сладкий соус чили', 'ro' => 'Sos chili dulce-acrișor', 'en' => 'Sweet and sour chili sauce'],
            ['ru' => 'Ананасовый соус', 'ro' => 'Sos de ananas', 'en' => 'Pineapple sauce'],
            ['ru' => 'Philadelphia Classic', 'ro' => 'Philadelphia Classic', 'en' => 'Philadelphia Classic'],
            ['ru' => 'California Classic', 'ro' => 'California Classic', 'en' => 'California Classic'],
            ['ru' => 'Shake roll', 'ro' => 'Shake roll', 'en' => 'Shake roll'],
            ['ru' => 'Vulcan salmon', 'ro' => 'Vulcan salmon', 'en' => 'Vulcan salmon'],
            ['ru' => 'Ebi crunch', 'ro' => 'Ebi crunch', 'en' => 'Ebi crunch'],
            ['ru' => 'Unaghi big', 'ro' => 'Unaghi big', 'en' => 'Unaghi big'],
            ['ru' => 'Salmon tempura', 'ro' => 'Salmon tempura', 'en' => 'Salmon tempura'],
            ['ru' => 'Tori tempura', 'ro' => 'Tori tempura', 'en' => 'Tori tempura'],
            ['ru' => 'Ebi roll', 'ro' => 'Ebi roll', 'en' => 'Ebi roll'],
            ['ru' => 'Dragon Verde', 'ro' => 'Dragon Verde', 'en' => 'Dragon Verde'],
            ['ru' => 'Salmon cheese', 'ro' => 'Salmon cheese', 'en' => 'Salmon cheese'],
            ['ru' => 'Shake black', 'ro' => 'Shake black', 'en' => 'Shake black'],
            ['ru' => 'Canada', 'ro' => 'Canada', 'en' => 'Canada'],
            ['ru' => 'Ebi maki', 'ro' => 'Ebi maki', 'en' => 'Ebi maki'],
            ['ru' => 'Tuna maki', 'ro' => 'Tuna maki', 'en' => 'Tuna maki'],
            ['ru' => 'Avo roll', 'ro' => 'Avo roll', 'en' => 'Avo roll'],
            ['ru' => 'Yammi roll', 'ro' => 'Yammi roll', 'en' => 'Yammi roll'],
            ['ru' => 'Iceberg roll', 'ro' => 'Iceberg roll', 'en' => 'Iceberg roll'],
            ['ru' => 'Chicken tempura roll', 'ro' => 'Chicken tempura roll', 'en' => 'Chicken tempura roll'],
            ['ru' => 'Tropical roll', 'ro' => 'Tropical roll', 'en' => 'Tropical roll'],
            ['ru' => 'Okinawa roll', 'ro' => 'Okinawa roll', 'en' => 'Okinawa roll'],
            ['ru' => 'Salmon grill roll', 'ro' => 'Salmon grill roll', 'en' => 'Salmon grill roll'],
            ['ru' => 'Philadelphia cheese', 'ro' => 'Philadelphia cheese', 'en' => 'Philadelphia cheese'],
            ['ru' => 'Ronin roll', 'ro' => 'Ronin roll', 'en' => 'Ronin roll'],
            ['ru' => 'Rainbow roll', 'ro' => 'Rainbow roll', 'en' => 'Rainbow roll'],
            ['ru' => 'Tempura mix', 'ro' => 'Tempura mix', 'en' => 'Tempura mix'],
            ['ru' => 'Shake Spice', 'ro' => 'Shake Spice', 'en' => 'Shake Spice'],
            ['ru' => 'Wakame roll', 'ro' => 'Wakame roll', 'en' => 'Wakame roll'],
            ['ru' => 'Shake red', 'ro' => 'Shake red', 'en' => 'Shake red'],
            ['ru' => 'Oxi roll', 'ro' => 'Oxi roll', 'en' => 'Oxi roll'],

        ];

        foreach ($compositionValues as $index => $valueData) {
            $value = AttributeValue::create([
                'attribute_id' => $compositionAttr->id,
                'sort_order' => $index + 1
            ]);

            foreach ($valueData as $lang => $text) {
                AttributeValueTranslation::create([
                    'attribute_value_id' => $value->id,
                    'language' => $lang,
                    'value' => $text
                ]);
            }
        }

        // ========== АТРИБУТ 2: КОЛИЧЕСТВО ШТУК ==========
        $piecesAttr = ProductAttribute::create([
            'type' => 'select',
            'unit' => 'шт',
            'is_filterable' => true,
            'is_variant' => false,
            'sort_order' => 2
        ]);

        // Переводы для атрибута КОЛИЧЕСТВО
        AttributeTranslation::create([
            'attribute_id' => $piecesAttr->id,
            'language' => 'ru',
            'name' => 'КОЛИЧЕСТВО'
        ]);
        AttributeTranslation::create([
            'attribute_id' => $piecesAttr->id,
            'language' => 'ro',
            'name' => 'CANTITATE'
        ]);
        AttributeTranslation::create([
            'attribute_id' => $piecesAttr->id,
            'language' => 'en',
            'name' => 'QUANTITY'
        ]);

        // Значения для количества
        $piecesValues = [
            ['ru' => '8 шт', 'ro' => '8 buc', 'en' => '8 pcs'],
            ['ru' => '9 шт', 'ro' => '9 buc', 'en' => '9 pcs'],
            ['ru' => '24 шт', 'ro' => '24 buc', 'en' => '24 pcs'],
            ['ru' => '25 шт', 'ro' => '25 buc', 'en' => '25 pcs'],
            ['ru' => '26 шт', 'ro' => '26 buc', 'en' => '26 pcs'],
            ['ru' => '32 шт', 'ro' => '32 buc', 'en' => '32 pcs'],
            ['ru' => '33 шт', 'ro' => '33 buc', 'en' => '33 pcs'],
            ['ru' => '34 шт', 'ro' => '34 buc', 'en' => '34 pcs'],
            ['ru' => '40 шт', 'ro' => '40 buc', 'en' => '40 pcs'],
            ['ru' => '72 шт', 'ro' => '72 buc', 'en' => '72 pcs'],
            ['ru' => '80 шт', 'ro' => '80 buc', 'en' => '80 pcs'],

        ];

        foreach ($piecesValues as $index => $valueData) {
            $value = AttributeValue::create([
                'attribute_id' => $piecesAttr->id,
                'sort_order' => $index + 1
            ]);

            foreach ($valueData as $lang => $text) {
                AttributeValueTranslation::create([
                    'attribute_value_id' => $value->id,
                    'language' => $lang,
                    'value' => $text
                ]);
            }
        }

        // ========== АТРИБУТ 3: ВЕС ==========
        $weightAttr = ProductAttribute::create([
            'type' => 'select',
            'unit' => 'г',
            'is_filterable' => true,
            'is_variant' => false,
            'sort_order' => 3
        ]);

        // Переводы для атрибута ВЕС
        AttributeTranslation::create([
            'attribute_id' => $weightAttr->id,
            'language' => 'ru',
            'name' => 'ВЕС'
        ]);
        AttributeTranslation::create([
            'attribute_id' => $weightAttr->id,
            'language' => 'ro',
            'name' => 'GREUTATE'
        ]);
        AttributeTranslation::create([
            'attribute_id' => $weightAttr->id,
            'language' => 'en',
            'name' => 'WEIGHT'
        ]);

        // Значения для веса
        $weightValues = [
            ['ru' => '210 г', 'ro' => '210 g', 'en' => '210 g'],
            ['ru' => '240 г', 'ro' => '240 g', 'en' => '240 g'],
            ['ru' => '260 г', 'ro' => '260 g', 'en' => '260 g'],
            ['ru' => '270 г', 'ro' => '270 g', 'en' => '270 g'],
            ['ru' => '280 г', 'ro' => '280 g', 'en' => '280 g'],
            ['ru' => '290 г', 'ro' => '290 g', 'en' => '290 g'],
            ['ru' => '300 г', 'ro' => '300 g', 'en' => '300 g'],
            ['ru' => '310 г', 'ro' => '310 g', 'en' => '310 g'],
            ['ru' => '320 г', 'ro' => '320 g', 'en' => '320 g'],
            ['ru' => '330 г', 'ro' => '330 g', 'en' => '330 g'],
            ['ru' => '850 г', 'ro' => '850 g', 'en' => '850 g'],
            ['ru' => '870 г', 'ro' => '870 g', 'en' => '870 g'],
            ['ru' => '900 г', 'ro' => '900 g', 'en' => '900 g'],
            ['ru' => '910 г', 'ro' => '910 g', 'en' => '910 g'],
            ['ru' => '920 г', 'ro' => '920 g', 'en' => '920 g'],
            ['ru' => '1000 г', 'ro' => '1000 g', 'en' => '1000 g'],
            ['ru' => '1120 г', 'ro' => '1120 g', 'en' => '1120 g'],
            ['ru' => '1140 г', 'ro' => '1140 g', 'en' => '1140 g'],
            ['ru' => '1210 г', 'ro' => '1210 g', 'en' => '1210 g'],
            ['ru' => '1250 г', 'ro' => '1250 g', 'en' => '1250 g'],
            ['ru' => '1260 г', 'ro' => '1260 g', 'en' => '1260 g'],
            ['ru' => '1270 г', 'ro' => '1270 g', 'en' => '1270 g'],
            ['ru' => '1440 г', 'ro' => '1440 g', 'en' => '1440 g'],
            ['ru' => '1500 г', 'ro' => '1500 g', 'en' => '1500 g'],
            ['ru' => '2800 г', 'ro' => '2800 g', 'en' => '2800 g'],
            ['ru' => '2960 г', 'ro' => '2960 g', 'en' => '2960 g'],

        ];

        foreach ($weightValues as $index => $valueData) {
            $value = AttributeValue::create([
                'attribute_id' => $weightAttr->id,
                'sort_order' => $index + 1
            ]);

            foreach ($valueData as $lang => $text) {
                AttributeValueTranslation::create([
                    'attribute_value_id' => $value->id,
                    'language' => $lang,
                    'value' => $text
                ]);
            }
        }
    }
}
