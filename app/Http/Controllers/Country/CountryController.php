<?php

namespace App\Http\Controllers\Country;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CountryModel;

class CountryController extends Controller
{
    public function country(){
        return response()->json(CountryModel::get(), 200); //Получаем JSON ответ
    }
    public function countryById($id){
        return response()->json(CountryModel::find($id), 200); // Принимаем Ид ичерез статический метод find делаем запрос к бд для поиска этого Ид, и результат возвращается в виде JSON  с успешным кодом ответа 200
    }
}
