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
    /*
    * Принимем Request , создаем перменную country
    * в котрую пердем Request с кодом 201 создано
    */
    public function countrySave(Request $req){
        $country = CountryModel::create($req->all());
        return response()->json($country, 201);
    }

    public function countryEdit(Request $req, CountryModel $country){
        $country ->update($req->all());
        return response()->json($country, 200);
    }

    public function countryDelete(Request $req, CountryModel $country){
        $country ->delete();
        return response()->json('', 204);
    }

}
