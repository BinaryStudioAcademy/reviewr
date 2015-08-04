<?php

namespace App\Repositories;

abstract class CRUDRepository implements RepositoryIntarface
{
	public function create();

	public function update($id);

	public function find($id);
	
	public function delete($id); 
}