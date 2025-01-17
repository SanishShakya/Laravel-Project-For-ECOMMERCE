<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Backend\SubcategoryRequest;
use App\Model\Category;
use App\Model\Subcategory;
use Illuminate\Http\Request;
use Mockery\Exception;

class SubcategoryController extends BackendBaseController
{

    protected $base_route  = 'backend.subcategory';
    protected $view_path   = 'backend.subcategory';
    protected $panel       = 'SubCategory';
    protected  $page_title,$page_method,$image_path;
    protected  $folder_name = 'product';


    function  __construct()
    {
        $this->image_path = public_path().DIRECTORY_SEPARATOR.'backend'.DIRECTORY_SEPARATOR.'images' . DIRECTORY_SEPARATOR.$this->folder_name.DIRECTORY_SEPARATOR;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->page_title = 'List';
        $this->page_method = 'index';

        try{
            $data['rows'] = Subcategory::all();
            return view($this->loadDataToView($this->view_path.'.index'),compact('data'));
        }catch (Exception $e) {
            redirect()->route('home')->flash('exception', $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->page_title = 'Create';
        $this->page_method = 'create';
        $data['categories'] = Category::pluck('name','id');
        return view($this->loadDataToView($this->view_path.'.create'),compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubcategoryRequest $request)
    {
//        dd($request->file('image'));
        try{
//            if($request->hasFile('image')) {
//                $file  = $request->file('image');
//                $image_name = uniqid() . '.' .$file->getClientOriginalExtension();
//                $file->move(public_path() . '/images',$image_name);
//                $img = Image::make(public_path() . '/images/' . $image_name )->resize(200,400);
//                $img->save(public_path() . '/images/200_400'.$image_name);
//            }
            $image = $this->uploadImage($request,'subcategory_image');
            $request->request->add(['image' => $image]);
            $request->request->add(['created_by' => auth()->user()->id]);
            $record = Subcategory::create($request->all());
            if ($record){
                return redirect()->route($this->base_route . '.index')->with('success',$this->panel . ' created successfully');

            } else {
                return back()->with('error', $this->panel . ' creation failed');
            }
        } catch(Exception $e){
            return redirect()->route($this->base_route . '.index')->with('exception',$e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->page_title = 'View';
        $this->page_method = 'show';
        $data['row'] = Subcategory::find($id);

        return view($this->loadDataToView($this->view_path.'.show'),compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->page_title = 'Edit';
        $this->page_method = 'edit';
        $data['categories'] = Category::pluck('name','id');
        $data['row'] = Subcategory::find($id);
        return view($this->loadDataToView($this->view_path.'.edit'),compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data['row'] = Subcategory::find($id);
        $request->request->add(['updated_by' => auth()->user()->id]);
        $data['row']->update($request->all());
        return redirect()->route($this->base_route . '.index')->with('success',$this->panel . ' updated successfully');;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            Subcategory::destroy($id);
            return redirect()->route($this->base_route . '.index')->with('success',$this->panel . ' deleted successfully');
        } catch (Exception $exception){
            return redirect()->route($this->base_route . '.index')->with('exception',$exception->getMessage());
        }

    }
}
