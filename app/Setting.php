<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable =['key','value'];

    /**
     * Return All task status
     * @return array
     */
    public function taskStatusList()
    {
        return ['Wating for Review'=>'Wating for Review','Accepted'=>'Accepted','Processing'=>'Processing',
            'Rejected'=>'Rejected','Completed'=>'Completed','Finished'=>'Finished','Hold'=>'Hold'];
    }


    /**
     * Return User Type
     * @return array
     */
    public function userTypeList()
    {
        return ['Admin'=>'Admin','Client'=>'Client','Support'=>'Support'];
    }


    /**
     * Return Task Type
     * @return array
     */
    public function typesOfTasksList()
    {
        return ['Order'=>'Order','Quatetion'=>'Quatetion','Trail'=>'Trail'];
    }


    /**
     * Return Task Type
     * @return array
     */
    public function taskTypeList()
    {
        return ['New'=>'New', 'Rejected'=>'Rejected'];
    }
}
