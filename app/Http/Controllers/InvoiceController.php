<?php

namespace App\Http\Controllers;

use App\Exceptions\NoTask;
use App\Invoice;
use App\InvoiceChild;
use App\Task;
use Illuminate\Http\Request;

use App\Http\Requests;
use Intervention\Image\Exception\NotFoundException;
use PhpParser\Error;

class InvoiceController extends Controller
{

	use CommonController;

	/**
	 * RoleController constructor.
	 */
	public function __construct(Request $request)
	{
		$this->view_dir = 'admin.invoice.';
		$this->model = new Invoice();
		$this->permissionCheckSetup($request);
	}


	protected $tasks;

	public function beforeSave(Invoice $model, Request $request)
	{
		$this->validate($request, [
			'from_date' => 'required',
			'to_date' => 'required',
			'client_id' => 'required'
		]);

		$this->tasks = Task::where([
			['created_at', '>=', $request->get('from_date')],
			['created_at', '<=', $request->get('to_date')]
		])->get();
		if ($this->tasks->count() <=0 ) {
			throw new NoTask('No task in this date Range');
		}
		
	}


	public function afterSave(Invoice $model, Request $request)
	{
		$child_val = ['invoice_id' => $model->id, 'uom' => 'PCS'];
		foreach ($this->tasks as $task) {
			$child = new InvoiceChild();
			$child_val['task_id'] = $task->id;
			$child_val['qty'] = $task->total_qty;
			$child_val['amount'] = $task->total_amount;
			$child->fill($child_val)->save();
			$model->total_qty += $task->total_qty;
			$model->subtotal += $task->total_amount;
		}
		$model->totals = $model->subtotal + $model->tax;
		$model->save();
	}


	public function afterUpdate(Invoice $invoice, Request $request)
	{
		$preChild = collect($invoice->children()->get(['id'])->toArray())->flatten();
		$invoice->total_qty =0;
		$invoice->subtotal =0;
		$children_id = [];
		$child_val = ['invoice_id' => $invoice->id];
		foreach ($request->get('task_id') as $key=>$task) {
			if (empty($request->get('ch_id')[$key])) {
				$child = new InvoiceChild();
			}
			else
			{
				$child = InvoiceChild::find($request->get('ch_id')[$key]);
			}
			$child_val['task_id'] = $task;
			$child_val['qty'] = $request->get('qty')[$key];
			$child_val['amount'] = $request->get('amount')[$key];
			$child_val['amount'] = $request->get('amount')[$key];
			$child_val['uom'] = $request->get('uom')[$key];
			$child->fill($child_val)->save();
			array_push($children_id, $child->id);
			$invoice->total_qty += $child->qty;
			$invoice->subtotal += $child->amount;
		}
		foreach ($preChild->diff($children_id) as $item) {
			$row = InvoiceChild::find($item);
			$row->delete();
		}
		$invoice->totals = $invoice->subtotal + $invoice->tax;
		$invoice->save();
	}


	public function redirectAfterCreate()
	{
		return redirect()->back()->with(['message'=> ['type' => 'success', 'msg' => 'Successfully Invoiceed']]);
	}


	public function validate_rules(Invoice $data = null)
	{
		return [
			'client_id'=>'required'
		];

	}

}
