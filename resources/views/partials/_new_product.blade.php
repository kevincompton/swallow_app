<div class="modal add_product_modal">
    <div class="modal-wrap">
        <i id="cancel" class="fa fa-times-circle-o modal_close" aria-hidden="true"></i>
        <h3>Add Product</h3>
        {!! Form::open(['url' => '/product/create', 'files' => true]) !!}
            <input name="user_id" type="hidden" value="{{ $user->id }}">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Product Name</label>
                        <input autofocus name="name" type="text" class="form-control" id="name" placeholder="Product Name">
                    </div>
                    <div class="form-group">
                        <label for="strength">CBD Strength</label>
                        <select name="strength_cbd">
                           <option>0-20 mg CBD</option>
                           <option>21-100 mg CBD</option>
                           <option>101-250 CBD</option>
                           <option>251+ mg CDB</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="strength">THC Strength</label>
                        <select name="strength_thc">
                           <option>0-20 mg THC</option>
                           <option>21-100 mg THC</option>
                           <option>101-250 THC</option>
                           <option>251+ mg THC</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="description">Product Description</label>
                        <textarea class="form-control" name="description" id="description" rows="3" placeholder="Product Description"></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="description">Product Ingredients</label>
                        <textarea class="form-control" name="ingredients" id="ingredients" rows="3" placeholder="Product Ingredients"></textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="image">Product Image</label>
                        <input type="file" id="image" name="image">
                        <p class="help-block">Example block-level help text here.</p>
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