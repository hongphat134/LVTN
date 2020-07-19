<?php
namespace App\Http\ViewComposers;

use Illuminate\View\View; 

class BasicComposer
{   
 	private $skill_list = [];
	private $exp_list = [];
	private $job_list = [];
	private $degree_list = [];
	private $rank_list = [];
	private $language_list = [];
	private $itech_list = [];
	private $salary_list = [];

	public function __construct(){    
		if(file_exists( public_path()."/resources/skills.json")){
			$this->skill_list = json_decode(file_get_contents(url("resources/skills.json")));
		}		
		if(file_exists( public_path()."/resources/exps.json")){
			$this->exp_list = json_decode(file_get_contents(url("resources/exps.json")));
		}
		if(file_exists( public_path()."/resources/jobs.json")){
			$this->job_list = json_decode(file_get_contents(url("resources/jobs.json")));
		}
		if(file_exists( public_path()."/resources/degrees.json")){
			$this->degree_list = json_decode(file_get_contents(url("resources/degrees.json")));
		}
		if(file_exists( public_path()."/resources/ranks.json")){
			$this->rank_list = json_decode(file_get_contents(url("resources/ranks.json")));
		}
		if(file_exists( public_path()."/resources/languages.json")){
			$this->language_list = json_decode(file_get_contents(url("resources/languages.json")));
		}
		if(file_exists( public_path()."/resources/itechs.json")){
			$this->itech_list = json_decode(file_get_contents(url("resources/itechs.json")));
		}
		if(file_exists( public_path()."/resources/salarys.json")){
			$this->salary_list = json_decode(file_get_contents(url("resources/salarys.json")));
		}
	}

	public function compose(View $view)
	{		
		$view->with('skill_list',$this->skill_list);
		$view->with('job_list',$this->job_list);
		$view->with('exp_list',$this->exp_list);
		$view->with('degree_list',$this->degree_list);
		$view->with('rank_list',$this->rank_list);
		$view->with('language_list',$this->language_list);
		$view->with('itech_list',$this->itech_list);
		$view->with('salary_list',$this->salary_list);
	}
}
