<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\RoleRequest;
use App\Model\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $data['rows'] = Role::all();
            return view('backend.role.index',compact('data'));
        }catch(Exception $e){
            redirect()->route('home')->flash('exception',$e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.role.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        try{
            $request->request->add(['created_by' => auth()->user()->id]);
            $role = Role::create($request->all());
            if($role){
                return redirect()->route('backend.role.index')->with('success','Role Created Successfully');
            }else{
                return back()->with('error','Role Creation Failed');
            }
        }catch(Exception $e){
            return redirect()->route('backend.role.index')->with('exception',$e->getMessage());
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
        $data['row'] = Role::find($id);
        return view('backend.role.show',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['row'] = Role::find($id);
        return view('backend.role.edit',compact('data'));
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
        try {
            $data['row'] = Role::find($id);
            $request->request->add(['updated_by' => auth()->user()->id]);
            $role = $data['row']->update($request->all());
            if ($role) {
                return redirect()->route('backend.role.index')->with('success', 'Role Updated Successfully');
            } else {
                return back()->with('error', 'Role Creation Failed');
            }
        }catch(Exception $e){
            return redirect()->route('backend.role.index')->with('exception',$e->getMessage());
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
        try{
            Role::destroy($id);
            return redirect()->route('backend.role.index')->with('success','Role Deleted Successfully');
        }catch(Exception $e){
            return redirect()->route('backend.role.index')->with('exception',$e.getMessage());

        }
    }
}
