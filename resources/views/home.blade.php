@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h3>Customers</h3>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addmodal">
                    <span class="fa fa-plus"></span> Add New Customer
                    </button>
                </div>

                <div class="card-body">
                    {{-- @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif --}}

                    <table class="table table-hover table-strriped">
                        <tr>
                            <th>Customer ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                        <tbody id="allCustomers">

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>



<!-- Add Modal -->
<div class="modal fade" id="addmodal" tabindex="-1" role="dialog" aria-labelledby="addmodalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addmodalLabel"><span class="fa fa-plus"></span> Add New Customer</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form action="" id="customerForm">
            @csrf
            <div class="modal-body">
                    <div class="form-group">
                        <label for="fname">First Name</label>
                        <input type="text" class="form-control" id="fname" aria-describedby="fnameHelp" placeholder="Enter First Name..." autocomplete="off">
                        <small id="fnameHelp" class="form-text text-muted">Your First Name Please.</small>
                        @error('fname')
                            <small class="text-danger"> {{ $message }} </small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="lname">Last Name</label>
                        <input type="text" class="form-control" id="lname" aria-describedby="lnameHelp" placeholder="Enter Last Name..." autocomplete="off">
                        <small id="lnameHelp" class="form-text text-muted">Your Last Name Please.</small>
                        @error('lname')
                            <small class="text-danger"> {{ $message }} </small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter Email Address..." autocomplete="off">
                        <small id="emailHelp" class="form-text text-muted">Your Email Please.</small>
                        @error('email')
                            <small class="text-danger"> {{ $message }} </small>
                        @enderror
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="addbtn">Add Customer</button>
            </div>
        </form>
    </div>
  </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="editmodalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editmodalLabel"><span class="fa fa-plus"></span> Add New Customer</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form action="" id="customerForm">
            @csrf
            <input type="text" name="id" id="id">
            <div class="modal-body">
                    <div class="form-group">
                        <label for="fname">First Name</label>
                        <input type="text" class="form-control" id="fname" aria-describedby="fnameHelp" placeholder="Enter First Name..." autocomplete="off">
                        <small id="fnameHelp" class="form-text text-muted">Your First Name Please.</small>
                        @error('fname')
                            <small class="text-danger"> {{ $message }} </small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="lname">Last Name</label>
                        <input type="text" class="form-control" id="lname" aria-describedby="lnameHelp" placeholder="Enter Last Name..." autocomplete="off">
                        <small id="lnameHelp" class="form-text text-muted">Your Last Name Please.</small>
                        @error('lname')
                            <small class="text-danger"> {{ $message }} </small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter Email Address..." autocomplete="off">
                        <small id="emailHelp" class="form-text text-muted">Your Email Please.</small>
                        @error('email')
                            <small class="text-danger"> {{ $message }} </small>
                        @enderror
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="updatebtn">Save Changes</button>
            </div>
        </form>
    </div>
  </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deltmodal" tabindex="-1" role="dialog" aria-labelledby="deltmodalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deltmodalLabel"><span class="fa fa-trash"></span> Delete Customer</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form action="" id="customerForm">
            @csrf
            <div class="modal-body">
                <input type="hidden" name="id" id="id">
                <h5 class="text-danger">Are You Sure You Want To Delete This Customer?</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                <button type="button" class="btn btn-danger" id="yesdelt" data-dismiss="modal">Yes</button>
            </div>
        </form>
    </div>
  </div>
</div>
@endsection
