<?php

namespace App\Models;

use App\Manager\ZohoDataManager;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataDeals extends Model
{
    use HasFactory;

    protected $table = 'data_deals';
    protected $primaryKey = 'id';

    protected $fillable = [
        'zoho_deal_id',
        'Account_Name',
        'Deal_Name',
        'Stage',
        'Closing_Date',
        'Amount',
        'Contact_Name',
    ];

    public function pushToDB($data): Model|Builder
    {
        dump($data['id']);
        dump(ZohoDataManager::DealsformatDataForDB($data));
        return self::query()->updateOrCreate(
            ['zoho_deal_id' => $data['id']],
            ZohoDataManager::DealsformatDataForDB($data)
        );
    }

    public static function deleteFromDB($id = null)
    {
        return self::query()
            ->where('zoho_deal_id', '=', $id)
            ->delete();
    }
}
