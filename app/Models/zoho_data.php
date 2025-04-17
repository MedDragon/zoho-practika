<?php

namespace App\Models;

use App\Manager\ZohoDataManager;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class zoho_data extends Model
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
        return zoho_data::query()->updateOrCreate(
            ['zohoID' => $data['id']],
            ZohoDataManager::formatDataForDB($data)
        );
    }

    public static function deleteFromDB($id = null)
    {
        return zoho_data::query()
            ->where('zohoID', '=', $id)
            ->delete();
    }
}
