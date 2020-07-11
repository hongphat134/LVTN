<?php
namespace App\Http\ViewComposers;

use Illuminate\View\View; 

class BasicComposer
{   
 	private $skill_list = [];
	private $exp_list = [];
	private $ds_job = [];
	private $ds_bc = [];
	private $ds_cb = [];
	private $ds_nn = [];
	private $ds_th = [];

	public function __construct(){    
		if(file_exists( public_path()."/resources/skills.json")){
			$this->skill_list = json_decode(file_get_contents(url("resources/skills.json")));
		}		
		if(file_exists( public_path()."/resources/exps.json")){
			$this->exp_list = json_decode(file_get_contents(url("resources/exps.json")));
		}
		if(file_exists( public_path()."/resources/jobs.json")){
			$this->ds_job = json_decode(file_get_contents(url("resources/jobs.json")));
		}
		if(file_exists( public_path()."/resources/degrees.json")){
			$this->ds_bc = json_decode(file_get_contents(url("resources/degrees.json")));
		}
		if(file_exists( public_path()."/resources/ranks.json")){
			$this->ds_cb = json_decode(file_get_contents(url("resources/ranks.json")));
		}
		if(file_exists( public_path()."/resources/languages.json")){
			$this->ds_nn = json_decode(file_get_contents(url("resources/languages.json")));
		}
		if(file_exists( public_path()."/resources/itechs.json")){
			$this->ds_th = json_decode(file_get_contents(url("resources/itechs.json")));
		}
	}

	public function compose(View $view)
	{		
		$view->with('skill_list',$this->skill_list);
		$view->with('ds_job',$this->ds_job);
		$view->with('exp_list',$this->exp_list);
		$view->with('ds_bc',$this->ds_bc);
		$view->with('ds_cb',$this->ds_cb);
		$view->with('ds_nn',$this->ds_nn);
		$view->with('ds_th',$this->ds_th);
	}
}
