@extends('layouts.client')

@section('body_class', 'body__products')

@section('content')

  <span id="filterable">
    <div class="search-wrapper">

      <div class="search-input">
        <input
          id="keywords"
          name="keywords"
          v-model="keywords"
          class="form-control input-lg search"
          placeholder="Search products..."
        >
        <button type="reset" class="filter">FILTERS <i class="fa fa-angle-down" aria-hidden="true"></i></button>
        <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
      </div>

      <div class="category dropdown" v-for="category in categories">
        <h4>@{{ category.title }}</h4>

        <div v-for="tag in category.tags" class="form-check">
          <label class="form-check-label">
            <input v-on:click="toggleTag(tag)" type="checkbox" class="form-check-input" :value="tag.id">
            @{{ tag.title }}
          </label>
        </div>
      </div>

    </div>

    <div class="flex-container client-wrapper">
      <main>
      <h3>Edibles Directory</h3>
        <section id="product-list">
          <transition-group name="list">
            <div class="product" v-for="(product, index) in filteredProducts" v-bind:key="product" v-if="index < limit">
                <a :href="'/product/' + product.id">
                    <div v-if="product.s3_image" class="product-image">
                      <img :src="product.s3_image" />
                    </div>
                    <div v-else class="logo"><img class="lips" src="/images/logo/logo-lips-black.svg"></div>
                    <div class="info">
                        <h5>@{{ product.name }}</h5>
                        <div class="excerpt">
                            Strength: @{{ product.strength }}
                        </div>
                    </div>
                    <div class="read-more">Read More</div>
                </a>
            </div>
          </transition-group>
        </section>
        
      </main>

      <script id="filter-template" type="text/x-template">
        
      </script>

    </div>
  </span>

@endsection