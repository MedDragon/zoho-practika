<?php

/**
 * DataDeals Model
 *
 * This model represents a deal in the application. It interacts with the
 * `data_deals` table and provides methods for handling deals data, including
 * saving to and deleting from the database.
 */

namespace App\Models;

use App\Manager\ZohoDataManager;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class DataDeals
 *
 * @package App\Models
 */
class DataDeals extends Model
{
    use HasFactory;

    /**
     * The name of the table associated with the model.
     *
     * @var string
     */
    protected $table = 'data_deals';

    /**
     * The primary key of the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'zoho_deal_id',
        'Account_Name',
        'Deal_Name',
        'Stage',
        'Closing_Date',
        'Amount',
        'Contact_Name',
    ];

    /**
     * Save or update the deal data in the database.
     *
     * @param array $data
     * @return Model|Builder
     */
    public function pushToDB($data): Model|Builder
    {
        dump($data['id']);
        dump(ZohoDataManager::DealsformatDataForDB($data));
        return self::query()->updateOrCreate(
            ['zoho_deal_id' => $data['id']],
            ZohoDataManager::DealsformatDataForDB($data)
        );
    }//end pushToDB()

    /**
     * Delete a deal from the database.
     *
     * @param string|null $id
     * @return integer
     */
    public static function deleteFromDB($id = null)
    {
        return self::query()
            ->where('zoho_deal_id', '=', $id)
            ->delete();
    }//end deleteFromDB()
}//end class
