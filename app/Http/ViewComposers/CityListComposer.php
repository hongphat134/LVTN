<?php
namespace App\Http\ViewComposers;

use Illuminate\View\View; 

class CityListComposer
{   
  private $city_list = [];

  public function __construct(){
    // $this->city_list = json_decode(file_get_contents("https://thongtindoanhnghiep.co/api/city"))->LtsItem;
    // array_pop($this->city_list);
    if(file_exists( public_path()."/resources/cities.json"))
      $this->city_list = json_decode(file_get_contents(url("resources/cities.json")))->LtsItem;
    else{
      $json = '[
      {"Title": "Tiền Giang"},
      {"Title": "Hà Nội"},
      {"Title": "TP Hồ Chí Minh"},
      {"Title": "Đà Nẵng"},
      {"Title": "Khác"}
    ]';
      $this->city_list = json_decode($json);
    }
  }


  public function compose(View $view)
  {
    $view->with('city_list', $this->city_list);
  }
}
