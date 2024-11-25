<?php

namespace App\Http\Controllers;

use App\Models\Pessoas;
use Illuminate\Http\Request;

class PessoasController extends Controller
{
    public function index(){
        $list = Pessoas::paginate(60);

        return view('/form', ['list'=>$list]);

    }
    public function save(Request $request){
        $request->validate([
            'nome' => 'required',
            'cpf'=>'required',
            'foto'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'],

            );

        if ($request->hasFile("foto")){
            $file = $request->file("foto");
            $file_name = time()."_".$file->getClientOriginalName();
            $file->move(public_path("assets/images"),$file_name);
            $foto = $file_name;
        }

        if ($request->hasFile("curriculo")){
            $curriculo = $request->file("curriculo");
            $curriculo_name = time()."_".$curriculo->getClientOriginalName();
            $curriculo->move(public_path("assets/curriculos"),$curriculo_name);
            $curr = $curriculo_name;
        }

        $pessoa = new Pessoas();
        $pessoa->nome = $request->input('nome');
        $pessoa->cpf = $request->input('cpf');
        $pessoa->foto = $foto;
        $pessoa->curriculo = $curr;

        $pessoa->save();

        return redirect(route("new"));
    }

    public function update(Request $request , Pessoas $pessoa){

        $nome = $request->input("nome");
        $cpf = $request->input("cpf");

        if ($request->hasFile("foto")){
            $file = $request->file("foto");
            $file_name = time()."_".$file->getClientOriginalName();
            $file->move(public_path("assets/images"),$file_name);
            $foto = $file_name;
        }

        if ($request->hasFile("curriculo")){
            $curriculo = $request->file("curriculo");
            $curriculo_name = time()."_".$curriculo->getClientOriginalName();
            $curriculo->move(public_path("assets/curriculos"),$curriculo_name);
            $curr = $curriculo_name;
        }

        $pessoa->nome = $nome;
        $pessoa->cpf = $cpf;
        $pessoa->foto = $foto;
        $pessoa->curriculo = $curr;
        $pessoa->update();
        return back();
    }

    public function edit(Pessoas $pessoa){
        $list = Pessoas::paginate(60);
        return view("form",["pessoa"=>$pessoa,"list"=>$list]);
    }

    public function delete(Pessoas $pessoa){
        $pessoa->delete();
        return redirect(route('new'));
    }

}
