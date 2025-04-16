<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use ZohoCrmSDK\Api\ZohoCrmApi;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class ArtemTest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:artem-test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $c = $this::naGopeShert(1, 2);
        dump($c);

        $this::creatContact_with_Deals_and_Tasks('Nastya', 'Sky', 'nastyaSky@gmail.com', 'Nastya2', '2021-12-31', 'Qualification', 'Nastya2', '2021-12-31', 'Not Started', 'High');

        $this::creatSubform('Zoho', '2020-12-31', '6317174000001468002');


        $this::COQLDATA();

        $this::COQLDATAREC();

        $this::searchContactsByCreatedDate(Carbon::now()->subWeeks(2)->toAtomString(),Carbon::now()->toAtomString());

        $this::AddAttachment('6317174000001468002');

        $this::DownloadAttachment('631717400000146800');

        echo "hi " . date('Y-m-d H:i:s') . "\n";
        $this->line('Current time: ' . Carbon::now());


        $this::getContacts();






    }

    public static function getContacts($page = 1, $perPage = 40)
    {
        $deals = ZohoCrmApi::getInstance()
            ->setModule('Deals')
            ->records()
            ->getRecords() // Предполагаем, что есть связь с 'Deals'
            ->request();

        dump($deals);
    }

    public static function DownloadAttachment($zohoId)
    {
        try {
            $attachments = ZohoCrmApi::getInstance()
                ->setModule('Contacts')
                ->records()
                ->allAttachments($zohoId)
                ->request();
            var_dump($attachments);
        } catch (\Exception $exception) {
            $attachments = null;
        }
    }

    public static function AddAttachment($zohoId)
    {
        try {
            $attachments = ZohoCrmApi::getInstance()
                ->setModule('Contacts')
                ->records()
                ->uploadAttachment($zohoId, base_path('app/file/test.txt'))
                ->request();
        } catch (\Exception $exception) {
            $attachments = null;
            echo 'Problem';
        }
    }

    public static function searchContactsByCreatedDate($dateTime1, $dateTime2)
    {
        $response = ZohoCrmApi::getInstance()
            ->setModule('Contacts')
            ->records()
            ->queryCOQL()
            ->columns(['Full_Name', 'Created_Time'])
            ->whereSearchMap([
                ['Created_Time', '>', $dateTime1],
                'and',
                ['Created_Time', '<', $dateTime2]
            ])
            ->page(1)
            ->perPage(200)
            ->request();
//        var_dump($response);

        // Проверяем, что $response успешно получен
        if (is_array($response) && !empty($response)) {
            // Выводим данные из объекта response->data
            foreach ($response as $contact) {
                echo "Full Name: {$contact['Full_Name']}, Created Time: {$contact['Created_Time']}\n";
            }
        } else {
            // Выводим ошибку или обрабатываем другим способом
            echo "Ошибка: неверный формат ответа от API";
            return;
        }
    }

    public static function COQLDATAREC($page = 1, $perPage = 40)
    {
        $response = ZohoCrmApi::getInstance()
            ->setModule('Contacts')
            ->records()
            ->queryCOQL()
            ->columns(['Full_Name', 'Created_Time'])
            ->whereSearchMap([
                ['Full_Name', '!=', 'test']
            ])
            ->page($page)
            ->perPage($perPage)
            ->request();

        // Проверяем, что $response является массивом и содержит данные
        if (is_array($response) && !empty($response)) {
            // Выводим данные из массива
            foreach ($response as $contact) {
                echo "Full Name: {$contact['Full_Name']}, Created Time: {$contact['Created_Time']}\n";
            }

            // Проверяем, есть ли еще страницы данных
            if (count($response) === $perPage) {
                // Рекурсивно вызываем функцию для следующей страницы
                self::COQLDATAREC($page + 1, $perPage);
            }
        } else {
            // Выводим ошибку или обрабатываем другим способом
            echo "Ошибка: пустой или неверный формат ответа от API";
            return;
        }
    }




    public static function COQLDATA()
    {
        $response = ZohoCrmApi::getInstance()
            ->setModule('Contacts')
            ->records()
            ->queryCOQL()
            ->columns(['Full_Name', 'Created_Time'])
            ->whereSearchMap([
                ['Full_Name', '!=', 'test']
            ])
            ->page(1)
            ->perPage(200)
            ->request();

        if (is_array($response)) {
            // Выводим данные из массива
            foreach ($response as $contact) {
                echo "Full Name: {$contact['Full_Name']}, Created Time: {$contact['Created_Time']}\n";
            }
        } else {
            // Выводим ошибку или обрабатываем другим способом
            echo "Ошибка: неверный формат ответа от API";
        }
    }

    public static function creatSubform($name, $birthday, $id)
    {
        $record = ZohoCrmApi::getInstance()
            ->setModule('Contacts')
            ->records()
            ->updateRecords([
                [
                    "id" => $id,
                    "Subform_1" => [
                        [
                            "Name1" => $name,
                            "Birthday" => $birthday
                        ]
                    ]
                ]
            ])
            ->request();
        dump($record);
    }

    public static function creatContact_with_Deals_and_Tasks($first_name, $last_name, $email, $deal_name, $closing_date, $stage, $task_subject, $due_date, $status, $priority): void
    {
        /**
            * Insert new record to Contacts module
            */
        $record = ZohoCrmApi::getInstance()
            ->setModule('Contacts')
            ->records()
            ->insertRecords([[
                'First_Name' => $first_name,
                'Last_Name' => $last_name,
                'Email' => $email],])
            ->request();
        $id = $record[0];
        echo 'id = ' , $id;
        dump($record);
        echo '-------------------------------';
        if($record[0]) {
            $record = ZohoCrmApi::getInstance()
                ->setModule('Deals')
                ->records()
                ->insertRecords([[
                    'Deal_Name' => $deal_name,
                    'Closing_Date' => $closing_date,
                    'Stage' => $stage,
                    'Contact_Name' => $id,
                ],])
                ->request();
            echo 'id = ' , $id;
            dump($record);
            echo '+++++++++++++++++++++++++++++\n';
        }else{
            echo "Error 1!";}

        echo $record[0];
        if($record[0]) {
            $record = ZohoCrmApi::getInstance()
                ->setModule('Tasks')
                ->records()
                ->insertRecords([[
                    'Subject' => $task_subject,
                    'Due_Date' => $due_date,
                    'Status' => $status,
                    'Priority' => $priority,
                    'Who_Id' => $id,
                ],])
                ->request();
            echo 'id = ' , $id;
            dump($record);
            echo '~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~\n';
        }else{
            echo "Error 2!";}
    }

    /**
     * @param $a
     * @param $b
     * @return mixed
     */
    public static function naGopeShert($a, $b): mixed
    {
        return $a + $b;
    }
}
