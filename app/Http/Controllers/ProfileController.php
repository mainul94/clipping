<?php

namespace App\Http\Controllers;

use App\Profile;
use Illuminate\Http\Request;


class ProfileController extends Controller
{
	/**
	 * View your Profile
	 * @return $this
	 */
	public function show()
	{
		if (empty(auth()->user()->profile)) {
			$profile = Profile::create(['user_id'=>auth()->user()->id]);
		}else {
			$profile = auth()->user()->profile;
		}
		return view('admin.profile.show')->with(['id'=>$profile]);
	}


	/**
	 * Edit your profile
	 * @return $this
	 */
	public function edit()
	{
		if (empty(auth()->user()->profile)) {
			$profile = Profile::create(['user_id'=>auth()->user()->id]);
		}else {
			$profile = auth()->user()->profile;
		}
		return view('admin.profile.edit')->with(['id'=>$profile]);
	}


	/**
	 * Update your Profile information
	 * @param Request $request
	 * @param Profile $profile
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function update(Request $request, Profile $profile)
	{
		$this->validate($request, [
			'phone'=>'Numeric'
		]);
		$profile->fill($request->all())
			->save();
		return redirect()->back()->with('message', ['type' => 'success', 'msg' => 'Successfully Updated']);
		
	}
}
