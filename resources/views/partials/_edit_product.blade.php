{!! Form::open(['url' => '/product/update/' . $product->id, 'files' => true, 'method' => 'PUT']) !!}

  <div class="row">
      <div class="col-md-6">
          <div class="form-group">
              <label for="name">Product Name</label>
              <input autofocus name="name" type="text" class="form-control" id="name" placeholder="Product Name" value="{{ $product->name }}">
          </div>
          <div class="form-group">
              <label for="strength">Product Strength</label>
              <input name="strength" type="text" class="form-control" id="strength" placeholder="Product Strength" value="{{ $product->strength }}">
          </div>
      </div>
      <div class="col-md-6">
          <div class="form-group">
              <label for="description">Product Description</label>
              <textarea class="form-control" name="description" id="description" rows="3" placeholder="Product Description">{{ $product->description }}</textarea>
          </div>
      </div>
  </div>
  <div class="row">
      <div class="col-md-6">
          <div class="form-group">
              <label for="description">Product Ingredients</label>
              <textarea class="form-control" name="ingredients" id="ingredients" rows="3" placeholder="Product Ingredients">{{ $product->ingredients }}</textarea>
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
  <button type="submit" class="btn btn-default">Update</button>

{!! Form::close() !!}