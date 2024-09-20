<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Link;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Poster;
use App\Models\Product;
use App\Models\Rating;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Yajra\DataTables\Html\Builder;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();
        
        $this->app->bind('Spatie\Permission\Models\Role', 'App\Models\Role');
        $email = 'test@gmail.com';
        $phone = '12345667';
        $address_ar = 'سوريا-دمشق';
        $address_en = 'Damascus-Syria';
        view()->composer('*', function ($view) use ($address_ar) {
            $view->with('address_ar', $address_ar);
        });
        view()->composer('*', function ($view) use ($address_en) {
            $view->with('address_en', $address_en);
        });
        view()->composer('*', function ($view) use ($email) {
            $view->with('email', $email);
        });
        view()->composer('*', function ($view) use ($phone) {
            $view->with('phone', $phone);
        });
        Builder::useVite();
        $lang = app()->getLocale();
        $categories =  (new Category())->where('status', 1)->where('parent_id',0)->whereHas('files')->whereHas('products')->orWhereHas('children')->get();
      
        if (!empty($categories)) {
            view()->composer('*', function ($view) use ($categories) {
                $view->with('categories', $categories);
            });
        }

        
        $sub_departements =(new Category())->where('status', 1)->where('parent_id','!=',0)->get();
        if (!empty($sub_departements)) {
            view()->composer('*', function ($view) use ($sub_departements) {
                $view->with('sub_departements', $sub_departements);
            });
        }
        $products = (new Product())->where('status', 1)->whereHas('files')->with('category')->paginate();
        $products1s = (new Product())->where('status', 1)->whereHas('files')->with('category')->get();
       $wights= Product::with('weight_measurement')->select('wight','weight_measurement_id')->distinct()
       ->get();
        if (!empty($wights)) {
            view()->composer('*', function ($view) use ($wights) {
                $view->with('wights', $wights);
            });
        }
        $min='';
        $max = '';
        if (!empty($products1s)) {
            
            foreach($products1s as $product){
               if(request('category')){
                if($product->new_selling_price == null){
                    $min = $products1s->where('category_id',request('category'))->min('selling_price');
                    $max = $products1s->where('category_id',request('category'))->max('selling_price');
                }else{
                    $min = $products1s->where('category_id',request('category'))->min('new_selling_price');
                    $max = $products1s->where('category_id',request('category'))->max('new_selling_price');

                }
               }else{
                if($product->new_selling_price == null){
                    $min = $products1s->min('selling_price');
                    $max = $products1s->max('selling_price');
                   
                }else{
                    $min = $products1s->min('new_selling_price');
                    $max = $products1s->max('new_selling_price');
                   

                }
               }
            }
            view()->composer('*', function ($view) use ($products) {
                $view->with('products', $products);
            });
            view()->composer('*', function ($view) use ($min) {
                $view->with('min', $min);
            });
            view()->composer('*', function ($view) use ($max) {
                $view->with('max', $max);
            });
        }
        $latest_products = (new Product())->where('status', 1)->whereHas('files')->whereHas('category')->latest()->take(10)->orderBy('id', 'desc')->get();
        if (!empty($latest_products)) {
            view()->composer('*', function ($view) use ($latest_products) {
                $view->with('latest_products', $latest_products);
            });
        }
        $top_rated_products = (new Product())->where('status', 1)->whereHas('ratings')->whereHas('files')->whereHas('category')->latest()->take(10)->get();
        if (!empty($top_rated_products)) {
            view()->composer('*', function ($view) use ($top_rated_products) {
                $view->with('top_rated_products', $top_rated_products);
            });
        }
      
        $sales =(new Product())->whereNotNull('new_selling_price')->where('status', 1)->whereHas('files')->whereHas('category')->orderBy('id', 'desc')->get();
        if (!empty($sales)) {
            view()->composer('*', function ($view) use ($sales) {
                $view->with('sales', $sales);
            });
        }
        
        $links = Link::where('status',1)->get();
        if (!empty($links)) {
            view()->composer('*', function ($view) use ($links) {
                $view->with('links', $links);
            });
        }
        
        $offers_category = Poster::with('files')->whereHas('category',function($q){
            $q->whereHas('products');
        })->where('status',1)->get();
      
        if (!empty($offers_category)) {
            view()->composer('*', function ($view) use ($offers_category) {
                $view->with('offers_category', $offers_category);
            });
        }
        
        $poster = Poster::whereHas('files')->where('status',1)->latest()->first();
       
        if (!empty($poster)) {
            view()->composer('*', function ($view) use ($poster) {
                $view->with('poster', $poster);
            });
        }

      
        $sells = OrderDetail::whereHas('order',function($q){
            $q->where('status','Accept');
        })->
        select(DB::raw('SUM(quantity * price) as total_sales'))->value('total_sales');
          
          if (!empty($sells)) {
            view()->composer('*', function ($view) use ($sells) {
                $view->with('sells', $sells);
            });
        }
        $money_capital = Product::sum('purchasing_price');
     
        if (!empty($money_capital)) {
            view()->composer('*', function ($view) use ($money_capital) {
                $view->with('money_capital', $money_capital);
            });
        }
        $benefits = $money_capital-$sells;
        if (!empty($benefits)) {
            view()->composer('*', function ($view) use ($benefits) {
                $view->with('benefits', $benefits);
            });
        }
        $sells_orders = OrderDetail::whereHas('order',function($q){
            $q->where('status','Accept');
        })->pluck('id','product_id');
        $money_capital_orders=[];
        foreach($sells_orders as $key=>$value){
            $money_capital_order = Product::where('id',$key)->get();
            array_push($money_capital_orders,$money_capital_order);
        }
       

    }
}
