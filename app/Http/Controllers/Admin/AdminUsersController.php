<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\AdminUsersEditFormRequest;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Http\Request;
use Sentinel;


class AdminUsersController extends Controller
{
    /**
     * @var $user
     */
    protected $user;


    public function __construct(UserRepositoryInterface $user)
    {
        $this->user = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $users = $this->user->getAll();
        $admin = Sentinel::findRoleByName('Admins');
        return view('protected.admin.list_users')->withUsers($users)->withAdmin($admin);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $user = $this->user->find($id);
        $user_role = $user->roles->first()->name;

        return view('protected.admin.show_user')->withUser($user)->withUserRole($user_role);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
        //Populate the select(dropdowns)
        $roles = Sentinel::getRoleRepository()->all();
        
        $array_roles = [];

        foreach ($roles as $role) {
            $array_roles = array_add($array_roles, $role->id, $role->name);
        }
        
        // Show the page
        return view('protected.admin.create_user', ['roles' => $array_roles]);
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(AdminUsersEditFormRequest $request)
    {
        //          
        $input = $request->only('email', 'password', 'first_name', 'last_name');

        $user = Sentinel::registerAndActivate($input);  
        
        // Ge the role from dropdown
        $account_type = $request->input('account_type');
	    // Find the role using the role name
	    $role = Sentinel::findRoleById($account_type);	
	    // Assign the role to the users    	    
		
	    $role->users()->attach($user);
	                    
        return \Redirect::route('manage.admin.profiles.index')
            ->with('success', 'User (and password) has been created successfully!');
    }    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $user = $this->user->find($id);

        $roles = Sentinel::getRoleRepository()->all();

        $user_role = $user->roles->first()->id;

        $array_roles = [];

        foreach ($roles as $role) {
            $array_roles = array_add($array_roles, $role->id, $role->name);
        }

        return view('protected.admin.edit_user', ['user' => $user, 'roles' => $array_roles, 'user_role' =>$user_role]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, AdminUsersEditFormRequest $request)
    {
        $user = $this->user->find($id);

        if (! $request->has("password")) {
            $input = $request->only('email', 'first_name', 'last_name');

            $user->fill($input)->save();

            $this->user->updateRole($id, $request->input('account_type'));

            return redirect()->route('manage.admin.profiles.edit', $user->id)
                             ->with('success', 'User has been updated successfully!');

        } else {
            $input = $request->only('email', 'first_name', 'last_name', 'password');

            $user->fill($input);
            $user->password = \Hash::make($request->input('password'));
            $user->save();

            $this->user->updateRole($id, $request->input('account_type'));

            return redirect()->route('manage.admin.profiles.edit', $user->id)
                             ->with('success', 'User (and password) has been updated successfully!');
        }
    }
}
