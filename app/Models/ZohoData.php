<?php

/**
 * ZohoData Model
 *
 * This model represents the Zoho data stored in the 'zoho_data' table.
 * It includes methods for pushing and deleting data in the database.
 */

namespace App\Models;

use App\Manager\ZohoDataManager;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ZohoData
 *
 * @package App\Models
 */
class ZohoData extends Model
{
    use HasFactory;

    /**
     * The name of the table associated with the model.
     *
     * @var string
     */
    protected $table = 'zoho_data';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'zohoID';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'zohoID',
        'First_Name',
        'Last_Name',
        'Email',
        'Mobile',
        'Account_Name',
    ];

    /**
     * Pushes data to the database by updating or creating a new record.
     *
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Builder
     */
    public function pushToDB($data): Model|Builder
    {
        dump($data['id']);
        dump(ZohoDataManager::formatDataForDB($data));
        return ZohoData::query()->updateOrCreate(
            ['zohoID' => $data['id']],
            ZohoDataManager::formatDataForDB($data)
        );
    }//end pushToDB()

    /**
     * Deletes data from the database by its Zoho ID.
     *
     * @param string|null $id
     * @return integer
     */
    public static function deleteFromDB($id = null)
    {
        return ZohoData::query()
            ->where('zohoID', '=', $id)
            ->delete();
    }//end deleteFromDB()
}//end class
