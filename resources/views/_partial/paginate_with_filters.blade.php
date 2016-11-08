<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/9/16
 * Time: 12:09 AM
 */?>
@php
	$url = str_replace('page='.$rows->currentPage(),'',request()->fullUrl());
	$find   = '?';
	$pos = strpos($url, $find);
	$url = $pos!==false?$url:$url.'?';
	$url = str_replace('&&','&',$url.'&page=');
	$totals = ceil($rows->total()/$rows->perPage());
	$start = $rows->currentPage()-4 >=1? $rows->currentPage()-4:1;
	$last = $rows->currentPage()+4 <=$rows->lastPage()? $rows->currentPage()+4:$rows->lastPage();
	$totals = $totals >= $last+4 ? $last+4:$totals;
@endphp
<ul class="pagination">
	@if($rows->currentPage() <=1)
		<li class="disabled"><span rel="prev">«</span></li>
	@else
		<li><a href="{{ $url.($rows->currentPage()-1) }}" rel="prev">«</a></li>
	@endif

	@for($page = $start; $page <= $totals; $page++)
		@if($rows->currentPage() === $page)
			<li class="active"><span>{{ $rows->currentPage() }}</span></li>
		@else
			<li><a href="{{ $url.$page }}">{{ $page }}</a></li>
		@endif
	@endfor
	@if($rows->currentPage() < $rows->lastPage())
		<li><a href="{{ $url.($rows->currentPage()+1) }}" rel="next">»</a></li>
	@else
		<li class="disabled"><span rel="next">»</span></li>
	@endif
</ul>
<div class="clearfix"></div>
