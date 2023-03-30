<?php

namespace App\Repositories;

use App\Interfaces\CrudInterface;
use App\Models\Review;
use App\Models\Shipment;
use App\Models\user;
use Illuminate\Support\Facades\Auth;

class ReviewRepo implements CrudInterface
{
    public function getAll()
    {
        return Review::all();
    }

    public function find($id)
    {
        return Review::find($id);
    }

    public function delete($id)
    {
        Review::find($id)->delete();
    }

    public function create($data)
    {
        return Review::create($data);
    }

    public function update($data, $id)
    {
        $review = Review::where('id', $id)->first();
        $review->text = $data['text'];
        $review->stars = $data['stars'];
        $review->account_id = $data['accountId'];
        $review->shipment_id = $data['shipmentId'];
        $review->save();

        return $review;
    }

    public function insertReview($request)
    {
        $data['text'] = $request->text;
        $data['stars'] = $request->stars;
        $data['shipment_id'] = $request->id;
        $data['account_id'] = $request->accountId;

        $review = $this->create($data);
        $review->save();

        return Shipment::select('reviews.stars', 'shipments.id')
            ->join('reviews', 'reviews.shipment_id', '=', 'shipments.id')
            ->where('shipments.id', $request->id)->first();
    }

    public function getAllOrderBy($column, $ascOrDesc) {
        return Review::select('reviews.*')
            ->where('account_id', Auth::user()->id)
            ->orderBy($column, $ascOrDesc)
            ->paginate(8);
    }

    public function getAllOrderByWithFilter($column, $ascOrDesc, $stars) {
        return Review::select('reviews.*')
            ->where('account_id', Auth::user()->id)
            ->where('stars', $stars)
            ->orderBy($column, $ascOrDesc)
            ->paginate(8);
    }

    public function hasFilterSearchAndSort($request, $temp) {
        return Review::search($request->search)
            ->where('account_id', Auth::user()->id)
            ->where('stars', $request->filter)
            ->orderBy($temp[0], $temp[1])
            ->paginate(8);
    }

    public function hasFilterAndSearch($request) {
        return Review::search($request->search)
            ->where('account_id', Auth::user()->id)
            ->where('stars', $request->filter)
            ->paginate(8);
    }

    public  function hasFilter($request) {
        return Review::where('account_id', '=', Auth::user()->id)
            ->where('stars', $request->filter)
            ->paginate(8);
    }

    public function noFilterSearchAndSort($request, $temp) {
        return Review::search($request->search)
            ->where('account_id', Auth::user()->id)
            ->orderBy($temp[0], $temp[1])
            ->paginate(8);
    }

    public function noFilterAndSearch($request) {
        return Review::search($request->search)
            ->where('account_id', Auth::user()->id)
            ->paginate(8);
    }

    public  function noFilter() {
        return Review::where('account_id', '=', Auth::user()->id)->paginate(8);
    }
}

