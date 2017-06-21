require('./bootstrap');

window.Vue = require('vue');

Vue.component('filterable', require('./components/Filterable.vue'));
Vue.component('autocomplete-input', require('./components/Autocomplete.vue'));

var filterProducts = document.getElementById('filterable');

if(filterProducts != null){

  const filterable = new Vue({
    el: '#filterable',
    
    data: {
      products: [],
      categories: [],
      selected: [],
      paginate: ['products'],
      limit: 50,
      keywords: null
    },

    mounted() {
      this.fetchProducts();
      this.fetchTags();
    },

    computed: {

      filteredProducts: function() {
        var parent = this; 

        if(this.keywords != null && this.keywords.length > 0) {
          const re = new RegExp(parent.keywords, 'i');
          return parent.products.filter(o => o.name.match(re));
        }

        return parent.products.filter(function (product) {
        
          if(parent.selected.length == 0) {
            return true;
          } else {

            for (var i = parent.selected.length - 1; i >= 0; i--) {
              if(parent.selected[i].products.includes(product.id)) {
                
              } else {
                return false;
              }
            }

            return true;

          }

        });

        
      },

    },

    methods: {

      toggleTag: function(tag) {
        var parent = this;

        if(this.selected.includes(tag)) {
          var p = parent.selected.indexOf(tag);
          parent.selected.splice(p, 1);
        } else {
          parent.selected.push(tag);
        }

      },

      fetchProducts: function() {
        var parent = this;

        $.ajax({
          type:'GET',
          url: '/client/products',
          dataType: 'json',
          async: false,
          success : function(data) {

            parent.products = data.products;

          }
        });

      },

      fetchTags: function() {
        var parent = this;

        $.ajax({
          type:'GET',
          url: '/client/tags',
          dataType: 'json',
          async: false,
          success : function(data) {
            
            parent.categories = data.categories;

          }
        });

      },

    },

  });

}

