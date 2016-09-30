<?php
/**
 * Created by PhpStorm.
 * User: mainul
 * Date: 9/30/16
 * Time: 11:55 PM
 */

namespace App\Http;


trait Database
{

	public function filteQuery($filters)
	{
		if (gettype($filters) !== "string") {
			return null;
		}
		$filters = json_decode($filters);
		$conditions = [];
		foreach ($filters as $filter) {
			array_push($conditions, [$filter->fieldname, (isset($filter->oparetion)?$filter->oparetion:'='),$filter->value]);
		}
		return $conditions;
	}
	
}