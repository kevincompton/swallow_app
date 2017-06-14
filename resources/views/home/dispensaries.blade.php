@extends('layouts.app')

@section('content')
<div class="container" id="autocomplete">
    <div class="row">
        <div class="col-md-12">

            <h4>Add Product</h4>

            <div v-if="new_form == false" id="autocomplete">
                <autocomplete-input :options="options" @select="onOptionSelect">
                    <template slot="item" scope="option">
                        <article class="media">
                            <div class="row">
                                <div class="col-md-4">                              
                                  <img :src="option.thumbnail">
                                </div>
                                <div class="col-md-8">
                                    <p><strong>@{{ option.title }}</strong>
                                     <br>
                                    @{{ option.description }}
                                    </p>
                                </div>
                            </div>
                        </article>
                    </template>
                </autocomplete-input>
            </div>

            <script id="autocomplete-input-template" type="text/x-template">
              <div class="autocomplete-input">
                <p class="control has-icon has-icon-right">
                  <input
                    v-model="keyword"
                    class="form-control input-lg"
                    placeholder="Search products or type add new..."
                    @input="onInput($event.target.value)"
                    @keyup.esc="isOpen = false"
                    @blur="isOpen = false"
                    @keydown.down="moveDown"
                    @keydown.up="moveUp"
                    @keydown.enter="select"
                  >
                  <i class="fa fa-angle-down"></i>
                </p>
                <ul v-show="isOpen" class="options-list">
                    <li v-for="(option, index) in fOptions"
                        :class="{'highlighted': index === highlightedPosition}"
                        @mouseenter="highlightedPosition = index"
                        @mousedown="select"
                    >
                        <slot name="item"
                          :title="option.title"
                          :description="option.description"
                          :thumbnail="option.thumbnail"
                        ></slot>
                    </li>
                </ul>
              </div>
            </script>

            <div v-if="confirm != null">
                <p>
                    Add the product <strong>@{{ confirm.title }}</strong>?
                    <button v-on:click="addProduct(confirm.product_id)">Yes</button> <button>cancel</button>
                </p>
            </div>

            <div v-if="new_form" class="product-form">
                @include('partials._new_product')
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">My Products</div>

                <div class="panel-body">
                    
                    <div class="row">
                    
                        <div v-for="product in user_products" v-if="product.id > 0" class="col-md-3">
                            <div class="product">
                                <img :src="product.image" class="img-thumbnail" />
                                <h4>@{{ product.name }}</h4>
                                <small>Strength: @{{ product.strength }}</small>
                                <p>@{{ product.desc }}</p>
                                <p>Ingredients: @{{ product.ingredients }}</p>

                                <a class="btn btn-danger" :href="product.detach">Remove Product</a>
                            </div>
                        </div>
                    
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
