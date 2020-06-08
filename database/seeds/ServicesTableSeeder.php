<?php

use Illuminate\Database\Seeder;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $service = new \App\Service([
            'service_name' => 'Blood Test',
            'service_desc' => 'When menopause begins, estrogen levels drop which often leads to hot flashes.  Doctors refer to this as a vasomotor symptom which is believed to be caused by hormonal fluctuations. The recurrence of these symptoms generally last between two and five years but in some cases can even last decades. The following are also common symptoms of menopause:

                <br><br>
                <ul>
                    <li>Night sweats</li>
                    <li>Nausea</li>
                    <li>Dizzy spells</li>
                    <li>Palpitations</li>
                    <li>Vaginal dryness</li>
                    <li>Reduced sex drive</li>
                    <li>Genital or urinary disturbances</li>
                </ul>
                <br><br>
                Sex hormones regulate the high metabolism levels necessary for reproduction. Their decrease leads to a sudden lowering of the metabolism and acceleration of the aging process. This results in a higher risk of osteoporosis and disabilities.',
            'service_price' => 400
        ]);
        $service->save();

        $service = new \App\Service([
            'service_name' => 'Menopause',
            'service_desc' => 'When menopause begins, estrogen levels drop which often leads to hot flashes.  Doctors refer to this as a vasomotor symptom which is believed to be caused by hormonal fluctuations. The recurrence of these symptoms generally last between two and five years but in some cases can even last decades. The following are also common symptoms of menopause:

                <br><br>
                <ul>
                    <li>Night sweats</li>
                    <li>Nausea</li>
                    <li>Dizzy spells</li>
                    <li>Palpitations</li>
                    <li>Vaginal dryness</li>
                    <li>Reduced sex drive</li>
                    <li>Genital or urinary disturbances</li>
                </ul>
                <br><br>
                Sex hormones regulate the high metabolism levels necessary for reproduction. Their decrease leads to a sudden lowering of the metabolism and acceleration of the aging process. This results in a higher risk of osteoporosis and disabilities.',
            'service_price' => 400
        ]);
        $service->save();
        
        $service = new \App\Service([
            'service_name' => 'Check Up',
            'service_desc' => 'At Health Life is Possible, we offer health check-ups that are tailored to your age, gender, and specific conditions that require medical follow-ups. This can be your starting point to a healthier well-being.
                        <br><br>
                        Health Life is Possible can provide you with an assessment of your medical history and your lifestyle habits. We will carry out an extensive physical exam that includes any necessary laboratory tests.
                        <br><br>
                        We will contact you to inform you of the results, often within 48 business hours of taking samples from you.
                        <br><br>
                        We will also provide you with appropriate recommendations and you will be able to get a follow-up appointment with one of our private clinic\'s family doctors.',
            'service_price' => 300
        ]);
        $service->save();
    }
}
