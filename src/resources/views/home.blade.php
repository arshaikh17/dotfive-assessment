@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in!
                </div>
            </div>
            @if($admin == 1)
                <div class="panel panel-primary">
                    <div class="panel-heading">Access Rights</div>
                    <div class="panel-body">
                        <em>Since, this account has admin privileges, so it can invoke other users rights. Currently, only add or update privileges can be changed</em>
                        <table class="table table-responsive table-condensed table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Add privilege</th>
                                    <th>Update privilege</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($users_with_rights as $user)
                                <tr>
                                    <td>{{$user['user']->name}}</td>
                                    <td>
                                        @if($user['rights']['add'] == 1)
                                        <span class="badge" style="background-color:green">YES</span>
                                        <form method="POST" action="/user/invoke_privilege">
                                            {{csrf_field()}}
                                            <input type="text" class="hidden" name="privilege" required value="add" />
                                            <input type="text" class="hidden" name="user" value="{{ $user['user']->id }}" submit />
                                            <input type="text" class="hidden" name="trigger_val" value="0" required>
                                            <input type="submit" class="btn btn-sm btn-danger" value="take away">
                                        </form>
                                        @else
                                        <span class="badge" style="background-color: red">NO</span>
                                        <form method="POST" action="/user/invoke_privilege">
                                            {{csrf_field()}}
                                            <input type="text" class="hidden" name="privilege" required value="add" />
                                            <input type="text" class="hidden" name="user" value="{{ $user['user']->id }}" />
                                            <input type="text" class="hidden" name="trigger_val" value="1" required>
                                            <input type="submit" class="btn btn-sm btn-success" value="give">
                                        </form>
                                        @endif
                                    </td>
                                    <td>
                                        @if($user['rights']['update'] == 1)
                                        <span class="badge" style="background-color:green">YES</span>
                                        <form method="POST" action="/user/invoke_privilege">
                                            {{csrf_field()}}
                                            <input type="text" class="hidden" name="privilege" required value="update" />
                                            <input type="text" class="hidden" name="user" value="{{ $user['user']->id }}" submit />
                                            <input type="text" class="hidden" name="trigger_val" value="0" required>
                                            <input type="submit" class="btn btn-sm btn-danger" value="take away">
                                        </form>
                                        @else
                                        <span class="badge" style="background-color: red">NO</span>
                                        <form method="POST" action="/user/invoke_privilege">
                                            {{csrf_field()}}
                                            <input type="text" class="hidden" name="privilege" required value="update" />
                                            <input type="text" class="hidden" name="user" value="{{ $user['user']->id }}" />
                                            <input type="text" class="hidden" name="trigger_val" value="1" required>
                                            <input type="submit" class="btn btn-sm btn-success" value="give">
                                        </form>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr><td>No user in database</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
