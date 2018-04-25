<?php

class TodoController extends \BaseController {


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function index()
	{
		return Todo::all();
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		return Todo::create(Request::all());
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$todo = Todo::find($id);

		$todo->title = Input::get('title');
		$todo->isCompleted = Input::get('isCompleted');

		$todo->save();
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function updateAll()
	{
		Todo::query()->update(array('isCompleted' => Input::get('isCompleted') == 'true' ? 1 : 0));
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Todo::destroy($id);
	}


}
