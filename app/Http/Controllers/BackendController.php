<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Role;
use Composer\Util\Http\Response;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Yajra\DataTables\Services\DataTable;

class BackendController extends Controller
{
    public $dataTable;
    public $model;
    public function __construct(DataTable $dataTable, Model $model)
    {
        $var  = request()->segment(3);
        $var_2 = rtrim(request()->segment(3), "s");
        $permission = __("sidebar.tables.$var");
        $permission_2 = __("sidebar.tab.$var_2");
        $Display = __('sidebar.methods.Display');
        $Create = __('sidebar.methods.Create');
        $Update = __('sidebar.methods.Update');
        $Delete = __('sidebar.methods.Delete');
        // dd("$Update $permission_2");
        // $this->middleware(["permission:Display $permission"], ['only' => ['index', 'show']]);
        $this->middleware(["permission:$Display $permission|$Update $permission_2|$Delete $permission_2"], ['only' => ['index', 'show']]);
        $this->middleware(["permission:$Create $permission_2"], ['only' => ['create', 'store']]);
        $this->middleware(["permission:$Update $permission_2"], ['only' => ['edit', 'update']]);
        $this->middleware(["permission:$Delete $permission_2"], ['only' => ['destroy']]);
        $this->middleware(['permission:Delete Multible'], ['only' => ['MultiDelete']]);
        $this->dataTable = $dataTable;
        $this->model = $model;
    }

    // public function __construct(public Model $model)
    // {

    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        try {
            return $this->dataTable->render('backend.includes.table');
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {

            return view('backend.' . $this->model->getTable() . '.form', $this->append());
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {

            $row = $this->model::query()->where('id', $id)->first();

            return view('backend.' . $this->model->getTable() . '.form', compact('row'), $this->append());
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $row = $this->model::where('id', $id)->first();

            if (request()->segment(3)== 'categories') {
                $products = $row->products;
          
            //     if (isset($products)) {

            //         foreach ($products as $product) {
                        
            //             if($product->ordes->count() == 0){
            //                 if (isset($product->images)) {
            //                     foreach ($product->images as $img) {
    
            //                         $img->delete();
            //                     }
            //                 }
            //                 $product->delete();

            //                }
            //         }
            //     }

            //     if (isset($row->images)) {
            //         foreach ($row->images as $img) {

            //             $img->delete();
            //         }
            //     }
            //     $row->products()->delete();
            //     $row->delete();
            //     $data =Category::where('id',$id)->orWhere('parent_id',$id)->get();
                
            //    if(isset($data)){
            //     foreach($data as $d){
            //         foreach($d->products as $p){
            //             if(isset($p->files)){
            //                 foreach($p->files as $f){
            //                     $f->delete();
            //                 }
            //             }
            //             $d->products()->delete();
            //         }
            //         if(isset($d->files)){
            //             foreach($d->files as $fd){
            //                 $fd->delete();
            //             }
            //         }
            //         $d->delete();
            //     }
            //    }
             if(count($products) > 0){
                return response()->json(['title' => __('messages.error'), 'message' => __('messages.this category has products'), 'status' => 'error']);

             }else{
                if(count($row->children) > 0){
                   $childs =  $row->children;
                   foreach($childs as $child){
                    if(count($child->products) == 0 ){
                        $row->delete();
                        $child->delete();

                    }else{
                        return response()->json(['title' => __('messages.error'), 'message' => __('messages.this category has products'), 'status' => 'error']);

                    }
                   }
                }else{
                    $row->delete();
                }
                
             }

            } elseif(request()->segment(3) == 'products'){
               
              
                if($row->orders->count() != 0 || $row->comments->count() !=0){
             
                return response()->json(['title' => __('messages.error'), 'message' => __('messages.product_has_orders_or_comments'), 'status' => 'error']);
                } 
                   else{
                        $row->files()->delete();
                        $row->delete();
                       }
            }
            elseif(request()->segment(3) == 'roles'){
               $role = Role::where('id',$id)->whereHas('admin')->first();
      
                    if($role){
                        return response()->json(['title' => __('messages.error'), 'message' => __('messages.role_has_admins'), 'status' => 'error']);

                    }
                
            }
            else {
                if (isset($row->images)) {
                    foreach ($row->images as $img) {

                        $img->delete();
                    }
                }
                $row->delete();
            }

            return response()->json(['title' => __('messages.success'), 'message' => __('messages.delete success'), 'status' => 'success']);
        } catch (\Exception $e) {
             return response()->json($e->getMessage(), 500);


        }
    }

    public function updateStatus($id, $column)
    {
        try {

            $row = $this->model::where('id', $id)->first();
            $row->update([$column => !$row->$column]);
            return response()->json(['title' => __('messages.success'), 'message' => __('messages.update success'), 'status' => 'success']);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    public function MultiDelete(Request $request)
    {
        try {
            
            if ($request->segment(3) == "categories") {
                $rows = $this->model::whereIn('id', (array) $request['id'])->orWhereIn('parent_id',(array) $request['id'])->get();

                foreach ($rows as $row) {
                    $products = $row->products;
                    $cat_name = $row->name_.app()->getLocale();
                    if (count($products) == 0) {
                        // $rows = $this->model::whereIn('id', (array) $request['id'])->delete();
                        $childs = $row->children;
                        if(count($childs) > 0){
                        foreach($childs as $child){
                            if(count($child->products) == 0){
                                $child->delete();
                                $row->delete();
                            }
                        }
                    }else{
                        $row->delete();
                    }

                    }else{
                        return response()->json(['title' => __('messages.error'), 'message' => __('messages.this category has products'), 'status' => 'error']);

                    }
                }
                // $this->model::whereIn('id', (array) $request['id'])->delete();
            }elseif(request()->segment(3) == 'roles'){
                $rows = $this->model::whereIn('id', (array) $request['id'])->whereHas('admin')->get();
                if($rows){
                    return response()->json(['title' => __('messages.error'), 'message' => __('messages.role_has_admins'), 'status' => 'error']);

                }else{
                    $rows = $this->model::whereIn('id', (array) $request['id'])->delete();
                }
            }
             elseif(request()->segment(3) == 'products'){
                $rows = $this->model::whereIn('id', (array) $request['id'])->get();
                    foreach($rows as $product){
                        $product_name = $product->name_.app()->getLocale();
                        $product->files()->delete();
                      
                if($product->orders->count() != 0 || $product->comments->count() !=0){
             
                    return response()->json(['title' => __('messages.error'), 'message' => __('messages.product_has_orders_or_comments'), 'status' => 'error']);
                    }
                    }
            }
            else {
                
                $rows = $this->model::whereIn('id', (array) $request['id'])->delete();

            }

            return response()->json(['title' => __('messages.success'), 'message' => __('messages.delete success'), 'status' => 'success']);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    public function show($id)
    {
        try {
            $row = $this->model::query()->where('id', $id)->first();

            return view('backend.' . $this->model->getTable() . '.show', compact('row'), $this->append());
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    public function search(Request $request)
    {
        try {
            $data = $this->model::Search($request->search)->paginate();

            return response()->json([
                'html' => view('backend.' . $this->model->getTable() . '.search', ['data' => $data])->render(),
            ]);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    public function append()
    {
        return [];
    }
}
