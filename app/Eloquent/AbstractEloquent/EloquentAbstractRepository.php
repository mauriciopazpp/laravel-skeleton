<?php namespace App\Eloquent\AbstractEloquent;

class EloquentAbstractRepository
{
	
	public function find($id)
	{
	    $model = $this->model->withTrashed()->find($id);
	    if($model and $model->trashed())
	        return false;
	    return $model;
	}
	
	public function get()
	{
		return $this->model->get();
	}
	
	public function all()
	{
		return $this->model->orderBy('id', 'desc')->paginate(50);
	}
	
	public function toDropdown()
	{
		return $this->model->orderBy('id', 'desc')->get();
	}
	
	public function create($request)
	{
		if(!$request)
			return null;
		
		return $this->model->create($request);
	}

	public function update($model, $request)
	{
		return $model->update($request);
	}

	public function destroy($request)
	{
		return $this->model->destroy($request);
	}

	public function restore($id)
	{
		return $this->model->where('id', $id)->restore();
	}

	public function trash()
	{
		return $this->model->onlyTrashed()->paginate(50);
	}
}