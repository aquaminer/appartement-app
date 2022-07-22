<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetApartmentsRequest;
use App\Models\Apartment;
use Illuminate\Support\Arr;

class ApartmentController extends Controller
{
    public function get(GetApartmentsRequest $request)
    {
        $scopes = [];

        foreach ($request->validated() as $scope => $params) {
            $scopes[$scope] = Arr::wrap($params);
        }

        return Apartment::query()->scopes($scopes)->get()->toArray();
    }
}
