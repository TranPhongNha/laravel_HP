<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Components\Recusive;

class CategoryController extends Controller
{
    //thực tế
    // private $htmlSlelect;
    private $category;

    public function __construct(Category $category)
    {
        // $this->htmlSlelect ='';
        $this->category = $category;
    }

    public function create()
    {
//        //hiển thi category trong databsae
//        // $data = Category::all();
//        $data = $this->category->all();
//        //lấy recusive qua, khi new 1 cái contructer thì sẽ nhận 1 biến data
//        $recusive = new Recusive($data);
//        // sau khi gọi được hàm thì khai báo phương thức
//        $htmlOption = $recusive->categoryRecusive();
        $htmlOption = $this->getCategory($parentId = '');

        // foreach ($data as $value){
        //     if ($value['parent_id'] == 0){
        //         echo "<option>".$value['name']."</option>";

        //         foreach ($data as $value2) {
        //             if($value2['parent_id']== $value['id']){
        //                 echo "<option>".'-'. $value2['name']. "</option>";

        //                 foreach ($data as $value3) {
        //                     if($value3['parent_id']== $value2['id']){
        //                         echo "<option>". '--'. $value3['name']."</option>";
        //                     }
        //                 }
        //             }
        //         }
        //     }
        // }
        //demo
        // $this->categoryRecusive(0);
        //thực tế
        // $htmlOption = $this->categoryRecusive(0);
        return view('admin.category.add', compact('htmlOption'));
        //    return view('category.add');
    }
    //đệ Qui
    // function categoryRecusive($id, $text =''){
    //     $data = Category::all();
    //     foreach ($data as $value){
    //         if ($value['parent_id'] == $id){
    //             //demo
    //             // echo "<option>".$text.$value['name']."</option>";
    //             //thuc tế
    //             $this->htmlSlelect .= "<option>".$text.$value['name']."</option>";
    //             $this->categoryRecusive($value['id'],$text.'-');
    //         }
    //     }
    //      return $this->htmlSlelect;
    // }

    public function index()
    {
        $categories = $this->category->latest()->paginate(5);
        return view('admin.category.index', compact('categories'));
    }

    //tạo phương thức store
    public function store(Request $request)
    {
        $this->category->create([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'slug' => str_slug($request->name)
        ]);
        return redirect()->route('admin.categories.index');
    }

// phương thức lấy category dùng chung
    public function getCategory($parentId)
    {
        $data = $this->category->all();
        //lấy recusive qua, khi new 1 cái contructer thì sẽ nhận 1 biến data
        $recusive = new Recusive($data);
        // sau khi gọi được hàm thì khai báo phương thức
        $htmlOption = $recusive->categoryRecusive($parentId);
        return $htmlOption;
    }

    //phương thức edit
    public function edit($id)
    {
        $category = $this->category->find($id);
        $htmlOption = $this->getCategory($category->parent_id);
        return view('admin.category.edit', compact('category', 'htmlOption'));
    }

    //phương thức update
    public function update($id, Request $request)
    {
        $this->category->find($id)->update([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'slug' => str_slug($request->name)
        ]);
        return redirect()->route('admin.categories.index');
    }

    //phương thức delete
    public function delete($id)
    {
        $this->category->find($id)->delete();
        return redirect()->route('admin.categories.index');
    }
}
