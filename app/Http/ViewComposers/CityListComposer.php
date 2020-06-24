<?php
namespace App\Http\ViewComposers;

use Illuminate\View\View; 

class CityListComposer
{   
  private $city_list = [];

  public function __construct(){
    $this->city_list = json_decode(file_get_contents("https://thongtindoanhnghiep.co/api/city"))->LtsItem;
    array_pop($this->city_list);
  }


  public function compose(View $view)
  {
    $view->with('city_list', $this->city_list);
  }
}
