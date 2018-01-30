<?php

namespace App\Http\Controllers\Question;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Subjects;
use App\Models\Options;
class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Subjects $subjects,Options $options)
    {
        $this->Subjects = $subjects;
        $this->Options = $options;
    }

    public function index(Request $request)
    {
        $data=$request->all();
        $this->Subjects->create($data);
        return view('admin.wenti');
    }
    public function xuanxiang(){
        $subject=$this->Subjects->get();
        return view('admin.options', compact('subject'));
    }
    public function options(Request $request)
    {
        $data=$request->all();
        $this->Options->create($data);
        return view('admin.wenti');
    }
    public function list(Request $request){
        $subject=$this->Subjects->get();
//        dd($subjects);
        $option=$this->Options->get();
//        dd($option);
        return view('admin.subject_list',compact('subject','option'));
    }
    public function edit($id){
//     $this->options()
       $model=$this->Options->find($id);

       return view('admin.edit_question',compact('model'));

    }

    /**
     * 集团网站主页
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function nav(Request $request)
    {

    }
}
