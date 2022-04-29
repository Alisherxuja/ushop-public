<?php
namespace Database\Seeders;
use App\Models\Base\Info\Location;
use Illuminate\Database\Seeder;

class LocationsSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $regions = [
            [
                'parent_id' => null,
                'name_ru' => 'Город Ташкент',
                'name_uz' => 'Toshkent shahri'
            ],
            [
                'parent_id' => null,
                'name_ru' => 'Андижан',
                'name_uz' => 'Andijon'
            ],
            [
                'parent_id' => null,
                'name_ru' => 'Бухара',
                'name_uz' => 'Buxoro'
            ],
            [
                'parent_id' => null,
                'name_ru' => 'Джизах',
                'name_uz' => 'Jizzax'
            ],
            [
                'parent_id' => null,
                'name_ru' => 'Фергана',
                'name_uz' => 'Farg`ona'
            ],
            [
                'parent_id' => null,
                'name_ru' => 'Наманган',
                'name_uz' => 'Namangan'
            ],
            [
                'parent_id' => null,
                'name_ru' => 'Навоий',
                'name_uz' => 'Navoiy'
            ],
            [
                'parent_id' => null,
                'name_ru' => 'Самарканд',
                'name_uz' => 'Samarqand'
            ],
            [
                'parent_id' => null,
                'name_ru' => 'Сурхандаря',
                'name_uz' => 'Surxondaryo'
            ],
            [
                'parent_id' => null,
                'name_ru' => 'Ташкентская област',
                'name_uz' => 'Toshkent viloyati'
            ],
            [
                'parent_id' => null,
                'name_ru' => 'Кашкадаря',
                'name_uz' => 'Qashqadaryo'
            ],
            [
                'parent_id' => null,
                'name_ru' => 'Республика Каракалпакстан',
                'name_uz' => 'Qoraqalpog`iston Respublikasi'
            ],
            [
                'parent_id' => null,
                'name_ru' => 'Хорезм',
                'name_uz' => 'Xorazm'
            ],
            [
                'parent_id' => null,
                'name_ru' => 'Сырдаря',
                'name_uz' => 'Sirdaryo'
            ],
            [
                'parent_id' => 1,
                'name_ru' => 'Мирабадский район',
                'name_uz' => 'Mirobod tumani'
            ],
            [
                'parent_id' => 1,
                'name_ru' => 'Мирзо-Улугбекский район',
                'name_uz' => 'Mirzo Ulug`bek tumani'
            ],
            [
                'parent_id' => 1,
                'name_ru' => 'Юнусабадский район',
                'name_uz' => 'Yunusobod tumani'
            ],
            [
                'parent_id' => 1,
                'name_ru' => 'Яккасарайский район',
                'name_uz' => 'Yakkasaroy tumani'
            ],
            [
                'parent_id' => 1,
                'name_ru' => 'Шайхантахурский район',
                'name_uz' => 'Shayxontoxur tumani'
            ],
            [
                'parent_id' => 1,
                'name_ru' => 'Чиланзарский район',
                'name_uz' => 'Chilonzor tumani'
            ],
            [
                'parent_id' => 1,
                'name_ru' => 'Сергелийский район',
                'name_uz' => 'Sirg`ali tumani'
            ],
            [
                'parent_id' => 1,
                'name_ru' => 'Яшнободский район',
                'name_uz' => 'Yashnobod tumani'
            ],
            [
                'parent_id' => 1,
                'name_ru' => 'Алмазарский район',
                'name_uz' => 'Olmazor tumani'
            ],
            [
                'parent_id' => 1,
                'name_ru' => 'Учтепинский район',
                'name_uz' => 'Uchtepa tumani'
            ],
            [
                'parent_id' => 1,
                'name_ru' => 'Бектемирский район',
                'name_uz' => 'Bektemir tumani'
            ],
            [
                'parent_id' => 2,
                'name_ru' => 'город Андижан',
                'name_uz' => 'Andijon shahri'
            ],
            [
                'parent_id' => 2,
                'name_ru' => 'город Ханабад',
                'name_uz' => 'Xonobod shahri'
            ],
            [
                'parent_id' => 2,
                'name_ru' => 'город Карасу',
                'name_uz' => 'Qorasuv shahri'
            ],
            [
                'parent_id' => 2,
                'name_ru' => 'Алтынкульский район',
                'name_uz' => 'Oltinko`l tumani'
            ],
            [
                'parent_id' => 2,
                'name_ru' => 'Андижанский район',
                'name_uz' => 'Andijon tumani'
            ],
            [
                'parent_id' => 2,
                'name_ru' => 'Балыкчинский район',
                'name_uz' => 'Baliqchi tumani'
            ],
            [
                'parent_id' => 2,
                'name_ru' => 'Бозский район',
                'name_uz' => 'Bo`z tumani'
            ],
            [
                'parent_id' => 2,
                'name_ru' => 'Булакбашинский район',
                'name_uz' => 'Buloqboshi tumani'
            ],
            [
                'parent_id' => 2,
                'name_ru' => 'Джалалкудукский район',
                'name_uz' => 'Jalolquduq tumani'
            ],
            [
                'parent_id' => 2,
                'name_ru' => 'Избасканский район',
                'name_uz' => 'Izboskan tumani'
            ],
            [
                'parent_id' => 2,
                'name_ru' => 'Улугноpский район',
                'name_uz' => 'Ulug`nor tumani'
            ],
            [
                'parent_id' => 2,
                'name_ru' => 'Кургантепинский район',
                'name_uz' => 'Qo`rg`ontepa tumani'
            ],
            [
                'parent_id' => 2,
                'name_ru' => 'Асакинский район',
                'name_uz' => 'Asaka tumani'
            ],
            [
                'parent_id' => 2,
                'name_ru' => 'Мархаматский район',
                'name_uz' => 'Marxamat tumani'
            ],
            [
                'parent_id' => 2,
                'name_ru' => 'Шахриханский район',
                'name_uz' => 'Shaxrixon tumani'
            ],
            [
                'parent_id' => 2,
                'name_ru' => 'Пахтаабадский район',
                'name_uz' => 'Paxtaobod tumani'
            ],
            [
                'parent_id' => 2,
                'name_ru' => 'Ходжаабадский район',
                'name_uz' => 'Xo`jaobod tumani'
            ],
            [
                'parent_id' => 3,
                'name_ru' => 'город Бухара',
                'name_uz' => 'Buxoro shahri'
            ],
            [
                'parent_id' => 3,
                'name_ru' => 'город Каган',
                'name_uz' => 'Kogon shahri'
            ],
            [
                'parent_id' => 3,
                'name_ru' => 'Алатский район',
                'name_uz' => 'Olot tumani'
            ],
            [
                'parent_id' => 3,
                'name_ru' => 'Бухарский район',
                'name_uz' => 'Buxoro tumani'
            ],
            [
                'parent_id' => 3,
                'name_ru' => 'Вабкентский район',
                'name_uz' => 'Vobkent tumani'
            ],
            [
                'parent_id' => 3,
                'name_ru' => 'Гиждуванский район',
                'name_uz' => 'G`ijduvon tumani'
            ],
            [
                'parent_id' => 3,
                'name_ru' => 'Жондоpский район',
                'name_uz' => 'Jondor tumani'
            ],
            [
                'parent_id' => 3,
                'name_ru' => 'Каганский район',
                'name_uz' => 'Kogon tumani'
            ],
            [
                'parent_id' => 3,
                'name_ru' => 'Каракульский район',
                'name_uz' => 'Qorako`l tumani'
            ],
            [
                'parent_id' => 3,
                'name_ru' => 'Пешкунский район',
                'name_uz' => 'Peshku tumani'
            ],
            [
                'parent_id' => 3,
                'name_ru' => 'Ромитанский район',
                'name_uz' => 'Romitan tumani'
            ],
            [
                'parent_id' => 3,
                'name_ru' => 'Шафирканский район',
                'name_uz' => 'Shofirkon tumani'
            ],
            [
                'parent_id' => 3,
                'name_ru' => 'Караулбазарский район',
                'name_uz' => 'Qorovulbozor tumani'
            ],
            [
                'parent_id' => 4,
                'name_ru' => 'Бахмальский район',
                'name_uz' => 'Baxmal tumani'
            ],
            [
                'parent_id' => 4,
                'name_ru' => 'Галляаральский район',
                'name_uz' => 'G`allaorol tumani'
            ],
            [
                'parent_id' => 4,
                'name_ru' => 'Шароф Рашидовский район',
                'name_uz' => 'Sharof Rashidov tumani'
            ],
            [
                'parent_id' => 4,
                'name_ru' => 'Дустликский район',
                'name_uz' => 'Do`stlik tumani'
            ],
            [
                'parent_id' => 4,
                'name_ru' => 'Зарбдарский район',
                'name_uz' => 'Zarbdor tumani'
            ],
            [
                'parent_id' => 4,
                'name_ru' => 'Зааминский район',
                'name_uz' => 'Zomin tumani'
            ],
            [
                'parent_id' => 4,
                'name_ru' => 'Зафарабадский район',
                'name_uz' => 'Zafarobod tumani'
            ],
            [
                'parent_id' => 4,
                'name_ru' => 'Мирзачульский район',
                'name_uz' => 'Mirzacho`l tumani'
            ],
            [
                'parent_id' => 4,
                'name_ru' => 'Пахтакорский район',
                'name_uz' => 'Paxtakor tumani'
            ],
            [
                'parent_id' => 4,
                'name_ru' => 'Фаришский район',
                'name_uz' => 'Forish tumani'
            ],
            [
                'parent_id' => 4,
                'name_ru' => 'город Джизак',
                'name_uz' => 'Jizzax shahri'
            ],
            [
                'parent_id' => 4,
                'name_ru' => 'Янгиободский район',
                'name_uz' => 'Yangiobod tumani'
            ],
            [
                'parent_id' => 5,
                'name_ru' => 'город Кувасай',
                'name_uz' => 'Quvasoy shahri'
            ],
            [
                'parent_id' => 5,
                'name_ru' => 'город Коканд',
                'name_uz' => 'Qo`qon shahri'
            ],
            [
                'parent_id' => 5,
                'name_ru' => 'город Маpгилан',
                'name_uz' => 'Marg`ilon shahri'
            ],
            [
                'parent_id' => 5,
                'name_ru' => 'город Фергана',
                'name_uz' => 'Farg`ona shahri'
            ],
            [
                'parent_id' => 5,
                'name_ru' => 'Бешарыкский район',
                'name_uz' => 'Beshariq tumani'
            ],
            [
                'parent_id' => 5,
                'name_ru' => 'Багдадский район',
                'name_uz' => 'Bog`dod tumani'
            ],
            [
                'parent_id' => 5,
                'name_ru' => 'Бувайдинский район',
                'name_uz' => 'Buvayda tumani'
            ],
            [
                'parent_id' => 5,
                'name_ru' => 'Дангаринский район',
                'name_uz' => 'Dang`ara tumani'
            ],
            [
                'parent_id' => 5,
                'name_ru' => 'Язъяванский район',
                'name_uz' => 'Yozyovon tumani'
            ],
            [
                'parent_id' => 5,
                'name_ru' => 'Кувинский район',
                'name_uz' => 'Quva tumani'
            ],
            [
                'parent_id' => 5,
                'name_ru' => 'Алтыарыкский район',
                'name_uz' => 'Oltiariq tumani'
            ],
            [
                'parent_id' => 5,
                'name_ru' => 'Куштепинский район',
                'name_uz' => 'Qo`shtepa tumani'
            ],
            [
                'parent_id' => 5,
                'name_ru' => 'Риштанский район',
                'name_uz' => 'Rishton tumani'
            ],
            [
                'parent_id' => 5,
                'name_ru' => 'Сохский район',
                'name_uz' => 'So`x tumani'
            ],
            [
                'parent_id' => 5,
                'name_ru' => 'Ташлакский район',
                'name_uz' => 'Toshloq tumani'
            ],
            [
                'parent_id' => 5,
                'name_ru' => 'Узбекистанский район',
                'name_uz' => 'O`zbekiston tumani'
            ],
            [
                'parent_id' => 5,
                'name_ru' => 'Учкуприкский район',
                'name_uz' => 'Uchko`prik tumani'
            ],
            [
                'parent_id' => 5,
                'name_ru' => 'Ферганский район',
                'name_uz' => 'Farg`ona tumani'
            ],
            [
                'parent_id' => 5,
                'name_ru' => 'Фуркатский район',
                'name_uz' => 'Furqat tumani'
            ],
            [
                'parent_id' => 6,
                'name_ru' => 'город Наманган',
                'name_uz' => 'Namangan shahri'
            ],
            [
                'parent_id' => 6,
                'name_ru' => 'Мингбулакский район',
                'name_uz' => 'Mingbuloq tumani'
            ],
            [
                'parent_id' => 6,
                'name_ru' => 'Касансайский район',
                'name_uz' => 'Kosonsoy tumani'
            ],
            [
                'parent_id' => 6,
                'name_ru' => 'Наманганский район',
                'name_uz' => 'Namangan tumani'
            ],
            [
                'parent_id' => 6,
                'name_ru' => 'Нарынский район',
                'name_uz' => 'Norin tumani'
            ],
            [
                'parent_id' => 6,
                'name_ru' => 'Папский район',
                'name_uz' => 'Pop tumani'
            ],
            [
                'parent_id' => 6,
                'name_ru' => 'Туракурганский район',
                'name_uz' => 'To`raqo`rg`on tumani'
            ],
            [
                'parent_id' => 6,
                'name_ru' => 'Уйчинский район',
                'name_uz' => 'Uychi tumani'
            ],
            [
                'parent_id' => 6,
                'name_ru' => 'Учкурганский район',
                'name_uz' => 'Uchqo`rg`on tumani'
            ],
            [
                'parent_id' => 6,
                'name_ru' => 'Чартакский район',
                'name_uz' => 'Chortoq tumani'
            ],
            [
                'parent_id' => 6,
                'name_ru' => 'Чустский район',
                'name_uz' => 'Chust tumani'
            ],
            [
                'parent_id' => 6,
                'name_ru' => 'Янгикурганский район',
                'name_uz' => 'Yangiqo`rg`on tumani'
            ],
            [
                'parent_id' => 7,
                'name_ru' => 'город Навои',
                'name_uz' => 'Navoiy shahri'
            ],
            [
                'parent_id' => 7,
                'name_ru' => 'город Заpафшан',
                'name_uz' => 'Zarafshon shahri'
            ],
            [
                'parent_id' => 7,
                'name_ru' => 'Учкудукский район',
                'name_uz' => 'Uchquduq tumani'
            ],
            [
                'parent_id' => 7,
                'name_ru' => 'Канимехский район',
                'name_uz' => 'Konimex tumani'
            ],
            [
                'parent_id' => 7,
                'name_ru' => 'Кызылтепинский район',
                'name_uz' => 'Qiziltepa tumani'
            ],
            [
                'parent_id' => 7,
                'name_ru' => 'Тамдынский район',
                'name_uz' => 'Tomdi tumani'
            ],
            [
                'parent_id' => 7,
                'name_ru' => 'Навбахорский район',
                'name_uz' => 'Navbahor tumani'
            ],
            [
                'parent_id' => 7,
                'name_ru' => 'Хатырчинский район',
                'name_uz' => 'Xatirchi tumani'
            ],
            [
                'parent_id' => 7,
                'name_ru' => 'Нуратинский район',
                'name_uz' => 'Nurota tumani'
            ],
            [
                'parent_id' => 7,
                'name_ru' => 'Карманинский район',
                'name_uz' => 'Karmana tumani'
            ],
            [
                'parent_id' => 8,
                'name_ru' => 'город Самарканд',
                'name_uz' => 'Samarqand shahri'
            ],
            [
                'parent_id' => 8,
                'name_ru' => 'Тайлякский район',
                'name_uz' => 'Tayloq tumani'
            ],
            [
                'parent_id' => 8,
                'name_ru' => 'Нарпайский район',
                'name_uz' => 'Narpay tumani'
            ],
            [
                'parent_id' => 8,
                'name_ru' => 'город Каттакурган',
                'name_uz' => 'Kattaqo`rg`on shahri'
            ],
            [
                'parent_id' => 8,
                'name_ru' => 'Пайарыкский район',
                'name_uz' => 'Payariq tumani'
            ],
            [
                'parent_id' => 8,
                'name_ru' => 'Акдарьинский район',
                'name_uz' => 'Oqdaryo tumani'
            ],
            [
                'parent_id' => 8,
                'name_ru' => 'Булунгурский район',
                'name_uz' => 'Bulung`ur tumani'
            ],
            [
                'parent_id' => 8,
                'name_ru' => 'Джамбайский район',
                'name_uz' => 'Jomboy tumani'
            ],
            [
                'parent_id' => 8,
                'name_ru' => 'Иштыханский район',
                'name_uz' => 'Ishtixon tumani'
            ],
            [
                'parent_id' => 8,
                'name_ru' => 'Каттакурганский район',
                'name_uz' => 'Kattaqo`rg`on tumani'
            ],
            [
                'parent_id' => 8,
                'name_ru' => 'Кошрабадский район',
                'name_uz' => 'Qo`shrabot tumani'
            ],
            [
                'parent_id' => 8,
                'name_ru' => 'Пастдаргомский район',
                'name_uz' => 'Pastdarg`om tumani'
            ],
            [
                'parent_id' => 8,
                'name_ru' => 'Пахтачийский район',
                'name_uz' => 'Paxtachi tumani'
            ],
            [
                'parent_id' => 8,
                'name_ru' => 'Самаркандский район',
                'name_uz' => 'Samarqand tumani'
            ],
            [
                'parent_id' => 8,
                'name_ru' => 'Нурабадский район',
                'name_uz' => 'Nurobod tumani'
            ],
            [
                'parent_id' => 8,
                'name_ru' => 'Ургутский район',
                'name_uz' => 'Urgut tumani'
            ],
            [
                'parent_id' => 9,
                'name_ru' => 'город Термез',
                'name_uz' => 'Termiz shahri'
            ],
            [
                'parent_id' => 9,
                'name_ru' => 'Ангорский район',
                'name_uz' => 'Angor tumani'
            ],
            [
                'parent_id' => 9,
                'name_ru' => 'Алтынсайский район',
                'name_uz' => 'Oltinsoy tumani'
            ],
            [
                'parent_id' => 9,
                'name_ru' => 'Байсунский район',
                'name_uz' => 'Boysun tumani'
            ],
            [
                'parent_id' => 9,
                'name_ru' => 'Музрабадский район',
                'name_uz' => 'Muzrabot tumani'
            ],
            [
                'parent_id' => 9,
                'name_ru' => 'Денауский район',
                'name_uz' => 'Denov tumani'
            ],
            [
                'parent_id' => 9,
                'name_ru' => 'Джаркурганский район',
                'name_uz' => 'Jarqo`rg`on tumani'
            ],
            [
                'parent_id' => 9,
                'name_ru' => 'Кумкурганский район',
                'name_uz' => 'Qumqo`rg`on tumani'
            ],
            [
                'parent_id' => 9,
                'name_ru' => 'Кизирикский район',
                'name_uz' => 'Qiziriq tumani'
            ],
            [
                'parent_id' => 9,
                'name_ru' => 'Сариасийский район',
                'name_uz' => 'Sariosiyo tumani'
            ],
            [
                'parent_id' => 9,
                'name_ru' => 'Термезский район',
                'name_uz' => 'Termiz tumani'
            ],
            [
                'parent_id' => 9,
                'name_ru' => 'Шерабадский район',
                'name_uz' => 'Sherobod tumani'
            ],
            [
                'parent_id' => 9,
                'name_ru' => 'Шурчинский район',
                'name_uz' => 'Sho`rchi tumani'
            ],
            [
                'parent_id' => 9,
                'name_ru' => 'Узунский район',
                'name_uz' => 'Uzun tumani'
            ],
            [
                'parent_id' => 10,
                'name_ru' => 'Бекабадский район',
                'name_uz' => 'Bekobod tumani'
            ],
            [
                'parent_id' => 10,
                'name_ru' => 'Букинский район',
                'name_uz' => 'Bo`ka tumani'
            ],
            [
                'parent_id' => 10,
                'name_ru' => 'Бостанлыкский район',
                'name_uz' => 'Bo`stonliq tumani'
            ],
            [
                'parent_id' => 10,
                'name_ru' => 'Зангиатинский район',
                'name_uz' => 'Zangiota tumani'
            ],
            [
                'parent_id' => 10,
                'name_ru' => 'Юкоричирчикский район',
                'name_uz' => 'Yuqorichirchiq tumani'
            ],
            [
                'parent_id' => 10,
                'name_ru' => 'Кибрайский район',
                'name_uz' => 'Qibray tumani'
            ],
            [
                'parent_id' => 10,
                'name_ru' => 'Аккурганский район',
                'name_uz' => 'Oqqo`rg`on tumani'
            ],
            [
                'parent_id' => 10,
                'name_ru' => 'Ахангаранский район',
                'name_uz' => 'Ohangaron tumani'
            ],
            [
                'parent_id' => 10,
                'name_ru' => 'Паркентский район',
                'name_uz' => 'Parkent tumani'
            ],
            [
                'parent_id' => 10,
                'name_ru' => 'Пскентский район',
                'name_uz' => 'Pskent tumani'
            ],
            [
                'parent_id' => 10,
                'name_ru' => 'Ташкентский район',
                'name_uz' => 'Toshkent tumani'
            ],
            [
                'parent_id' => 10,
                'name_ru' => 'Уртачирчикский район',
                'name_uz' => 'O`rtachirchiq tumani'
            ],
            [
                'parent_id' => 10,
                'name_ru' => 'Чиназский район',
                'name_uz' => 'Chinoz tumani'
            ],
            [
                'parent_id' => 10,
                'name_ru' => 'Куйичирчикский район',
                'name_uz' => 'Qiyichirchiq tumani'
            ],
            [
                'parent_id' => 10,
                'name_ru' => 'Янгиюльский район',
                'name_uz' => 'Yangiyo`l tumani'
            ],
            [
                'parent_id' => 10,
                'name_ru' => 'город Ангрен',
                'name_uz' => 'Angren shahri'
            ],
            [
                'parent_id' => 10,
                'name_ru' => 'город Бекабад',
                'name_uz' => 'Bekobod shahri'
            ],
            [
                'parent_id' => 10,
                'name_ru' => 'город Алмалык',
                'name_uz' => 'Olmaliq shahri'
            ],
            [
                'parent_id' => 10,
                'name_ru' => 'город Ахангаран',
                'name_uz' => 'Ohangaron shahri'
            ],
            [
                'parent_id' => 10,
                'name_ru' => 'город Чиpчик',
                'name_uz' => 'Chirchiq shahri'
            ],
            [
                'parent_id' => 10,
                'name_ru' => 'город Янгиюль',
                'name_uz' => 'Yangiyo`l shahri'
            ],
            [
                'parent_id' => 10,
                'name_ru' => 'город Нурафшон',
                'name_uz' => 'Nurafshon shahri'
            ],
            [
                'parent_id' => 11,
                'name_ru' => 'город Карши',
                'name_uz' => 'Qarshi shahri'
            ],
            [
                'parent_id' => 11,
                'name_ru' => 'город Шахрисабз',
                'name_uz' => 'Shahrisabz shahri'
            ],
            [
                'parent_id' => 11,
                'name_ru' => 'Гузарский район',
                'name_uz' => 'G`uzor tumani'
            ],
            [
                'parent_id' => 11,
                'name_ru' => 'Дехканабадский район',
                'name_uz' => 'Dehqonobod tumani'
            ],
            [
                'parent_id' => 11,
                'name_ru' => 'Камашинский район',
                'name_uz' => 'Qamashi tumani'
            ],
            [
                'parent_id' => 11,
                'name_ru' => 'Каршинский район',
                'name_uz' => 'Qarshi tumani'
            ],
            [
                'parent_id' => 11,
                'name_ru' => 'Касанский район',
                'name_uz' => 'Koson tumani'
            ],
            [
                'parent_id' => 11,
                'name_ru' => 'Китабский район',
                'name_uz' => 'Kitob tumani'
            ],
            [
                'parent_id' => 11,
                'name_ru' => 'Мубарекский район',
                'name_uz' => 'Muborak tumani'
            ],
            [
                'parent_id' => 11,
                'name_ru' => 'Нишанский район',
                'name_uz' => 'Nishon tumani'
            ],
            [
                'parent_id' => 11,
                'name_ru' => 'Касбинский район',
                'name_uz' => 'Kasbi tumani'
            ],
            [
                'parent_id' => 11,
                'name_ru' => 'Чиракчинский район',
                'name_uz' => 'Chiroqchi tumani'
            ],
            [
                'parent_id' => 11,
                'name_ru' => 'Шахрисабзский район',
                'name_uz' => 'Shahrisabz tumani'
            ],
            [
                'parent_id' => 11,
                'name_ru' => 'Яккабагский район',
                'name_uz' => 'Yakkabog` tumani'
            ],
            [
                'parent_id' => 11,
                'name_ru' => 'Миришкорский район',
                'name_uz' => 'Mirishkor tumani'
            ],
            [
                'parent_id' => 12,
                'name_ru' => 'город Нукус',
                'name_uz' => 'Nukus shahri'
            ],
            [
                'parent_id' => 12,
                'name_ru' => 'Амударьинский район',
                'name_uz' => 'Amudaryo tumani'
            ],
            [
                'parent_id' => 12,
                'name_ru' => 'Берунийский район',
                'name_uz' => 'Beruniy tumani'
            ],
            [
                'parent_id' => 12,
                'name_ru' => 'Кегейлийский район',
                'name_uz' => 'Kegeyli tumani'
            ],
            [
                'parent_id' => 12,
                'name_ru' => 'Кунградский район',
                'name_uz' => 'Qo`ng`irot tumani'
            ],
            [
                'parent_id' => 12,
                'name_ru' => 'Канлыкульский район',
                'name_uz' => 'Qanliko`l tumani'
            ],
            [
                'parent_id' => 12,
                'name_ru' => 'Муйнакский район',
                'name_uz' => 'Mo`ynoq tumani'
            ],
            [
                'parent_id' => 12,
                'name_ru' => 'Нукусский район',
                'name_uz' => 'Nukus tumani'
            ],
            [
                'parent_id' => 12,
                'name_ru' => 'Тахтакупырский район',
                'name_uz' => 'Taxtako`pir tumani'
            ],
            [
                'parent_id' => 12,
                'name_ru' => 'Турткульский район',
                'name_uz' => 'To`rtko`l tumani'
            ],
            [
                'parent_id' => 12,
                'name_ru' => 'Ходжейлийский район',
                'name_uz' => 'Xo`jayli tumani'
            ],
            [
                'parent_id' => 12,
                'name_ru' => 'Чимбайский район',
                'name_uz' => 'Chimboy tumani'
            ],
            [
                'parent_id' => 12,
                'name_ru' => 'Шуманайский район',
                'name_uz' => 'Shumanay tumani'
            ],
            [
                'parent_id' => 12,
                'name_ru' => 'Элликкалинский район',
                'name_uz' => 'Ellikkala tumani'
            ],
            [
                'parent_id' => 12,
                'name_ru' => 'Караузякский район',
                'name_uz' => 'Qorao`zak tumani'
            ],
            [
                'parent_id' => 12,
                'name_ru' => 'Тахиаташский район',
                'name_uz' => 'Taxiatosh tumani'
            ],
            [
                'parent_id' => 13,
                'name_ru' => 'город Ургенч',
                'name_uz' => 'Urganch shahri'
            ],
            [
                'parent_id' => 13,
                'name_ru' => 'город Хива',
                'name_uz' => 'Xiva shahri'
            ],
            [
                'parent_id' => 13,
                'name_ru' => 'город Питнак',
                'name_uz' => 'Pitnak shahri'
            ],
            [
                'parent_id' => 13,
                'name_ru' => 'Ургенчский район',
                'name_uz' => 'Urganch tumani'
            ],
            [
                'parent_id' => 13,
                'name_ru' => 'Хивинский район',
                'name_uz' => 'Xiva tumani'
            ],
            [
                'parent_id' => 13,
                'name_ru' => 'Хазараспский район',
                'name_uz' => 'Xazorasp tumani'
            ],
            [
                'parent_id' => 13,
                'name_ru' => 'Гурленский район',
                'name_uz' => 'Gurlan tumani'
            ],
            [
                'parent_id' => 13,
                'name_ru' => 'Шаватский район',
                'name_uz' => 'Shovot tumani'
            ],
            [
                'parent_id' => 13,
                'name_ru' => 'Янгиарыкский район',
                'name_uz' => 'Yangiariq tumani'
            ],
            [
                'parent_id' => 13,
                'name_ru' => 'Кошкупырский район',
                'name_uz' => 'Qo`shko`pir tumani'
            ],
            [
                'parent_id' => 13,
                'name_ru' => 'Багатский район',
                'name_uz' => 'Bog`ot tumani'
            ],
            [
                'parent_id' => 13,
                'name_ru' => 'Ханкинский район',
                'name_uz' => 'Xonqa tumani'
            ],
            [
                'parent_id' => 13,
                'name_ru' => 'Янгибазарский район',
                'name_uz' => 'Yangibozor tumani'
            ],
            [
                'parent_id' => 14,
                'name_ru' => 'Акалтынский район',
                'name_uz' => 'Oqoltin tumani'
            ],
            [
                'parent_id' => 14,
                'name_ru' => 'Баяутский район',
                'name_uz' => 'Boyovut tumani'
            ],
            [
                'parent_id' => 14,
                'name_ru' => 'Гулистанский район',
                'name_uz' => 'Guliston tumani'
            ],
            [
                'parent_id' => 14,
                'name_ru' => 'Мирзаабадский район',
                'name_uz' => 'Mirzaobod tumani'
            ],
            [
                'parent_id' => 14,
                'name_ru' => 'Сайхунабадский район',
                'name_uz' => 'Sayxunobod tumani'
            ],
            [
                'parent_id' => 14,
                'name_ru' => 'Сырдарьинский район',
                'name_uz' => 'Sirdaryo tumani'
            ],
            [
                'parent_id' => 14,
                'name_ru' => 'Хавастский район',
                'name_uz' => 'Xavast tumani'
            ],
            [
                'parent_id' => 14,
                'name_ru' => 'Сардобский район',
                'name_uz' => 'Sardoba tumani'
            ],
            [
                'parent_id' => 14,
                'name_ru' => 'город Гулистан',
                'name_uz' => 'Guliston shahri'
            ],
            [
                'parent_id' => 14,
                'name_ru' => 'город Шиpин',
                'name_uz' => 'Shirin shahri'
            ],
            [
                'parent_id' => 14,
                'name_ru' => 'город Янгиеp',
                'name_uz' => 'Yangiyer shahri'
            ],
        ];
        foreach ($regions as $region) {
            Location::query()->create($region);
        }
    }
}
