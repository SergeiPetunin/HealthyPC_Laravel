<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Rewie;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //---------------------- mainSite. Меню Catalog. Список продуктов по всем категориям
    public function index()
    {
        $categories = Category::orderBy('name','asc')->get();
        $products = Product::orderBy('created_at', 'asc')->paginate(3);
        return view('catalog.index', compact('products','categories'));
    }

    //---------------------- mainSite. Меню Catalog. Список продуктов по выбранной категории
    public function productByCategory(Category $category)
    {
        $sortinglist=array('all','date asc','date desc','title asc', 'title desc');
        $categories = Category::orderBy('name','asc')->get();
        $products = Product::orderBy('created_at', 'asc')->where('category_id',$category->id)->paginate(3);
        return view('catalog.index', compact('category','categories','products','sortinglist'));
    }

    //---------------------- mainSite. Просмотр детальной информации по выбранному продукту
    public function show(Product $product)
    {
        $categories = Category::orderBy('name', 'asc')->get();
        $products = Product::orderBy('created_at', 'asc')->get();
        $rewiews=Rewie::where('product_id',$product->id)->orderBy('created_at', 'desc')->get();
        return view('catalog.productdetails', compact('product','categories','products','rewiews'));//переход на просмотр инф-ции по продукту
    }

    //---------------------- mainSite. Заполнение данных для ордера на продукты
    public function checkout()
    {
        $cartItems = \Cart::getContent();
        $categories = Category::orderBy('name','asc')->get();
        $products = Product::orderBy('created_at', 'asc')->get();
        return view('cart.checkout', compact('products','categories','cartItems'));
    }

    //-------------------mainSite search.
    public function search(Request $request) {
        $search = $request->input('search');
        $categories = Category::orderBy('name','asc')->get();
        //$products = Product::where('title','LIKE',"%as%")->paginate(3);
        $products = Product::query()->where('title','LIKE',"%{$search}%")->paginate(3);
        return view('catalog.index', compact('products','categories','search'));
    }

    //---------------------- adminpanel. Список всех продуктов
    public function indexAdmin()
    {
        $categories = Category::orderBy('name','asc')->get();
        $products = Product::orderBy('created_at', 'desc')->get();
        return view('products.index', compact('products','categories'));
    }

    //---------------------- adminpanel. list products by category
    public function productByCategory1(Request $request) {
        //из формы передан id категории
            $data = $request->all();//данные переданы формой
            $categories = Category::orderBy('name','asc')->get();// все категории
            $selectCategory=$data['category_id'];
        //если выбран All - все
        if($data['category_id'] == "0") {
            return redirect('/productlist');//возврат на полный список товаров
        }else{ //если выбрана категория
            //запрос на выбор по категории
            $products = Product::where('category_id', $data['category_id'])->get();
            return view('products.index', compact('products','categories','selectCategory'));
        }
    }

    //---------------------- adminpanel. Форма для ввода нового продукта
    public function create()
    {
        $categories = Category::orderBy('name', 'asc')->get();
        return view('products.create', compact('categories'));
    }

    //---------------------- adminpanel. запись нового продукта в БД
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'price' => 'required',
            'warranty' => 'required',
            'category_id' => 'required'
        ]);
        $data = $request->all();//данные переданы формой
        if (!empty($request->file('image')) ) {
            $filename = $request->file('image')->getClientOriginalName();//имя файла картинки
            $data['image'] = $filename;//записали имя в базу (INSERT)
        }else{
            $data['image'] = "";
        }
        Product::create($data);
        //----------------закачка картинки root/images/
        $file = $request->file('image');//путь исходной картинки
        if(isset($filename)) {
            $file->move('../public/images/shop/',$filename);//загрузка изображения
        }
        return redirect('/productlist');//возврат к списку продуктов
    }

    //---------------------- adminpanel. редактирование продукта
    public function edit(Product $product)
    {
        $categories = Category::orderBy('name', 'asc')->get();//list category
        return view('products.edit', compact('categories','product'));
    }

    //---------------------- adminpanel. запись отредактированных данных в БД
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'price' => 'required',
            'warranty' => 'required',
            'category_id' => 'required'
        ]);
        $data = $request->all();//данные переданы формой
        if($request->file('image')) {
            $oldimage =$product -> image;
            $filename = $request->file('image')->getClientOriginalName();//имя файла картинки
            $data['image'] = $filename;//записали имя в базу (INSERT)
            //----------------закачка картинки root/images/
            $file = $request->file('image');//путь исходной картинки
            if($filename) {
                $file->move('../public/images/shop',$filename);//загрузка изображения
            }
            if(!empty($oldimage) && file_exists('../public/images/shop/'.$oldimage)){
                unlink('../public/images/shop/'.$oldimage);
            }
        }
        $product->update($data);
        return redirect('/productlist');//возврат к списку продуктов
    }

    //---------------------- adminpanel. удаление. преход на форму для подтверждения удаления продукта
    public function destroy(Product $product)
    {
        $categories = Category::orderBy('name', 'asc')->get();
        return view('products.delete', compact('categories','product'));
    }

    //---------------------- adminpanel. удаление продукта из БД
    public function delete(Product $product,Request $request)
    {
        $oldimage =$product -> image;
        $product->delete();
        if(!empty($oldimage) && file_exists('../public/images/shop/'.$oldimage)){
            unlink('../public/images/shop/'.$oldimage);
        }
        return redirect('/productlist');//возврат к списку продуктов
    }

    // ????????????
    //  public function cart()
    //  {
    //      $categories = Category::orderBy('name','asc')->get();
    //      $products = Product::orderBy('created_at', 'asc')->get();
    //      return view('cart.index', compact('products','categories'));
    //  }

}
