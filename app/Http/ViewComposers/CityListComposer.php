<?php
namespace App\Http\ViewComposers;

use Illuminate\View\View; 
use Illuminate\Support\Arr;

class CityListComposer
{   
  private $region_list = [];

  public function __construct(){
    // $this->city_list = json_decode(file_get_contents("https://thongtindoanhnghiep.co/api/city"));
    // array_pop($this->city_list);
    if(file_exists( public_path()."/resources/cities.json")){
      $this->region_list = json_decode(file_get_contents(url("resources/cities.json")));
      // Sort theo miền nhỏ
      $this->region_list->MienNam = array_values(Arr::sort($this->region_list->MienNam, function ($value) {
          return $value->MaMien;
      }));
      $this->region_list->MienBac = array_values(Arr::sort($this->region_list->MienBac, function ($value) {
          return $value->MaMien;
      }));
      $this->region_list->MienTrung = array_values(Arr::sort($this->region_list->MienTrung, function ($value) {
          return $value->MaMien;
      }));
    }     
      
    else{
      $json = '[
      {"Title": "Tiền Giang"},
      {"Title": "Hà Nội"},
      {"Title": "TP Hồ Chí Minh"},
      {"Title": "Đà Nẵng"},
      {"Title": "Khác"}
    ]';
      $this->region_list = json_decode($json);
    }
  }


  public function compose(View $view)
  {
    $view->with('region_list', $this->region_list);
  }
}
