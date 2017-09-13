<div class="modal add_product_modal @if($errors->any()) errors @endif">
    <div class="modal-wrap">
        <i id="cancel" class="fa fa-times-circle-o modal_close" aria-hidden="true"></i>
        <h3>Add Product</h3>
        {!! Form::open(['url' => '/product/create', 'files' => true]) !!}
            <input name="user_id" type="hidden" value="{{ $user->id }}">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name">Product Name</label>
                        <input autofocus name="name" type="text" class="form-control" id="name" placeholder="Product Name">
                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="strength">CBD Strength</label>
                        <select name="strength_cbd">
                           <option>0-20 mg CBD</option>
                           <option>21-100 mg CBD</option>
                           <option>101-250 mg CBD</option>
                           <option>251+ mg CDB</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="strength">THC Strength</label>
                        <select name="strength_thc">
                           <option>0-20 mg THC</option>
                           <option>21-100 mg THC</option>
                           <option>101-250 mg THC</option>
                           <option>251+ mg THC</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                        <label for="description">Product Description</label>
                        <textarea class="form-control" name="description" id="description" rows="3" placeholder="Product Description"></textarea>
                        @if ($errors->has('description'))
                            <span class="help-block">
                                <strong>{{ $errors->first('description') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group{{ $errors->has('ingredients') ? ' has-error' : '' }}">
                        <label for="ingredients">Product Ingredients</label>
                        <textarea class="form-control" name="ingredients" id="ingredients" rows="3" placeholder="Product Ingredients"></textarea>
                        @if ($errors->has('ingredients'))
                            <span class="help-block">
                                <strong>{{ $errors->first('ingredients') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                        <label for="image">Product Image</label>
                        <input type="file" id="image" name="image">
                        
                        @if ($errors->has('image'))
                            <span class="help-block">
                                <strong>{{ $errors->first('image') }}</strong>
                            </span>
                        @endif
                    </div>  
                </div>
            </div>

            <div class="filters">
                <h3>Filters</h3>

                @foreach($tags as $tag)
                    <div class="filter">
                        <input name="filter[]" value="{{ $tag->id }}" type="checkbox">
                        <label>{{ $tag->title }}</label>
                    </div>
                @endforeach
            </div>

            <button type="submit" class="btn btn-default">Submit</button>
        {!! Form::close() !!}
    </div>
</div>