<?php
namespace App\Traits;
use Illuminate\Database\Eloquent\Builder;


trait SortBy{


    public function scopeSort(Builder $query, $sort, $number=25){
        switch ($sort) {
            case null:
                $results = $query->orderBy('created_at','desc')->paginate($number);
                break;
            case "oldest":
                $results = $query->orderBy('created_at','asc')->paginate($number);
                break;
            case "newest":
                $results = $query->orderBy('created_at','desc')->paginate($number);
                break;
            case "most_popular":
                $results = $query->withCount('votes')->orderBy('votes_count', 'desc')->paginate($number);
                break;
            case "most_expensive":
                $results = $query->orderBy('price', 'desc')->paginate($number);
                break;
            case "cheapest":
                $results = $query->orderBy('price', 'asc')->paginate($number);
                break;
            default:
                $results = $query->orderBy('created_at','desc')->paginate($number);
                break;

        }
        return $results;
    }
}
