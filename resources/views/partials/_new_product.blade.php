<div class="modal add_product_modal">
    <div class="modal-wrap">
        <i id="cancel" class="fa fa-times-circle-o modal_close" aria-hidden="true"></i>
        <h2>Add Product</h2>
        {!! Form::open(['url' => '/product/create', 'files' => true]) !!}
            <input name="user_id" type="hidden" value="{{ $user->id }}">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Product Name</label>
                        <input autofocus name="name" type="text" class="form-control" id="name" placeholder="Product Name">
                    </div>
                    <div class="form-group">
                        <label for="strength">Product Strength</label>
                        <input name="strength" type="text" class="form-control" id="strength" placeholder="Product Strength">
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
            <button type="submit" class="btn btn-default">Submit</button>
        {!! Form::close() !!}
    </div>
</div>