<?php

namespace App\Repositories;

use App\Models\Treasury;
use App\Repositories\BaseRepository;

/**
 * Class TreasuryRepository
 * @package App\Repositories
 * @version July 30, 2019, 11:10 am UTC
*/

class TreasuryRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'amount',
        'well_wisher',
        'received_on'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Treasury::class;
    }
}
