<?php

/**
 * Тестова команда для роботи з API Zoho CRM.
 *
 * Цей клас виконує кілька операцій з даними в CRM-системі, включаючи створення контактів, додавання вкладень і пошук за датами.
 *
 * @package App\Console\Commands
 */

namespace App\Console\Commands;

use Illuminate\Console\Command;
use ZohoCrmSDK\Api\ZohoCrmApi;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class ArtemTest extends Command
{
    /**
     * Назва та підпис команди консолі.
     *
     * @var string
     */
    protected $signature = 'app:artem-test';

    /**
     * Опис команди.
     *
     * @var string
     */
    protected $description = 'Тестова команда для виконання операцій з API Zoho CRM.';

    /**
     * Виконання команди консолі.
     *
     * Цей метод виконує серію тестових операцій в API.
     *
     * @return void
     */
    public function handle(): void
    {
        $c = $this::naGopeShert(1, 2);
        dump($c);

        $this::createContactWithDealsAndTasks(
            'Nastya',
            'Sky',
            'nastyaSky@gmail.com',
            'Nastya2',
            '2021-12-31',
            'Qualification',
            'Nastya2',
            '2021-12-31',
            'Not Started',
            'High'
        );

        $this::creatSubform('Zoho', '2020-12-31', '6317174000001468002');
        $this::COQLDATA();
        $this::COQLDATAREC();
        $this::searchContactsByCreatedDate(Carbon::now()->subWeeks(2)->toAtomString(), Carbon::now()->toAtomString());
        $this::addAttachment('6317174000001468002');
        $this::downloadAttachment('631717400000146800');
        echo "hi " . date('Y-m-d H:i:s') . "\n";
        $this->line('Current time: ' . Carbon::now());
        $this::getContacts();
    }//end handle()

    /**
     * Отримання контактів з Zoho CRM.
     *
     * @param integer $page    Номер сторінки.
     * @param integer $perPage Кількість записів на сторінці.
     * @return void
     */
    public static function getContacts($page = 1, $perPage = 40): void
    {
        $deals = ZohoCrmApi::getInstance()
            ->setModule('Deals')
            ->records()
            ->getRecords()
            ->request();

        dump($deals);
    }//end getContacts()

    /**
     * Завантаження вкладення для контакту.
     *
     * @param string $zohoId Ідентифікатор контакту.
     * @return void
     */
    public static function downloadAttachment($zohoId): void
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
    }//end downloadAttachment()

    /**
     * Додавання вкладення для контакту.
     *
     * @param string $zohoId Ідентифікатор контакту.
     * @return void
     */
    public static function addAttachment($zohoId): void
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
    }//end addAttachment()

    /**
     * Пошук контактів за датою створення.
     *
     * @param string $dateTime1 Дата початку пошуку.
     * @param string $dateTime2 Дата кінця пошуку.
     * @return void
     */
    public static function searchContactsByCreatedDate($dateTime1, $dateTime2): void
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

        if (is_array($response) && !empty($response)) {
            foreach ($response as $contact) {
                echo "Full Name: {$contact['Full_Name']}, Created Time: {$contact['Created_Time']}\n";
            }
        } else {
            echo "Ошибка: неверный формат ответа от API";
        }
    }//end searchContactsByCreatedDate()

    /**
     * Виконання COQL запиту для отримання контактів.
     *
     * @return void
     */
    public static function COQLDATAREC($page = 1, $perPage = 40): void
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

        if (is_array($response) && !empty($response)) {
            foreach ($response as $contact) {
                echo "Full Name: {$contact['Full_Name']}, Created Time: {$contact['Created_Time']}\n";
            }

            if (count($response) === $perPage) {
                self::COQLDATAREC($page + 1, $perPage);
            }
        } else {
            echo "Ошибка: пустой или неверный формат ответа от API";
        }
    }//end COQLDATAREC()

    /**
     * Виконання COQL запиту для отримання контактів.
     *
     * @return void
     */
    public static function COQLDATA(): void
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
            foreach ($response as $contact) {
                echo "Full Name: {$contact['Full_Name']}, Created Time: {$contact['Created_Time']}\n";
            }
        } else {
            echo "Ошибка: неверный формат ответа от API";
        }
    }//end COQLDATA()

    /**
     * Створення субформи для контакту.
     *
     * @param string $name     Ім'я.
     * @param string $birthday Дата народження.
     * @param string $id       Ідентифікатор контакту.
     * @return void
     */
    public static function creatSubform($name, $birthday, $id): void
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
    }//end creatSubform()

    /**
     * Створення контакту з угодами та завданнями.
     *
     * @param string $first_name   Ім'я.
     * @param string $last_name    Прізвище.
     * @param string $email        Адреса електронної пошти.
     * @param string $deal_name    Назва угоди.
     * @param string $closing_date Дата закриття угоди.
     * @param string $stage        Стадія угоди.
     * @param string $task_subject Тема завдання.
     * @param string $due_date     Дата виконання завдання.
     * @param string $status       Статус завдання.
     * @param string $priority     Пріоритет завдання.
     * @return void
     */
    public static function createContactWithDealsAndTasks($first_name, $last_name, $email, $deal_name, $closing_date, $stage, $task_subject, $due_date, $status, $priority): void
    {
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
        if ($record[0]) {
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
        } else {
            echo "Error 1!";
        }

        echo $record[0];
        if ($record[0]) {
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
        } else {
            echo "Error 2!";
        }
    }//end createContactWithDealsAndTasks()
}//end class
