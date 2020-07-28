<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\product;
use App\product_image;
use App\category;
use Image;
use App\productattributeassoc;
use App\Page;


class productController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    { 

        $keyword = $request->get('search');
        $perPage = 10;

        if (!empty($keyword)) {
            $product = product::where('product_name', 'LIKE', "%$keyword%")
                ->orWhere('product_description', 'LIKE', "%$keyword%")
                ->orWhere('status', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $product = product::latest()->paginate($perPage);
        }
        return view('admin.product.index',compact('product'));
    }

    public function create()
    {
        $data['category']=$category = DB::table('categories')->get();
        //print_r($category); exit();
        return view('admin.product.create',$data);
    }

    public function store_product(Request $request)
    { //echo 'hii';exit();
        if($request->ismethod('post'))
        {   
            $request->validate(
                [
                    'product_name' => 'required|min:4|regex:/^([a-zA-Z]+\s)*[a-zA-Z]+$/|max:255',
                    'product_code' => 'required|min:4|max:255',
                    'product_color' => 'required|min:4|regex:/^([a-zA-Z]+\s)*[a-zA-Z]+$/|max:255',
                    'product_description' => 'required|min:4|max:255',
                    'product_price' => 'required|min:4|regex:/^[0-9]*$/|max:255',
                    'image' => 'required',
                ]
            );
            // exit();

            //print_r($request->input());
            /*********insert in product table************/
            $product_data = $request->all();
            //print_r($product_data);
            $product = new product;
            $product->category_id = $request->input('category_id');
            $product->name = $request->input('product_name');
            $product->code = $request->input('product_code');
            $product->colour = $request->input('product_color');
            $product->description = $request->input('product_description');
            $product->price = $request->input('product_price');
            $product->status = $request->input('status');
            $product->save();
            /*********insert in product table************/

            /*********insert in product_images table************/
            $product_img_data = new product_image;
            //fteching product id and name from product table
            $pid_last_row = DB::table('product')->latest()->first()->id;
            //print_r($pid_last_row); 
           
            // exit();
            $product_img_data->product_id = $pid_last_row;
        
            if($request->hasfile('image'))
            {
                $img_tmp =$request->file('image');//Input::file('image');
                if($img_tmp->isValid())
                {
                    //image path code

                    // $extension = $img_tmp->getClientOriginalExtension();
                    // $filename = rand(111,99999).'.'.$extension;
                    // $img_path = 'uploads/products/'.$filename;

                    $file = $request->file('image')->getClientOriginalName();
                    $filename = pathinfo($file, PATHINFO_FILENAME);
                    $extension = pathinfo($file, PATHINFO_EXTENSION);
                    $img_path = 'uploads/products/'.$filename;
                    $img_name=$filename. '.' .$extension; 

                    //image resize
                    Image::make($img_tmp)->resize(500,500)->save($img_path);
                    $product_img_data->image = $img_name;
                }
            }
            $pnm_last_row = DB::table('product')->latest()->first()->name;
            //print_r($pnm_last_row); 
            $product_img_data->product_name = $pnm_last_row;
            $product_img_data->status = $request->input('status');
            $product_img_data->save();
            /*********insert in product_images table************/
            

            return redirect('admin/product')->with('flash_message', 'user added!')->withInput();;
        }
        
    }

    public function edit_product($id)
    {
        //$data['product']=$product = product::findOrFail($id);
        //return $product;
        //echo $id;
        
        $data['category']=$category = DB::table('categories')->get();
        //print_r($category);

        $prod = DB::table('product')
        ->join('product_images','product_images.product_id','product.id')
        ->where('product.id','=',$id)->get();
        //->first();
        $data['product']=$product = json_decode(json_encode($prod), true);
        // print_r($product);
        
        return view('admin.product.edit',$data);
    }

    public function update_product(Request $request, $id)
    {
        //echo $id;

        //$requested_data = $request->all();
        //print_r($requested_data);
        //unset($requested_data['image_old'],$requested_data['_method'],$requested_data['_token'],$requested_data['image']);
        //print_r($requested_data);
        //exit();
        
        $category_id = $request->input('category_id');
        //echo $category_id;
        $name = $request->input('product_name');
        //echo $name;
        $code = $request->input('product_code');
        //echo $code;
        $colour = $request->input('product_color');
        //echo $colour;
        $description = $request->input('product_description');
        //echo $description;
        $price = $request->input('product_price');
        //echo $price;
        $status = $request->input('status');
        //echo $status;
        
        

        $update_prod = array('category_id'=>$category_id,'name'=>$name,'code'=>$code,'colour'=>$colour,'description'=>$description,'price'=>$price,'status'=>$status);
        //print_r($update_prod);

        $updateprod=DB::table('product')
                ->where('id', $id)
                ->update($update_prod);
        //exit();
        /********new image file checking**********/
        if($request->hasfile('image'))
        {
            //echo 'yes';
            $img_tmp =$request->file('image');//Input::file('image');
            //echo $img_tmp; 
                if($img_tmp->isValid())
                {
                    //image path code

                    $file = $request->file('image')->getClientOriginalName();
                    $filename = pathinfo($file, PATHINFO_FILENAME);
                    $extension = pathinfo($file, PATHINFO_EXTENSION);
                    $img_path = 'uploads/products/'.$filename;
                    $img_name=$filename. '.' .$extension; 

                    //image resize
                    Image::make($img_tmp)->resize(500,500)->save($img_path);
                    
                }

               
               $img_new_update = array('product_id'=>$id,'image'=>$img_name,'product_name'=>$name,'status'=>$status);
               //print_r($img_new_update);
               $update_prod_img=DB::table('product_images')
                                    ->where('product_id', $id)
                                    ->update($img_new_update);
                return redirect('/admin/product');
        }
        else{
           //echo 'no';
           $imgold_tmp =$request->input('image_old');
           //echo $imgold_tmp;

           $img_new_update = array('product_id'=>$id,'image'=>$imgold_tmp,'product_name'=>$name,'status'=>$status);
           //print_r($img_new_update);

           $update_prod_img=DB::table('product_images')
                                ->where('product_id', $id)
                                ->update($img_new_update);
           return redirect('/admin/product');
        }

        /**********new image file checking**********/
      
    }

    public function show_product($id)
    {
        $data['product']=$product = product::findOrFail($id);
        //print_r($product);
        //echo '<br/>';

        $data['product_image']=$product_image = product_image::findOrFail($id);
        //print_r($product_image);

        $data['category_name']=$category_name =category::findOrFail($id);

        return view('admin.product.show', $data);
    }

    public function delete_product($id)
    {
        product::destroy($id);
        product_image::destroy($id);

        return redirect('admin/product')->with('flash_message', 'user deleted!');

    }

    public function create_attribute(Request $request, $id=null)
    {  
         $perPage = 10;
         
        // $keyword = $request->get('search');
        // if (!empty($keyword)) {
        //       $product_detls_pagination = productattributeassoc::where('sku', 'LIKE', "%$keyword%")
        //           ->orWhere('size', 'LIKE', "%$keyword%")
        //           ->orWhere('price', 'LIKE', "%$keyword%")
        //           ->latest()->paginate($perPage);
        //   } else {
              $product_detls_pagination = productattributeassoc::latest()->paginate($perPage);
        //     // echo $product_detls_pagination;
        //   }
          //exit();,compact('product_detls_pagination')
        $get_product_detls = product::with('attributes')->where(['id'=>$id])->get();
        //print_r($get_product_detls); 
        $data['product_detls']=$product_detls = json_decode(json_encode($get_product_detls), true);
        //print_r($product_detls);

        
        return view('admin.product.create_attributes',compact('product_detls'),compact('product_detls_pagination'));
    }

    public function store_attribute(Request $request,$id=null)
    {
       
       if($request->isMethod('post'))
       { 
            
            // $request->validate(
            // [
            //     'sku' => 'required|min:6|regex:/^([a-zA-Z]+\s)*[a-zA-Z]+$/|max:255',
            //     'size' => 'required|min:4|regex:/^([a-zA-Z]+\s)*[a-zA-Z]+$/|max:255',
            //     'price' => 'required|min:2|regex:/^[0-9]*$/|max:255',
            //     'stock' => 'required|min:2|regex:/^[0-9]*$/|max:255',
               
            // ]
            // );
            //exit();
            $data = $request->all();
            //print_r($data);

            foreach($data['sku'] as $key=>$val)
            {
                if(!empty($val)){
                    //prevent duplicate SKU Record
                    $attrCountSku = productattributeassoc::where('sku',$val)->count();
                    //print_r($attrCountSku);
                    if($attrCountSku>0){
                        return redirect('/admin/product/attributes/'.$id)->with('flash_message','SKU is already exist. Please enter another SKU. ');

                    }
                    //prevent duplicate Size Record
                    $attrCountSize = productattributeassoc::where(['product_id'=>$id,'size'=>$data['size'][$key]])->count();
                    if($attrCountSize>0){
                        return redirect('/admin/product/attributes/'.$id)->with('flash_message',''.$data['size'][$key].'Size is already exist please enter another size. ');

                    }

                    $attrbute = new productattributeassoc;
                    $attrbute->product_id = $id;
                    $attrbute->sku = $val;
                    $attrbute->size = $data['size'][$key];
                    $attrbute->price = $data['price'][$key];
                    $attrbute->stock = $data['stock'][$key];
                    $attrbute->save();

                }
                
            }
         
            return redirect('/admin/product/attributes/'.$id)->with('flash_message','Products Attributes added.');
       }
    }

    public function delete_product_attr(Request $req,$id=null)
    { //echo  $id; exit();
        $prod_id = $req->input('delete_prod_id');
        //echo $prod_id;
        //exit();
        productattributeassoc::destroy($id);
                
        return redirect('/admin/product/attributes/'.$prod_id)->with('flash_message', 'Product Attribute Deleted!');
    }

    public function edit_attribute(Request $request,$id=null)
    {   //echo $id; exit();
        $product_id = $request->input('product_id');
        //print_r($product_id); exit();
        $sku = $request->input('sku');
        //print_r($sku);
        $size = $request->input('size');
       // print_r($size);
        $price = $request->input('price');
        //print_r($price);
        $stock = $request->input('stock');
       // print_r($stock);
        //exit();

        $data = array(
            'sku'=>$sku,
            'size'=>$size,
            'price'=>$price,
            'stock'=>$stock
        );
        $data['product_detls']=$product_detls = json_decode(json_encode($data), true);
        //print_r($product_detls);
        //print_r(['sku'=>$product_detls['sku'][0]]);
            
        productattributeassoc::where(['id'=>$id])->update(['sku'=>$product_detls['sku'][0],'size'=>$product_detls['size'][0],'price'=>$product_detls['price'][0],'stock'=>$product_detls['stock'][0]]);
       
        return redirect('/admin/product/attributes/'.$product_id)->with('flash_message', 'Product attribute updated succesfully!');
    }
    
}
