<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\product;
use App\category;
use Image;
use App\productattributeassoc;
use App\Page;
use App\product_image;




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
        //print_r($product);


        
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
                    'product_name' => 'required|min:4|regex:/^([a-zA-Z. -]+\s)*[a-zA-Z. -]+$/|max:255',
                    'product_code' => 'required|min:4|max:255',
                    'product_color' => 'required|min:4|regex:/^([a-zA-Z. -]+\s)*[a-zA-Z. -]+$/|max:255',
                    'product_description' => 'required|min:4|max:255',
                    'product_price' => 'required|min:2|regex:/^[0-9]*$/|max:255',
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
                    $img_path = 'uploads/products/'.$filename.'.'.$extension;
                    $img_name=$filename. '.' .$extension; 
                    //print_r($img_name);
                    //image resize
                    Image::make($img_tmp)->resize(500,500)->save($img_path);
                    $product->image = $img_name;
                }
            }
            //exit();
            $product->save();
            /*********insert in product table************/
           

            return redirect('admin/product')->with('flash_message', 'user added!')->withInput();;
        }
        
    }

    public function edit_product($id)
    {
        $data['product']=$product = product::findOrFail($id);
        //print_r($product);
        //echo $id;
        //exit();
        
        $data['category']=$category = DB::table('categories')->get();
        //print_r($category);

        
        
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
                    $img_path = 'uploads/products/'.$filename.'.'.$extension;
                    $img_name=$filename. '.' .$extension; 
                    //print_r($img_name);
                    //image resize
                    Image::make($img_tmp)->resize(500,500)->save($img_path);
                    
                }

        }
        

        $update_prod = array('category_id'=>$category_id,
        'name'=>$name,
        'code'=>$code,
        'colour'=>$colour,
        'description'=>$description,
        'price'=>$price,
        'image'=>$img_name,
        'status'=>$status);
        //print_r($update_prod);exit();

        $updateprod=DB::table('product')
                ->where('id', $id)
                ->update($update_prod);
        //exit();
        return redirect('/admin/product');
       
    }

    public function show_product($id)
    {  
        $data['product']=$product = product::findOrFail($id);
        //print_r($product);
        //echo '<br/>';
        
        
        $data['category_name']=$category_name =category::findOrFail($id);
        // print_r($category_name);
        // exit();
        return view('admin.product.show', $data);
    }

    public function delete_product($id)
    {
        product::destroy($id);

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
    

    public function add_images(Request $request,$id=null)
    {
        $productDetails = product::where(['id'=>$id])->first();
        if($request->isMethod('post'))
        {
            $data = $request->all();
            // print_r($data);exit();
            if($request->hasfile('image'))
            {
                $files = $request->file('image');
                foreach($files as $file)
                {
                       $image = new product_image;
                    
                       $extension1 = $file->getClientOriginalName();
                       //echo $extension1;
                       $filename = pathinfo($extension1, PATHINFO_FILENAME);
                       //echo $filename;
                       $extension = pathinfo($extension1, PATHINFO_EXTENSION);
                       //echo $extension;
                       $img_path = 'uploads/products/'.$filename.'.'.$extension;
                        $img_name=$filename. '.' .$extension; 
                       //print_r($img_name);

                        //image resize
                        Image::make($file)->resize(500,500)->save($img_path);

                        $image->image =$img_name;
                        $image->product_id = $data['product_id'];
                        $image->save();
                        

                   
                }
            }
            //exit();
            return redirect('/admin/product/add-images/'.$id)->with('flash_message', 'Images has been added succesfully!');
        }

        $product_images = product_image::where(['product_id'=>$id])->get();
        //print_r($product_images); exit();

        return view('admin.product.add_images',compact('productDetails','product_images'));
    }


    public function delete_product_imgaes($id=null)
    {
        $productImage = product_image::where(['id'=>$id])->first();
        //print_r($productImage);

        $image_path =  'uploads/products/';


        if(file_exists($image_path.$productImage->image))
        {
            unlink($image_path.$productImage->image);
            
        }
        
        //exit();
        product_image::destroy($id);
                
        return redirect()->back()->with('flash_message', 'Product Image Deleted!');
    }
}
