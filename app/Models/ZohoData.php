<?php

namespace App\Models;

use App\Manager\ZohoDataManager;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZohoData extends Model
{
    use HasFactory;

    protected $table = 'zoho_data';
    protected $primaryKey = 'zohoID';

    protected $fillable = [
        'id',
        'zohoID',
        'First_Name',
        'Last_Name',
        'Email',
        'Mobile',
        'Account_Name',
    ];

    public function pushToDB($data): Model|Builder
    {
        dump($data['id']);
        dump(ZohoDataManager::formatDataForDB($data));
        return zohoData::query()->updateOrCreate(
            ['zohoID' => $data['id']],
            ZohoDataManager::formatDataForDB($data)
        );
    }

    public static function deleteFromDB($id = null)
    {
        return zohoData::query()
            ->where('zohoID', '=', $id)
            ->delete();
    }
}
