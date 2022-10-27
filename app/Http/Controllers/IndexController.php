<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;

class IndexController extends Controller
{
    public function welcome(){
        $data=News::select("title","description","file_name","id","category")->get();
        $count=count($data);
        $sum=$count;
        $i=0;
        $arr_title=[];
        $arr_description=[];
        $arr_file=[];
        $arr_id=[];
        $arr_category=[];
        $sports=[];
        $world=[];
        $technology=[];
        $business=[];
        while($i<$sum){
            $arr_title[$i]=$data[$count-1]['title'];
            $arr_description[$i]=$data[$count-1]['description'];
            $arr_file[$i]=$data[$count-1]['file_name'];
            $arr_id[$i]=$data[$count-1]['id'];            
            $arr_category=$data[$count-1]['category'];
            if($arr_category=="sports"){
                $sports[]=[
                    'id'=>$arr_id[$i],
                    'title'=>$arr_title[$i],
                    'description'=>$arr_description[$i],
                    'file_name'=>$arr_file[$i]
                ];
            }
            elseif($arr_category=="world"){
                $world[]=[
                    'id'=>$arr_id[$i],
                    'title'=>$arr_title[$i],
                    'description'=>$arr_description[$i],
                    'file_name'=>$arr_file[$i]
                ];
            }
            elseif($arr_category=="technology"){
                $technology[]=[
                    'id'=>$arr_id[$i],
                    'title'=>$arr_title[$i],
                    'description'=>$arr_description[$i],
                    'file_name'=>$arr_file[$i]
                ];
            }
            elseif($arr_category=="business"){                
                $business[]=[
                    'id'=>$arr_id[$i],
                    'title'=>$arr_title[$i],
                    'description'=>$arr_description[$i],
                    'file_name'=>$arr_file[$i]
                ];                
            }
            $i++;
            $count--;
        }                      
        return view("news",["arr_title"=>$arr_title,"arr_description"=>$arr_description,"arr_file"=>$arr_file,"arr_id"=>$arr_id
        ,"sports"=>$sports,"world"=>$world,"technology"=>$technology,"business"=>$business]);
    }
    public function single_page(){
        return view("single_page");
    }
    public function create_news(){
        return view("create_news");
    }
    public function create(Request $request){
        $title=$request->title;
        $description=$request->description;
        $news=$request->news;
        $category=$request->category;
        $author=$request->author;
        $file_name=$_FILES['file']['name'];
        $news=News::create([
            'title'=>$title,
            'description'=>$description,
            'news'=>$news,
            'author'=>$author,
            'file_name'=>$file_name,
            'category'=>$category
        ]);
        if($news){
            return redirect()->route('single_page', ['id'=> $news->id]);
        }
    }    
    public function select(){        
        $request=$_SERVER['REQUEST_URI'];
        $id=explode("/",$request);
        $id=end($id);        
        $all=News::select("title","news","author","file_name","category")->where("id",$id)->first();
        $category=$all['category'];
        $categories=News::select("id","title","file_name")->where("category",$category)->get();
        $sum=count($categories);
        $requiredCat=[$categories[$sum-1],$categories[$sum-2],$categories[$sum-3]];
        return view("single_page",["arr_title"=>$all['title'], "arr_news"=>$all['news'],
         "arr_file"=>$all['file_name'], "arr_author"=>$all['author'],"category"=>$all['category'],"requiredCat"=>$requiredCat]);
    }
    public function contact(){
        return view("contact");
    }

    public function category(){
        $request=$_SERVER['REQUEST_URI'];
        $category=explode("/",$request);
        $category=end($category);
        $all=News::select("id","title","description","file_name","category")->where("category",$category)->get();

        return view("category",["all"=>$all]);
    }
}
