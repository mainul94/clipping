<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/5/16
 * Time: 5:49 PM
 */?>
<div class="filters" data-options="">
	{{--Filters View--}}
	<ul class="set_filters list-inline">
		<li>
			<button class="btn btn-info btn-xs new-filter text-muted">Add Filter</button>
		</li>
	</ul>
	{{--Filters Form--}}
	<div class="form_filters">
		<div class="fieldname_select_area col-sm-4 form-group ui-front">
			<input class="form-control filter_field">
		</div>
		<div class="col-sm-2 form-group">
			<select class="condition form-control">
				<option value="=">Equals</option>
				<option value="!=">Not Equals</option>
				<option value="in">In</option>
				<option value="not in">Not In</option>
				<option value="like">Like</option>
				<option value="not like">Not Like</option>
				<option value=">">&gt;</option>
				<option value="<">&lt;</option>
				<option value=">=">&gt;=</option>
				<option value="<=">&lt;=</option>
			</select>
		</div>
		<div class="col-sm-6 col-xs-12">
			<div class="filter_value pull-left" style="width: calc(100% - 120px)">
				<div class="form-group frappe-control input-max-width">
					<input class="form-control">
				</div>
			</div>
			<div class="filter-actions pull-left">
				<a class="set-filter-and-run btn btn-primary pull-left"><i class="fa fa-check"></i></a>
				<a class="btn btn-danger remove-filter pull-left"><i class="fa fa-close"></i></a>
			</div> <div class="clearfix"></div>
		</div>
	</div>
</div>
@section('head')
	@parent
	<link rel="stylesheet" href="{{ asset('vendors/bootstrap-daterangepicker/daterangepicker.css') }}">
@endsection

@section('footer_script')
	@parent
	<script src="{{ asset('vendors/moment/moment.js') }}"></script>
	<script src="{{ asset('vendors/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
@endsection

@section('script_call')
	@prent
	<script>
		filedsOptions = {
			"status": {
				"label": "Status",
				"filed_name": "status",
				"filed_type": "Select",
				"field_options": [
					{'id': 'Wating for Review','text': 'Wating for Review'},
					{'id': 'Accepted','text': 'Accepted'},
					{'id': 'Processing', 'text': 'Processing'},
					{'id': 'Rejected', 'text': 'Rejected'},
					{'id': 'Completed', 'text': 'Completed'},
					{'id':'Finished', 'text': 'Finished'},
					{'id': 'Hold', 'text': 'Hold'}
				],
				"default": "Processing"
			},
			"title": {
				"label": "Title",
				"filed_name": "title",
				"filed_type": "Data",
				"field_options": null
			},
			"delivery_date": {
				"label": "Delivery Date",
				"filed_name": "delivery_date",
				"filed_type": "Date",
				"field_options": null
			}
		};
		$filtesWrapper = $('.filters');
		$setFiltersWrapper = $filtesWrapper.children('.set_filters');
		$formFiltersWrapper = $filtesWrapper.children('.form_filters');
		$formFiltersWrapper.hide();
		$addFilterBtn = $setFiltersWrapper.find('.new-filter');

		$addFilterBtn.on('click', function (e) {
			filterForm('New')
		});

		function filterForm(type, list_index) {
			$formFiltersWrapper.show();
			if (list_index) {
				$formFiltersWrapper.attr('data-list-index', list_index);
			}else  {
				$formFiltersWrapper.removeAttr('data-list-index')
			}
			///////////
			if (!$formFiltersWrapper.find('input.filter_field').data('select2')) {
				var field_names = [];
				$.each(filedsOptions, function (key,val) {
					field_names.push({'id':key, 'text': val['label']})
				});
				$formFiltersWrapper.find('input.filter_field').select2({
					data:field_names
				}).on('change', function () {
					setUpFilterValueField($(this).val())
				});
			}
			/////////////
			$formFiltersWrapper.find('select.condition').select2().on('change', function () {
				setUpFilterValueField($formFiltersWrapper.find('input.filter_field').val())
			});
		}
		/////////////Set Filter and Run
		$formFiltersWrapper.find('.set-filter-and-run').on('click', function () {
			setFilter();
			runFilterRequest();
		});
		/////////////Remove Filter
		$formFiltersWrapper.find('.remove-filter').on('click', function () {
			$formFiltersWrapper.hide();
		});
		
		/////////////////
		function setUpFilterValueField(value) {
			var field = filedsOptions[value];
			var $field = $formFiltersWrapper.find('.filter_value input');
			$field.val(null);
			if (field.filed_type == "Date") {
				if ($field.data('select2')) {
					$field.select2('destroy');
				}
				var prev_val = $field.val() || moment();
				$field.daterangepicker({
					singleDatePicker: true,
					timePicker: true,
					calender_style: "picker_2",
					timePicker24Hour:true,
					startDate:prev_val,
					endDate:prev_val,
					locale:{
						format:'YYYY-MM-DD hh:mm:ss'
					}
				});
			}else if (field.filed_type == "Select") {
				if (['=','!='].indexOf($formFiltersWrapper.find('select.condition').val()) !== -1) {
					$field.select2({data:field.field_options});
				}else {
					if ($field.data('select2')) {
						$field.select2('destroy');
					}
				}
			}else if (field.filed_type == "Data") {
				if ($field.data('select2')) {
					$field.select2('destroy');
				}
				$field.unbind();
			}
		}
		
		
//		Set Filter and Run
		function setFilter(values) {
			var attr = $formFiltersWrapper.attr('data-list-index');
			if (typeof attr !== typeof undefined && attr !== false) {
				var $setfilterItem = $setFiltersWrapper.find('li').eq(attr);
			}else {
				var $setfilterItem = $('<li>');
			}
			$setfilterItem.addClass('btn-group');
			if (typeof values === "undefined") {
				$setfilterItem.attr({
					"data-field-name": $formFiltersWrapper.find('input.filter_field').val(),
					"data-field-condition": $formFiltersWrapper.find('select.condition').val(),
					"data-field-value": "'"+$formFiltersWrapper.find('.filter_value input').val()+"'"
				});
			}else {
				$setfilterItem.attr({
					"data-field-name": values.fieldname,
					"data-field-condition": values.oparetion || '=',
					"data-field-value": values.value
				});
			}

			var showValue = filedsOptions[$setfilterItem.attr('data-field-name')].label + $setfilterItem.attr('data-field-condition')+
					$setfilterItem.attr('data-field-value');
			if (attr) {
				$setfilterItem.find('.edit-filter').html(showValue)
			}else {
				$setFiltersWrapper.append($setfilterItem);

				var $edit = $('<button class="btn btn-default btn-xs edit-filter">'+showValue+'</button>').appendTo($setfilterItem);

				$edit.on('click', function () {
					filterForm('Edit', $setfilterItem.index());
				});

				var $remove = $('<button class="btn btn-default btn-xs"><i class="fa fa-close"></i></button>').appendTo($setfilterItem);

				$remove.on('click', function () {
					$setfilterItem.remove();
					runFilterRequest();
				});
			}
		}


		function runFilterRequest() {
			if ($formFiltersWrapper.is(":visible")) {
				$formFiltersWrapper.hide()
			}
		}
	</script>
@endsection
