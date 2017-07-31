<div class="modal edit_company_modal">
    <div class="modal-wrap">
        <i id="cancel" class="fa fa-times-circle-o modal_close" aria-hidden="true"></i>
        <h2>Edit {{ $company->name }}</h2>
        {!! Form::open(['url' => '/company/update' . $company->id, 'files' => true]) !!}
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Company Name</label>
                        <input autofocus name="name" type="text" class="form-control" id="name" value="{{ $company->name }}">
                    </div>
                    <div class="form-group">
                        <label for="phone">Company Phone</label>
                        <input name="phone" type="text" class="form-control" id="phone" value="{{ $company->phone }}">
                    </div>
                </div>
                
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="address">Company Address</label>
                        <input name="address" type="text" class="form-control" id="address" value="{{ $company->address }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="city">City</label>
                        <input name="city" type="text" class="form-control" id="address" value="{{ $company->city }}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="state">State</label>
                        <input name="state" type="text" class="form-control" id="address" value="{{ $company->state }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="zip">Zip</label>
                        <input name="zip" type="text" class="form-control" id="address" value="{{ $company->zip }}">
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-default">update</button>
        {!! Form::close() !!}
    </div>
</div>