<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

use Auth;
use Hash;

class UserController extends Controller
{
    //-------------------- adminpanel. список пользователей
    public function index()
    {
        $roles=array('admin','manager','user','guest');
        $users = User::orderBy('name','asc')->get();
        return view('users.index', compact('users','roles'));
    }

    //-------------------- adminpanel. list users by role
    public function userByrole(Request $request)
    {
        $roles=array('admin','manager','user','guest');
        $data = $request->all();//данные, переданы формой
        $selectRole=$data['role'];
        if($data['role']=="0") {
            return redirect('/users');//возврат на полный список users
        } else {
            $users = User::where('role', 'LIKE', $data['role']) ->get();
            return view('users.index', compact('users', 'roles', 'selectRole'));
        }
    }

    //-------------------- adminpanel. вввод данных нового пользователя
    public function create()
    {
        $users = User::orderBy('name', 'asc')->get();
        $roles=array('admin','manager','user','guest');
        return view('users.create', compact('users', 'roles'));
    }

    //-------------------- adminpanel. запись в БД нового пользователя
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required',
        ]);
        $data = $request->all();//данные переданы формой
        if (!empty($request->file('image')) ) {
            $filename = $request->file('image')->getClientOriginalName();//имя файла картинки
            $data['image'] = $filename;//записали имя в базу (INSERT)
        }else{
            $data['image'] = "profile.jpg";
        }
        $data['password'] = Hash::make($request->password);
        //---------------запрос на добавление пользователя
        User::create($data);
        $file = $request->file('image');//путь исходной картинки
        if(isset($filename)) {
            $file->move('../public/images/avatar/',$filename);//загрузка изображения
        }
        return redirect('users');
    }

    //----------------------adminpanel. редактирование профиля
    public function edit(User $user)
    {
        $roles=array('admin', 'manager', 'user','guest');
        return view('users.edit', compact('user', 'roles'));
    }

    //---------------------adminpanel. запись отредактированных данных профиля
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:255'
        ]);
        if($request->file('image')) {
            $oldimage =$user -> image;
            $filename = $request->file('image')->getClientOriginalName();//имя файла картинки
            $file = $request->file('image');//путь исходной картинки
            if($filename) {
                $file->move('../public/images/avatar/',$filename);//загрузка изображения
            }
        }
        if(!isset($request->role)) $request->role=Auth::user()->role;
        if($request->password) {//если пароль меняют
            $request->validate([
                'password' => 'required|string|min:6|confirmed',
                'password_confirmation' => 'required',
            ]);
            if(!empty($request->file('image'))){
                $user->update([
                    'name' => $request->name,
                    'address' => $request->address,
                    'phone' => $request->phone,
                    'password' => Hash::make($request->password),
                    'role' => $request->role,
                    'image' => $filename,
                ]);
                if(!empty($oldimage) && $oldimage != 'profile.jpg' && file_exists('../public/images/avatar/'.$oldimage)){
                    unlink('../public/images/avatar/'.$oldimage);
                }
            }else{
                $user->update([
                    'name' => $request->name,
                    'address' => $request->address,
                    'phone' => $request->phone,
                    'password' => Hash::make($request->password),
                    'role' => $request->role,
                ]);
            }
        } else {//пароль НЕ меняют
            if(!empty($request->file('image'))){
                $user -> update([
                    'name' => $request -> name,
                    'address' => $request->address,
                    'phone' => $request->phone,
                    'role' => $request -> role,
                    'image' => $filename,
                ]);
                if(!empty($oldimage) && $oldimage != 'profile.jpg' && file_exists('../public/images/avatar/'.$oldimage)){
                    unlink('../public/images/avatar/'.$oldimage);
                }
            }else{
                $user -> update([
                    'name' => $request -> name,
                    'address' => $request->address,
                    'phone' => $request->phone,
                    'role' => $request -> role,
                ]);
            }
        }
        return redirect('/users');
    }

    //-----------------------mainSite. заполнение формы Register(регистрация пользователя)
    public function register() {
        return view('users.register');
    }

    //-----------------------mainSite. запись данных из формы Register(регистрация пользователя) в БД
    public function userStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required',
        ]);
        $data = $request->all();//данные переданы формой
        if (!empty($request->file('image')) ) {
            $filename = $request->file('image')->getClientOriginalName();//имя файла картинки
            $data['image'] = $filename;//записали имя в базу (INSERT)
        }else{
            $data['image'] = "profile.jpg";
        }
        $data['password'] = Hash::make($request->password);
        $data['role'] = "user";
        //---------------запрос на добавление пользователя
        User::create($data);
        $file = $request->file('image');//путь исходной картинки
        if(isset($filename)) {
            $file->move('../public/images/avatar/',$filename);//загрузка изображения
        }
        return view('users/regSuccess');//выдаём сообщение об успешной регистрации
    }

    //--------------------------mainSite. вход в аккаунт (доступно для аутентифицировавшегося пользователя)
    public function account(User $user)
    {
        return view('users.profile', compact('user'));
    }

    //--------------------------mainSite. редактирование профиля аутентифицировавшегося пользователя
    public function editaccount(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:255'
        ]);
        if($request->file('image')) {
            $oldimage =$user -> image;
            $filename = $request->file('image')->getClientOriginalName();//имя файла картинки
            $file = $request->file('image');//путь исходной картинки
            if($filename) {
                $file->move('../public/images/avatar/',$filename);//загрузка изображения
            }
        }
        if(!isset($request->role)) $request->role=Auth::user()->role;
        if($request->password) {//если пароль меняют
            $request->validate([
                'password' => 'required|string|min:6|confirmed',
                'password_confirmation' => 'required',
            ]);
            if(!empty($request->file('image'))){
                $user->update([
                    'name' => $request->name,
                    'address' => $request->address,
                    'phone' => $request->phone,
                    'password' => Hash::make($request->password),
                    'image' => $filename,
                ]);
                if(!empty($oldimage) && $oldimage != 'profile.jpg' && file_exists('../public/images/avatar/'.$oldimage)){
                    unlink('../public/images/avatar/'.$oldimage);
                }
            }else{
                $user->update([
                    'name' => $request->name,
                    'address' => $request->address,
                    'phone' => $request->phone,
                    'password' => Hash::make($request->password),
                    'role' => $request->role,
                ]);
            }
        } else {//пароль НЕ меняют
            if(!empty($request->file('image'))){
                $user -> update([
                    'name' => $request -> name,
                    'address' => $request->address,
                    'phone' => $request->phone,
                    'role' => $request -> role,
                    'image' => $filename,
                ]);
                if(!empty($oldimage) && $oldimage != 'profile.jpg' && file_exists('../public/images/avatar/'.$oldimage)){
                    unlink('../public/images/avatar/'.$oldimage);
                }
            }else{
                $user -> update([
                    'name' => $request -> name,
                    'address' => $request->address,
                    'phone' => $request->phone,
                    'role' => $request -> role,
                ]);
            }
        }
        return redirect('/account/'.$user -> id)->with('success', 'Your data has been successfully updated!');
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    public function destroy(User $user)
    {
        //
    }

}
