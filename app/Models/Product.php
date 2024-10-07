<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'barcode_id', 'name_ar', 'name_en', 'weight_measurement_id', 'category_id', 'wight', 'status', 'purchasing_price', 'selling_price', 'new_selling_price', 'quantity', 'descrption_ar', 'descrption_en'];
    public $timestamps = false;
    public function category()
    {
        return $this->belongsTo(Category::class)->where('status', 1);
    }
    public function weight_measurement()
    {
        return $this->belongsTo(WeightMeasurement::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function files()
    {
        return $this->morphMany(File::class, 'fileable');
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, OrderDetail::class, 'product_id', 'order_id');
    }
    public function offers()
    {
        return $this->hasMany(Poster::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function size() {
        return $this->belongsToMany(Size::class, 'product__sizes');
    }
    public function favs()
    {
        return $this->hasMany(Favourite::class);
    }
    public function status()
    {

        return $this->status == 1
        ? '<a href="' . route('backend.products.status', [$this->id, 'status']) . '"class="btn btn-primary btn-sm toggle-class" title="' . __('table.update_status') . '"> <span class="badge text-bg-primary"><i class="fa fa-toggle-on" aria-hidden="true"></i></span></a>'
        : '<a href="' . route('backend.products.status', [$this->id, 'status']) . '"class="btn btn-warning toggle-class" title="' . __('table.update_status') . '">  <span class="badge text-bg-warning"><i class="fa fa-toggle-off" aria-hidden="true"></i></span></a>';
    }

    public function price()
    {

        return $this->new_selling_price != null ? $this->new_selling_price : $this->selling_price;
    }
    public function min()
    {
        return $this->new_selling_price != null ? $this->min('new_selling_price') : $this->min('selling_price');
    }
    public function max()
    {
        return $this->new_selling_price != null ? $this->max('new_selling_price') : $this->max('selling_price');
    }

    
    public function scopeSearch(Builder $query)
    {

        $searchTerm = request()->search;

        $minPrice = request()->min;
        $maxPrice = request()->max;
        //    $lang = app()->getLocale();
        return $query->when($searchTerm, function ($query) use ($searchTerm) {
            $query->where("name_ar", 'like', "%" . $searchTerm . "%")->orWhere("name_en", 'like', "%" . $searchTerm . "%")
                ->orWhere("descrption_ar", 'like', "%" . $searchTerm . "%")->orWhere("descrption_en", 'like', "%" . $searchTerm . "%")
                ->orWhere('barcode_id', $searchTerm);
            ;
        })

        // ->when(request()->filter == null, function ($query) use ($minPrice, $maxPrice)  {
        //     $query->where(function ($query) use ($minPrice, $maxPrice) {
        //         $query->whereBetween('selling_price', [ (int)$minPrice,  (int)$maxPrice])
        //               ->orWhereBetween('new_selling_price', [ (int)$minPrice,  (int)$maxPrice]);
        //     });
        // })
            ->when(request()->wight, function ($query) {
                if (request()->wight == 1) {
                    $query = $query->whereHas('weight_measurement', function ($q) {
                        $q->where('name_en', 'Gram');
                    })->where('wight', '<', (int) request()->wight);
                } else {

                    $query = $query->where('wight', '<', (int) request()->wight);
                }

            })
            ->when(request()->category, function ($query) {
                $query->whereHas('category', function ($query) {
                    $query->where("name_ar", 'like', "%" . request()->category . "%")->orWhere("name_en", 'like', "%" . request()->category . "%");
                });
            });

    }

    public function scopeFilter(Builder $query)
    {
        $request = request();
        $searchTerm = $request->search;
        $minPrice = $request->min;
        $maxPrice = $request->max;
        $weight = $request->wight;
        $category = $request->category;
    
        if ($searchTerm) {
            if ($category && $category != "null") {
                $categoryId = $category;
                $category = Category::with('children')->where('id', $categoryId)->first();
                $childIds =  $this->getAllDescendantIds($category);
           
               return $query->where(function($q) use ($category, $childIds, $searchTerm) {
                    $q->where('category_id', $category->id)
                      ->orWhereIn('category_id', $childIds)
                      ->where(function($q) use ($searchTerm) {
                          $q->where("name_ar", 'like', "%" . $searchTerm . "%")
                            ->orWhere("name_en", 'like', "%" . $searchTerm . "%")
                            ->orWhere("descrption_ar", 'like', "%" . $searchTerm . "%")
                            ->orWhere("descrption_en", 'like', "%" . $searchTerm . "%");
                      });
                });
            } else {
                return  $query->where(function($q) use ($searchTerm) {
                    $q->where("name_ar", 'like', "%" . $searchTerm . "%")
                      ->orWhere("name_en", 'like', "%" . $searchTerm . "%")
                      ->orWhere("descrption_ar", 'like', "%" . $searchTerm . "%")
                      ->orWhere("descrption_en", 'like', "%" . $searchTerm . "%");
                });
            }
        }
    
        if ($minPrice && $maxPrice) {
            if ($category && $category != "null") {
                $categoryId = $category;
                $category = Category::with('children')->where('id', $categoryId)->first();
                $childIds = $this->getAllDescendantIds($category);
                
                return $query->where(function($q) use ($category, $childIds, $minPrice, $maxPrice) {
                    $q->where('category_id', $category->id)
                      ->orWhereIn('category_id', $childIds);
                })
                ->where(function($q) use ($minPrice, $maxPrice) {
                    $q->whereBetween('selling_price', [$minPrice, $maxPrice])
                      ->orWhereBetween('new_selling_price', [$minPrice, $maxPrice]);
                });
            } else {

                    if($this->new_selling_price != null){
                     
                        return $query->whereBetween('new_selling_price', [$minPrice, $maxPrice]);
                   
                    }else{
                     
                        return $query->whereBetween('selling_price', [$minPrice, $maxPrice]);
                    }
     
            }
        }
    
        if ($weight) {
            $weightInGrams = $weight * 1000;
            $weightInKg = $weight ;
           if($weight == 60){
         
            if ($category && $category != "null") {
                $categoryId = $category;
                $category = Category::with('children')->where('id', $categoryId)->first();
                $childIds =  $this->getAllDescendantIds($category);
                array_push($childIds,$category->id);
               return  $query->where(function($q) use ($category, $childIds, $weight) {
                    $q->whereIn('category_id', $childIds)
                    //   ->orWhereIn('category_id', $childIds)
                      ->where(function($q) use ($weight) {
                          $q->where('weight_measurement_id', 2)->whereRaw('wight/1000  > ?', [50])
                            ->orWhere('weight_measurement_id', 1)->whereRaw('wight  > ?', [50]);
                      });
                });
            } else {
                return $query->where(function($q) use ($weightInGrams) {
                    $q->where('weight_measurement_id', 1)->whereRaw('wight  > ?', [50])
                      ->orWhere('weight_measurement_id', 2)->whereRaw('wight/1000  > ?', [50]);
                });
            }
           }else{
      
            if ($category && $category != "null") {
                $categoryId = $category;
                $category = Category::with('children')->where('id', $categoryId)->first();
                
                $childIds =  $this->getAllDescendantIds($category);
                array_push($childIds,$category->id);
                return $query->where(function($q) use ($category, $childIds, $weightInGrams,$weightInKg) {
                    $q->whereIn('category_id', $childIds)
                        // ->orWhereIn('category_id', $childIds)
                      ->where(function($q) use ($weightInGrams,$weightInKg) {
                        $q->where('weight_measurement_id',2)->whereRaw('wight  < ?', [$weightInGrams])
                        ->orWhere('weight_measurement_id',1)->whereRaw('wight * 1000  < ?', [$weightInGrams]);
                       
                      });
                });
            } else {
                return $query->where(function($q) use ($weightInGrams) {
                    
                   
                    $q->where('weight_measurement_id', 2)->whereRaw('wight < ?', [$weightInGrams])
                      ->orWhere('weight_measurement_id', 1)->whereRaw('wight * 1000 < ?', [$weightInGrams]);
                });
            }
           }
        }
    
        if ($category && $category != "null") {
            $categoryId = $category;
            $category = Category::with('children')->where('id', $categoryId)->first();
           $childs =  $this->getAllDescendantIds($category);
           
            return $query->where('category_id', $category->id)
            ->orWhereIn('category_id', $childs);
         
        }
    
        return $query;
    }

    public function getAllDescendantIds($category)
        {
            $childIds=$category->whereHas('children',function($q){
                $q->with('children');
            })->pluck('id')->toArray();
        
            // $childIds = $category->children->pluck('id')->toArray();
           
            // foreach ($childIds as $child) {
            //     $childIds = array_merge($childIds, $this->getAllDescendantIds($child));
            // }
            
            return $childIds;
        }
    
    public function getDataAsLang()
    {
        $lang = request()->segment(1);
        return $this->select('id', "name_$lang as name", 'wight', 'category_id', 'weight_measurement_id', 'wight', 'status', 'purchasing_price', 'selling_price', 'new_selling_price', 'quantity', "descrption_$lang as descrption");
    }
    protected function scopeDescrption()
    {
        $lang = request()->header('Accept-Language');
        return preg_replace('/[^a-zA-Z0-9\s]/', '', "descrption_$lang");
    }

    public function getDescriptionAttribute($value)
    {
        return $this->cleanText($value);
    }

}
