<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class citySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // DB::table('cities')->truncate();
        $cities=[
    // الدقهلية = 1
    [
        'governrate_id' => 1,
        'name' => ['ar' => 'المنصورة', 'en' => 'Al Mansurah'],
    ],
    [
        'governrate_id' => 1,
        'name' => ['ar' => 'المنزلة', 'en' => 'Al Manzalah'],
    ],
    [
        'governrate_id' => 1,
        'name' => ['ar' => 'المطرية', 'en' => 'Al Matariyah'],
    ],
    [
        'governrate_id' => 1,
        'name' => ['ar' => 'الجمالية', 'en' => 'Al Jammaliyah'],
    ],
    [
        'governrate_id' => 1,
        'name' => ['ar' => 'أجا', 'en' => 'Aja'],
    ],
    [
        'governrate_id' => 1,
        'name' => ['ar' => 'بلقاس', 'en' => 'Bilqas'],
    ],
    [
        'governrate_id' => 1,
        'name' => ['ar' => 'دكرنس', 'en' => 'Dikirnis'],
    ],
    [
        'governrate_id' => 1,
        'name' => ['ar' => 'شربين', 'en' => 'Shirbin'],
    ],
    [
        'governrate_id' => 1,
        'name' => ['ar' => 'طلخا', 'en' => 'Talkha'],
    ],
    [
        'governrate_id' => 1,
        'name' => ['ar' => 'منية النصر', 'en' => 'Minyat an Nasr'],
    ],
    [
        'governrate_id' => 1,
        'name' => ['ar' => 'عزبة البرج', 'en' => 'Izbat al Burj'],
    ],
    [
        'governrate_id' => 1,
        'name' => ['ar' => 'ميت غمر', 'en' => 'Mit Ghamr'],
    ],
    [
        'governrate_id' => 1,
        'name' => ['ar' => 'السنبلاوين', 'en' => 'Sinballawn'],
    ],
    [
        'governrate_id' => 1,
        'name' => ['ar' => 'نبروه', 'en' => 'Nabruh'],
    ],
    [
        'governrate_id' => 1,
        'name' => ['ar' => 'بني عبيد', 'en' => 'Bani Ubaid'],
    ],

    // البحر الأحمر = 2
    [
        'governrate_id' => 2,
        'name' => ['ar' => 'الغردقة', 'en' => 'Hurghada'],
    ],
    [
        'governrate_id' => 2,
        'name' => ['ar' => 'الجونة', 'en' => 'El Gouna'],
    ],
    [
        'governrate_id' => 2,
        'name' => ['ar' => 'القصير', 'en' => 'Al Qusayr'],
    ],
    [
        'governrate_id' => 2,
        'name' => ['ar' => 'صفاجا', 'en' => 'Safaga'],
    ],
    [
        'governrate_id' => 2,
        'name' => ['ar' => 'مرسى علم', 'en' => 'Marsa Alam'],
    ],
    [
        'governrate_id' => 2,
        'name' => ['ar' => 'رأس غارب', 'en' => 'Ras Gharib'],
    ],
    [
        'governrate_id' => 2,
        'name' => ['ar' => 'سفاجا', 'en' => 'Safaga'],
    ],
    [
        'governrate_id' => 2,
        'name' => ['ar' => 'شلاتين', 'en' => 'Shalatin'],
    ],
    [
        'governrate_id' => 2,
        'name' => ['ar' => 'حلايب', 'en' => 'Halayeb'],
    ],

    // البحيرة = 3
    [
        'governrate_id' => 3,
        'name' => ['ar' => 'أبو المطامير', 'en' => 'Abu al Matamir'],
    ],
    [
        'governrate_id' => 3,
        'name' => ['ar' => 'أد دلنجات', 'en' => 'Ad Dilinjat'],
    ],
    [
        'governrate_id' => 3,
        'name' => ['ar' => 'دمنهور', 'en' => 'Damanhur'],
    ],
    [
        'governrate_id' => 3,
        'name' => ['ar' => 'حوش عيسى', 'en' => 'Hawsh Isa'],
    ],
    [
        'governrate_id' => 3,
        'name' => ['ar' => 'إدكو', 'en' => 'Idku'],
    ],
    [
        'governrate_id' => 3,
        'name' => ['ar' => 'كفر الدوار', 'en' => 'Kafr ad Dawwar'],
    ],
    [
        'governrate_id' => 3,
        'name' => ['ar' => 'كوم حمادة', 'en' => 'Kawm Hamadah'],
    ],
    [
        'governrate_id' => 3,
        'name' => ['ar' => 'رشيد', 'en' => 'Rosetta'],
    ],
    [
        'governrate_id' => 3,
        'name' => ['ar' => 'أبو حمص', 'en' => 'Abu Hummus'],
    ],
    [
        'governrate_id' => 3,
        'name' => ['ar' => 'الدلنجات', 'en' => 'Al Delengat'],
    ],
    [
        'governrate_id' => 3,
        'name' => ['ar' => 'المحمودية', 'en' => 'Al Mahmudiyah'],
    ],
    [
        'governrate_id' => 3,
        'name' => ['ar' => 'شبراخيت', 'en' => 'Shubra Khit'],
    ],
    [
        'governrate_id' => 3,
        'name' => ['ar' => 'وادي النطرون', 'en' => 'Wadi al Natrun'],
    ],

    // الفيوم = 4
    [
        'governrate_id' => 4,
        'name' => ['ar' => 'الفيوم', 'en' => 'Al Fayyum'],
    ],
    [
        'governrate_id' => 4,
        'name' => ['ar' => 'الواسطة', 'en' => 'Al Wasitah'],
    ],
    [
        'governrate_id' => 4,
        'name' => ['ar' => 'إبشواي', 'en' => 'Ibshaway'],
    ],
    [
        'governrate_id' => 4,
        'name' => ['ar' => 'إطسا', 'en' => 'Itsa'],
    ],
    [
        'governrate_id' => 4,
        'name' => ['ar' => 'طامية', 'en' => 'Tamiyah'],
    ],
    [
        'governrate_id' => 4,
        'name' => ['ar' => 'سنورس', 'en' => 'Sinnuris'],
    ],
    [
        'governrate_id' => 4,
        'name' => ['ar' => 'يوسف الصديق', 'en' => 'Yusuf al Siddiq'],
    ],

    // الغربية = 5
    [
        'governrate_id' => 5,
        'name' => ['ar' => 'المحلة الكبرى', 'en' => 'Al Mahallah al Kubra'],
    ],
    [
        'governrate_id' => 5,
        'name' => ['ar' => 'بسيون', 'en' => 'Basyun'],
    ],
    [
        'governrate_id' => 5,
        'name' => ['ar' => 'كفر الزيات', 'en' => 'Kafr az Zayyat'],
    ],
    [
        'governrate_id' => 5,
        'name' => ['ar' => 'قطور', 'en' => 'Qutur'],
    ],
    [
        'governrate_id' => 5,
        'name' => ['ar' => 'سمنود', 'en' => 'Samannud'],
    ],
    [
        'governrate_id' => 5,
        'name' => ['ar' => 'طنطا', 'en' => 'Tanta'],
    ],
    [
        'governrate_id' => 5,
        'name' => ['ar' => 'زفتى', 'en' => 'Zefta'],
    ],
    [
        'governrate_id' => 5,
        'name' => ['ar' => 'السنطة', 'en' => 'Al Santa'],
    ],

    // الإسكندرية = 6
    [
        'governrate_id' => 6,
        'name' => ['ar' => 'الإسكندرية', 'en' => 'Alexandria'],
    ],
    [
        'governrate_id' => 6,
        'name' => ['ar' => 'العجمي', 'en' => 'Al Agami'],
    ],
    [
        'governrate_id' => 6,
        'name' => ['ar' => 'المنتزه', 'en' => 'Al Montazah'],
    ],
    [
        'governrate_id' => 6,
        'name' => ['ar' => 'برج العرب', 'en' => 'Borg El Arab'],
    ],
    [
        'governrate_id' => 6,
        'name' => ['ar' => 'أبو قير', 'en' => 'Abu Qir'],
    ],
    [
        'governrate_id' => 6,
        'name' => ['ar' => 'الدخيلة', 'en' => 'Al Dekhela'],
    ],
    [
        'governrate_id' => 6,
        'name' => ['ar' => 'كرموز', 'en' => 'Karmouz'],
    ],

    // الإسماعيلية = 7
    [
        'governrate_id' => 7,
        'name' => ['ar' => 'الإسماعيلية', 'en' => 'Ismailia'],
    ],
    [
        'governrate_id' => 7,
        'name' => ['ar' => 'أبو صوير', 'en' => 'Abu Suwayr'],
    ],
    [
        'governrate_id' => 7,
        'name' => ['ar' => 'القنطرة', 'en' => 'Al Qantarah'],
    ],
    [
        'governrate_id' => 7,
        'name' => ['ar' => 'فايد', 'en' => 'Fayed'],
    ],
    [
        'governrate_id' => 7,
        'name' => ['ar' => 'التل الكبير', 'en' => 'Tell el Kebir'],
    ],

    // الجيزة = 8
    [
        'governrate_id' => 8,
        'name' => ['ar' => 'الجيزة', 'en' => 'Giza'],
    ],
 
    [
        'governrate_id' => 8,
        'name' => ['ar' => 'الباويطي', 'en' => 'Al Bawiti'],
    ],
    [
        'governrate_id' => 8,
        'name' => ['ar' => 'الحوامدية', 'en' => 'Al Hawamidiyah'],
    ],
    [
        'governrate_id' => 8,
        'name' => ['ar' => 'الصف', 'en' => 'As Saff'],
    ],
    [
        'governrate_id' => 8,
        'name' => ['ar' => 'أوسيم', 'en' => 'Awsim'],
    ],
    [
        'governrate_id' => 8,
        'name' => ['ar' => 'مدينة السادس من أكتوبر', 'en' => 'Madinat Sittah Uktubar'],
    ],
    [
        'governrate_id' => 8,
        'name' => ['ar' => 'العياط', 'en' => 'Al Ayyat'],
    ],
    [
        'governrate_id' => 8,
        'name' => ['ar' => 'البدرشين', 'en' => 'Al Badrasheen'],
    ],
    [
        'governrate_id' => 8,
        'name' => ['ar' => 'أبو النمرس', 'en' => 'Abu al Numrus'],
    ],
    [
        'governrate_id' => 8,
        'name' => ['ar' => 'العمرانية', 'en' => 'Al Omraneyah'],
    ],

    // المنوفية = 9
    [
        'governrate_id' => 9,
        'name' => ['ar' => 'البجور', 'en' => 'Al Bajur'],
    ],
    [
        'governrate_id' => 9,
        'name' => ['ar' => 'أشمون', 'en' => 'Ashmun'],
    ],
    [
        'governrate_id' => 9,
        'name' => ['ar' => 'الشهداء', 'en' => 'Ash Shuhada'],
    ],
    [
        'governrate_id' => 9,
        'name' => ['ar' => 'منوف', 'en' => 'Munuf'],
    ],
    [
        'governrate_id' => 9,
        'name' => ['ar' => 'قويسنا', 'en' => 'Quwaysina'],
    ],
    [
        'governrate_id' => 9,
        'name' => ['ar' => 'شبين الكوم', 'en' => 'Shibin al Kawm'],
    ],
    [
        'governrate_id' => 9,
        'name' => ['ar' => 'تلا', 'en' => 'Tala'],
    ],
    [
        'governrate_id' => 9,
        'name' => ['ar' => 'السادات', 'en' => 'Sadat City'],
    ],
    [
        'governrate_id' => 9,
        'name' => ['ar' => 'مينا البصل', 'en' => 'Mina al Basal'],
    ],

    // المنيا = 10
    [
        'governrate_id' => 10,
        'name' => ['ar' => 'المنيا', 'en' => 'Minya'],
    ],
    [
        'governrate_id' => 10,
        'name' => ['ar' => 'أبو قرقاص', 'en' => 'Abu Qurqas'],
    ],
    [
        'governrate_id' => 10,
        'name' => ['ar' => 'بني مزار', 'en' => 'Bani Mazar'],
    ],
  
    [
        'governrate_id' => 10,
        'name' => ['ar' => 'العدوة', 'en' => 'Al Adwah'],
    ],
    [
        'governrate_id' => 10,
        'name' => ['ar' => 'مطاي', 'en' => 'Matay'],
    ],
    [
        'governrate_id' => 10,
        'name' => ['ar' => 'ملوي', 'en' => 'Mallawi'],
    ],
    [
        'governrate_id' => 10,
        'name' => ['ar' => 'سمالوط', 'en' => 'Samalut'],
    ],
    [
        'governrate_id' => 10,
        'name' => ['ar' => 'مغاغة', 'en' => 'Maghagha'],
    ],

    // القاهرة = 11
    [
        'governrate_id' => 11,
        'name' => ['ar' => 'القاهرة', 'en' => 'Cairo'],
    ],
    [
        'governrate_id' => 11,
        'name' => ['ar' => 'مدينة نصر', 'en' => 'Nasr City'],
    ],
    [
        'governrate_id' => 11,
        'name' => ['ar' => 'المعادي', 'en' => 'Maadi'],
    ],
    [
        'governrate_id' => 11,
        'name' => ['ar' => 'مصر الجديدة', 'en' => 'Heliopolis'],
    ],
    [
        'governrate_id' => 11,
        'name' => ['ar' => 'حلوان', 'en' => 'Helwan'],
    ],
    [
        'governrate_id' => 11,
        'name' => ['ar' => 'شبرا', 'en' => 'Shubra'],
    ],
    [
        'governrate_id' => 11,
        'name' => ['ar' => 'الزيتون', 'en' => 'Zeitoun'],
    ],
    [
        'governrate_id' => 11,
        'name' => ['ar' => 'عين شمس', 'en' => 'Ain Shams'],
    ],
    [
        'governrate_id' => 11,
        'name' => ['ar' => 'المرج', 'en' => 'Al Marg'],
    ],
    [
        'governrate_id' => 11,
        'name' => ['ar' => 'التجمع الخامس', 'en' => 'Fifth Settlement'],
    ],
    [
        'governrate_id' => 11,
        'name' => ['ar' => 'المقطم', 'en' => 'Al Muqattam'],
    ],

    // القليوبية = 12
    [
        'governrate_id' => 12,
        'name' => ['ar' => 'بنها', 'en' => 'Banha'],
    ],
    [
        'governrate_id' => 12,
        'name' => ['ar' => 'شبرا الخيمة', 'en' => 'Shubra al Khaymah'],
    ],
    [
        'governrate_id' => 12,
        'name' => ['ar' => 'قليوب', 'en' => 'Qalyub'],
    ],
    [
        'governrate_id' => 12,
        'name' => ['ar' => 'القناطر الخيرية', 'en' => 'Al Qanater al Khayriyah'],
    ],
    [
        'governrate_id' => 12,
        'name' => ['ar' => 'طوخ', 'en' => 'Tukh'],
    ],
    [
        'governrate_id' => 12,
        'name' => ['ar' => 'الخانكة', 'en' => 'Al Khanka'],
    ],
    [
        'governrate_id' => 12,
        'name' => ['ar' => 'كفر شكر', 'en' => 'Kafr Shukr'],
    ],
    [
        'governrate_id' => 12,
        'name' => ['ar' => 'أبو زعبل', 'en' => 'Abu Zaabal'],
    ],

    // الوادي الجديد = 13
    [
        'governrate_id' => 13,
        'name' => ['ar' => 'الخارجة', 'en' => 'Al Kharga'],
    ],
    [
        'governrate_id' => 13,
        'name' => ['ar' => 'الداخلة', 'en' => 'Al Dakhla'],
    ],
    [
        'governrate_id' => 13,
        'name' => ['ar' => 'الفرافرة', 'en' => 'Al Farafra'],
    ],
    [
        'governrate_id' => 13,
        'name' => ['ar' => 'بلاط', 'en' => 'Balat'],
    ],
    [
        'governrate_id' => 13,
        'name' => ['ar' => 'باريس', 'en' => 'Paris'],
    ],

    // الشرقية = 14
    [
        'governrate_id' => 14,
        'name' => ['ar' => 'الزقازيق', 'en' => 'Zagazig'],
    ],
    [
        'governrate_id' => 14,
        'name' => ['ar' => 'العاشر من رمضان', 'en' => 'Tenth of Ramadan City'],
    ],
    [
        'governrate_id' => 14,
        'name' => ['ar' => 'أبو كبير', 'en' => 'Abu Kabir'],
    ],
    [
        'governrate_id' => 14,
        'name' => ['ar' => 'بلبيس', 'en' => 'Bilbays'],
    ],
    [
        'governrate_id' => 14,
        'name' => ['ar' => 'ديرب نجم', 'en' => 'Diyarb Negm'],
    ],
    [
        'governrate_id' => 14,
        'name' => ['ar' => 'فاقوس', 'en' => 'Faqus'],
    ],
    [
        'governrate_id' => 14,
        'name' => ['ar' => 'الإبراهيمية', 'en' => 'Al Ibrahimiyah'],
    ],
    [
        'governrate_id' => 14,
        'name' => ['ar' => 'منيا القمح', 'en' => 'Minya al Qamh'],
    ],
    [
        'governrate_id' => 14,
        'name' => ['ar' => 'ههيا', 'en' => 'Hihya'],
    ],

    // السويس = 15
    [
        'governrate_id' => 15,
        'name' => ['ar' => 'السويس', 'en' => 'Suez'],
    ],
    [
        'governrate_id' => 15,
        'name' => ['ar' => 'عتاقة', 'en' => 'Ataqah'],
    ],
    [
        'governrate_id' => 15,
        'name' => ['ar' => 'الأربعين', 'en' => 'Al Arbaeen'],
    ],
    [
        'governrate_id' => 15,
        'name' => ['ar' => 'فيصل', 'en' => 'Faysal'],
    ],

    // أسوان = 16
    [
        'governrate_id' => 16,
        'name' => ['ar' => 'أسوان', 'en' => 'Aswan'],
    ],
    [
        'governrate_id' => 16,
        'name' => ['ar' => 'أبو سمبل', 'en' => 'Abu Simbel'],
    ],
    [
        'governrate_id' => 16,
        'name' => ['ar' => 'إدفو', 'en' => 'Edfu'],
    ],
    [
        'governrate_id' => 16,
        'name' => ['ar' => 'كوم أمبو', 'en' => 'Kom Ombo'],
    ],
    [
        'governrate_id' => 16,
        'name' => ['ar' => 'نصر النوبة', 'en' => 'Nasr al Nuba'],
    ],
    [
        'governrate_id' => 16,
        'name' => ['ar' => 'دراو', 'en' => 'Daraw'],
    ],

    // أسيوط = 17
    [
        'governrate_id' => 17,
        'name' => ['ar' => 'أسيوط', 'en' => 'Asyut'],
    ],
    [
        'governrate_id' => 17,
        'name' => ['ar' => 'أبنوب', 'en' => 'Abnub'],
    ],
    [
        'governrate_id' => 17,
        'name' => ['ar' => 'البداري', 'en' => 'Al Badari'],
    ],
    [
        'governrate_id' => 17,
        'name' => ['ar' => 'ديروط', 'en' => 'Dayrut'],
    ],
    [
        'governrate_id' => 17,
        'name' => ['ar' => 'القوصية', 'en' => 'Al Qusiyah'],
    ],
    [
        'governrate_id' => 17,
        'name' => ['ar' => 'منفلوط', 'en' => 'Manfalut'],
    ],
    [
        'governrate_id' => 17,
        'name' => ['ar' => 'صدفا', 'en' => 'Sadfa'],
    ],
    [
        'governrate_id' => 17,
        'name' => ['ar' => 'سوهاج', 'en' => 'Suhaj'],
    ],

    // بني سويف = 18
    [
        'governrate_id' => 18,
        'name' => ['ar' => 'بني سويف', 'en' => 'Beni Suweif'],
    ],
    [
        'governrate_id' => 18,
        'name' => ['ar' => 'الفشن', 'en' => 'Al Fashn'],
    ],
    [
        'governrate_id' => 18,
        'name' => ['ar' => 'ببا', 'en' => 'Buba'],
    ],
    [
        'governrate_id' => 18,
        'name' => ['ar' => 'إهناسيا', 'en' => 'Ihnasiyah'],
    ],
    [
        'governrate_id' => 18,
        'name' => ['ar' => 'الواسطى', 'en' => 'Al Wastah'],
    ],
    [
        'governrate_id' => 18,
        'name' => ['ar' => 'سمسطا', 'en' => 'Sumusta'],
    ],

    // بور سعيد = 19
    [
        'governrate_id' => 19,
        'name' => ['ar' => 'بور سعيد', 'en' => 'Port Said'],
    ],
    [
        'governrate_id' => 19,
        'name' => ['ar' => 'بور فؤاد', 'en' => 'Port Fuad'],
    ],
    [
        'governrate_id' => 19,
        'name' => ['ar' => 'الزهور', 'en' => 'Al Zuhur'],
    ],
    [
        'governrate_id' => 19,
        'name' => ['ar' => 'الشرق', 'en' => 'Al Sharq'],
    ],

    // دمياط = 20
    [
        'governrate_id' => 20,
        'name' => ['ar' => 'دمياط', 'en' => 'Damietta'],
    ],
    [
        'governrate_id' => 20,
        'name' => ['ar' => 'رأس البر', 'en' => 'Ras al Bar'],
    ],
    [
        'governrate_id' => 20,
        'name' => ['ar' => 'الزرقا', 'en' => 'Al Zarqa'],
    ],
    [
        'governrate_id' => 20,
        'name' => ['ar' => 'فارسكور', 'en' => 'Faraskur'],
    ],
    [
        'governrate_id' => 20,
        'name' => ['ar' => 'كفر سعد', 'en' => 'Kafr Saad'],
    ],


    // كفر الشيخ = 21
    [
        'governrate_id' => 21,
        'name' => ['ar' => 'كفر الشيخ', 'en' => 'Kafr el-Sheikh'],
    ],
    [
        'governrate_id' => 21,
        'name' => ['ar' => 'بيلا', 'en' => 'Bila'],
    ],
    [
        'governrate_id' => 21,
        'name' => ['ar' => 'دسوق', 'en' => 'Desouk'],
    ],
    [
        'governrate_id' => 21,
        'name' => ['ar' => 'فوه', 'en' => 'Fuwwah'],
    ],
    [
        'governrate_id' => 21,
        'name' => ['ar' => 'الحامول', 'en' => 'Al Hamul'],
    ],
    [
        'governrate_id' => 21,
        'name' => ['ar' => 'مطوبس', 'en' => 'Mutubis'],
    ],
    [
        'governrate_id' => 21,
        'name' => ['ar' => 'سيدي سالم', 'en' => 'Sidi Salem'],
    ],
    [
        'governrate_id' => 21,
        'name' => ['ar' => 'قلين', 'en' => 'Qilin'],
    ],

    // مطروح = 22
    [
        'governrate_id' => 22,
        'name' => ['ar' => 'مرسى مطروح', 'en' => 'Marsa Matruh'],
    ],
    [
        'governrate_id' => 22,
        'name' => ['ar' => 'العلمين', 'en' => 'Al Alamayn'],
    ],
    [
        'governrate_id' => 22,
        'name' => ['ar' => 'السلوم', 'en' => 'As Sallum'],
    ],
    [
        'governrate_id' => 22,
        'name' => ['ar' => 'واحة سيوة', 'en' => 'Siwa Oasis'],
    ],
    [
        'governrate_id' => 22,
        'name' => ['ar' => 'الضبعة', 'en' => 'Al Dabaa'],
    ],
    [
        'governrate_id' => 22,
        'name' => ['ar' => 'النجيلة', 'en' => 'Al Nagila'],
    ],

    // قنا = 23
    [
        'governrate_id' => 23,
        'name' => ['ar' => 'قنا', 'en' => 'Qena'],
    ],
    [
        'governrate_id' => 23,
        'name' => ['ar' => 'أبو تشت', 'en' => 'Abu Tesht'],
    ],
    [
        'governrate_id' => 23,
        'name' => ['ar' => 'دشنا', 'en' => 'Dishna'],
    ],
    [
        'governrate_id' => 23,
        'name' => ['ar' => 'فرشوط', 'en' => 'Farshut'],
    ],
    [
        'governrate_id' => 23,
        'name' => ['ar' => 'نجع حمادي', 'en' => 'Nag Hammadi'],
    ],
    [
        'governrate_id' => 23,
        'name' => ['ar' => 'قفط', 'en' => 'Qift'],
    ],
    [
        'governrate_id' => 23,
        'name' => ['ar' => 'قوص', 'en' => 'Qus'],
    ],

    // سوهاج = 24
    [
        'governrate_id' => 24,
        'name' => ['ar' => 'سوهاج', 'en' => 'Sohag'],
    ],
    [
        'governrate_id' => 24,
        'name' => ['ar' => 'أخميم', 'en' => 'Akhmim'],
    ],
    [
        'governrate_id' => 24,
        'name' => ['ar' => 'البلينا', 'en' => 'Al Balyana'],
    ],
    [
        'governrate_id' => 24,
        'name' => ['ar' => 'جرجا', 'en' => 'Girga'],
    ],
    [
        'governrate_id' => 24,
        'name' => ['ar' => 'جهينة', 'en' => 'Juhaynah'],
    ],
    [
        'governrate_id' => 24,
        'name' => ['ar' => 'المراغة', 'en' => 'Al Maragha'],
    ],
    [
        'governrate_id' => 24,
        'name' => ['ar' => 'المنشأة', 'en' => 'Al Manshah'],
    ],
    [
        'governrate_id' => 24,
        'name' => ['ar' => 'طهطا', 'en' => 'Tahta'],
    ],
    [
        'governrate_id' => 24,
        'name' => ['ar' => 'تما', 'en' => 'Tema'],
    ],

    // جنوب سيناء = 25
    [
        'governrate_id' => 25,
        'name' => ['ar' => 'الطور', 'en' => 'El-Tor'],
    ],
    [
        'governrate_id' => 25,
        'name' => ['ar' => 'دهب', 'en' => 'Dahab'],
    ],
    [
        'governrate_id' => 25,
        'name' => ['ar' => 'شرم الشيخ', 'en' => 'Sharm el-Sheikh'],
    ],
    [
        'governrate_id' => 25,
        'name' => ['ar' => 'نويبع', 'en' => 'Nuweiba'],
    ],
    [
        'governrate_id' => 25,
        'name' => ['ar' => 'طابا', 'en' => 'Taba'],
    ],
    [
        'governrate_id' => 25,
        'name' => ['ar' => 'سانت كاترين', 'en' => 'Saint Catherine'],
    ],

    // شمال سيناء = 26
    [
        'governrate_id' => 26,
        'name' => ['ar' => 'العريش', 'en' => 'Arish'],
    ],
    [
        'governrate_id' => 26,
        'name' => ['ar' => 'رفح', 'en' => 'Rafah'],
    ],
    [
        'governrate_id' => 26,
        'name' => ['ar' => 'الشيخ زويد', 'en' => 'Sheikh Zuweid'],
    ],
    [
        'governrate_id' => 26,
        'name' => ['ar' => 'بير العبد', 'en' => 'Bir al Abd'],
    ],
    [
        'governrate_id' => 26,
        'name' => ['ar' => 'نخل', 'en' => 'Nakhl'],
    ],

    // الأقصر = 27
    [
        'governrate_id' => 27,
        'name' => ['ar' => 'الأقصر', 'en' => 'Luxor'],
    ],
    [
        'governrate_id' => 27,
        'name' => ['ar' => 'الأقصر الغربية', 'en' => 'West Luxor'],
    ],
    [
        'governrate_id' => 27,
        'name' => ['ar' => 'إسنا', 'en' => 'Isna'],
    ],
    [
        'governrate_id' => 27,
        'name' => ['ar' => 'أرمنت', 'en' => 'Armant'],
    ],
    [
        'governrate_id' => 27,
        'name' => ['ar' => 'الطود', 'en' => 'Al Tud'],
    ],
];
 

    foreach ($cities as $city) {
        City::create($city);
    }
}
   }