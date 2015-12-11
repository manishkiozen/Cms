<?php namespace App\Http\Controllers;

use App\Commands\LoginCommand;
use App\Commands\LogoutCommand;
use App\Exceptions\LoginFailedException;
use App\Http\Requests;
use Illuminate\Http\Request;

class SessionController extends Controller {

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('sessions.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
     * @param Request $request
	 * @return Response
	 */
	public function store(Request $request)
	{
        try {
            $this->dispatchFrom(LoginCommand::class, $request);
            flash()->success(trans('authentication.succeeded'));
            return redirect()->route('dashboard');
        }
        catch (LoginFailedException $e) {
            flash()->warning(trans('authentication.failed'));
            return redirect()->route('session.create')->withInput();
        }
    }

	/**
	 * Remove the specified resource from storage.
	 *
	 * @return Response
	 */
	public function destroy()
	{
        $this->dispatchFromArray(LogoutCommand::class, []);
        flash()->info(trans('authentication.logged_out'));
		return redirect()->home();
	}

}
