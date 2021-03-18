<?php

namespace App\Http\Controllers\Api\Country;

use App\Http\Controllers\Api\Controller;
use Illuminate\Http\Request;
use App\Models\CountryModel;
use Validator;

class CountryController extends Controller
{
    public function country()

    {
        try{
            $user = auth()->userOrFail();
        }
        catch (\Tymon\JWTAuth\Exceptions\UserNotDefinedException $e){

            return response()->json(['error'=>true, 'message'=>$e->getMessage()], 401);
        }

        return response()->json(CountryModel::get(), 200); //Получаем JSON ответ
    }
    public function countryById($id)
    {
        try{
            $user = auth()->userOrFail();
        }
        catch (\Tymon\JWTAuth\Exceptions\UserNotDefinedException $e){

            return response()->json(['error'=>true, 'message'=>$e->getMessage()], 401);
        }
        $country = CountryModel::find($id);
        if (is_null($country)) {
            return response()->json(['error' => true, 'message' => 'Not Found'], 404); // если обьект пустой то возвращаем ошибку
        }
        return response()->json($country, 200); // Принимаем Ид ичерез статический метод find делаем запрос к бд для поиска этого Ид, и результат возвращается в виде JSON  с успешным кодом ответа 200
    }
    /*
    * Принимем Request , создаем перменную country
    * в котрую пердем Request с кодом 201 создано
    */
    public function countrySave(Request $req)
    {  try{
            $user = auth()->userOrFail();
        }
        catch (\Tymon\JWTAuth\Exceptions\UserNotDefinedException $e){

            return response()->json(['error'=>true, 'message'=>$e->getMessage()], 401);
        }
        $rules = [
            'iso' => 'required|min:2|max:2',
            'name' => 'required|min:3',
            'name_en' => 'required|min:3'
        ];
        $validator = Validator::make($req->all(), $rules);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $country = CountryModel::create($req->all());
        return response()->json($country, 201);
    }

    public function countryEdit(Request $req, $id)
    {  try{
        $user = auth()->userOrFail();
    }
    catch (\Tymon\JWTAuth\Exceptions\UserNotDefinedException $e){

        return response()->json(['error'=>true, 'message'=>$e->getMessage()], 401);
    }
        $rules = [
            'iso' => 'required|min:2|max:2',
            'name' => 'required|min:3',
            'name_en' => 'required|min:3'
        ];
        $validator = Validator::make($req->all(), $rules);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $country = CountryModel::find($id);
        if (is_null($country)) {
            return response()->json(['error' => true, 'message' => 'Not Found'], 404); // если обьект пустой то возвращаем ошибку
        }
        $country->update($req->all());
        return response()->json($country, 200);
    }

    public function countryDelete(Request $req, $id)
    {  try{
        $user = auth()->userOrFail();
    }
    catch (\Tymon\JWTAuth\Exceptions\UserNotDefinedException $e){

        return response()->json(['error'=>true, 'message'=>$e->getMessage()], 401);
    }
        $country = CountryModel::find($id);
        if (is_null($country)) {
            return response()->json(['error' => true, 'message' => 'Not Found'], 404); // если обьект пустой то возвращаем ошибку
        }
        $country->delete();
        return response()->json('', 204);
    }
}
