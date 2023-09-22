public function store(Request $request)
{
    $this->validate($request, [
        'email' => 'required|email:filter',
        'password' => 'required'
    ]);

    // In ra màn hình để kiểm tra kết quả Auth::attempt()
    dd(Auth::attempt([
        'email' => $request->input('email'),
        'password' => $request->input('password')
    ], $request->input('remember')));

    if (Auth::attempt([
        'email' => $request->input('email'),
        'password' => $request->input('password')
    ], $request->input('remember'))) {
        return redirect()->route('admin');
    }

    Session::flash('class', 'error');
    Session::flash('message', 'Email hoặc password không đúng');
    return redirect()->back();
}
