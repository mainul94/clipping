<?php

namespace App\Http\Controllers;

use App\Http\Database;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
	use Database;
	/**
	 * @var array
	 * 'client'=>[
	 *  'title' => '',
	 *  'tables'=>'users', // string or Array EX:'users' or ['users','profiles']
	 *  'fields' => [
	 *      'label' => 'Client',
	 *      'name' => 'name',
	 *      'width' =>''
	 *  ],
	 *  'filters'=>[    // array or null
	 *      ['type','=','Client']
	 *  ]
	 * ]
	 *
	 */
	protected $reports  = [
		'client'=>[
			'title' => 'Client Report',
			'tables'=>'users',
			'fields' => [
				[
					'label' => 'Client',
					'name' => 'name',
					'width' =>''
				],
				[
					'label' => 'Email',
					'name' => 'email',
					'width' =>''
				]
			],
			'filters'=>[
				['type','=','Client']
			],
			'view' => 'admin.report.stander'
		]
	];
	protected $table;
	protected $fields;
	protected $filters;
	protected $db;
	protected $view;

	public function __invoke(Request $request, $report)
	{
		if (!array_key_exists($report, $this->reports)) {
			return view('admin.report.404', compact('report'));
		}
		$this->table = $this->reports[$report]['tables'];
		$this->fields = array_column($this->reports[$report]['fields'], 'name');
		$this->filters = $this->reports[$report]['filters'];


		if (gettype($this->table) === 'string') {
			$this->db = DB::table($this->table);
		}


		if (count($this->fields)) {
			$this->db->select($this->fields);
		}

		if (count($this->filters)) {
			$this->db->where($this->filters);
		}

		if ($request->get('filters')) {
			$filters = $this->filteQuery($request->get('filters'));
			if ($filters) {
				$this->db->where($filters);
			}
		}

		if ($request->get('view')) {
			$this->view = $request->get('view');
		}
		else if (array_key_exists('view', $this->reports[$report]) && !empty($this->reports[$report]['view']))
		{
			$this->view = $this->reports[$report]['view'];
		}
		else
		{
			$this->view = 'admin.report.stander';
		}

		$rows = $this->db->paginate();

		if ($request->ajax()) {
			return response()->json([
				'meta' => $this->reports[$report],
				'rows' => $rows
			]);
		}

		return view($this->view)->with(['meta' => $this->reports[$report], 'rows' => $rows]);
	}
}
