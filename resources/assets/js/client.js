require('./bootstrap');

window.Vue = require('vue');

Vue.component('filterable', require('./components/Filterable.vue'));
Vue.component('autocomplete-input', require('./components/Autocomplete.vue'));

var filterProducts = document.getElementById('filterable');

var agegate = document.getElementById('age-gate');

if(agegate != null){

  const agegate = new Vue({
    el: '#age-gate',
    data: {
      show: false,
      deny: false
    },

    mounted() {

      console.log('age gate');
      this.gateInit();

    },

    methods: {

      gateInit: function() {

        this.show = true;

      },

      confirm: function() {

        this.show = false;

        $.ajax({
          type:'GET',
          url: '/confirm/age',
          dataType: 'json',
          async: false,
          success : function(data) {}
        });

      },

      cancel: function() {

        this.deny = true;

      },

    },

  });

}

if(filterProducts != null){

  const filterable = new Vue({
    el: '#filterable',
    
    data: {
      products: [],
      categories: [],
      selected: [],
      limit: 50,
      keywords: null,
      latitude: 34.060165,
      longitude: -118.274480
    },

    created() {
      this.fetchTags();
      this.setLocation();
    },

    mounted() {
      this.setHomeFilters();
    },

    computed: {

      filteredProducts: function() {
        var parent = this; 

        if(this.keywords != null && this.keywords.length > 0) {
          const re = new RegExp(parent.keywords, 'i');
          return parent.products.filter(o => o.full_name.match(re));
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

      setHomeFilters: function() {
        var url_string = window.location.href;
        var url = new URL(url_string);

        if(url.searchParams.get("search") != '') {
          $('input.search').val(url.searchParams.get("search"));
        }
        
        var tags = url.searchParams.get("tags");
        if(tags != null) {
          tags = tags.split(',');
          for (var i = tags.length - 1; i >= 0; i--) {
            $("[value=" + tags[i] + "]").trigger('click');
          }
        }

      },

      toggleTag: function(tag) {
        var parent = this;

        if(this.selected.includes(tag)) {
          var p = parent.selected.indexOf(tag);
          parent.selected.splice(p, 1);
        } else {
          parent.selected.push(tag);
        }

      },

      deselectTag: function(tag) {
        $("[value=" + tag.id + "]").trigger('click');
      },

      setLocation: function() {
        var parent = this;

        navigator.geolocation.getCurrentPosition(function(location) {
          parent.latitude = location.coords.latitude;
          parent.longitude = location.coords.longitude;
        });

        this.fetchProducts();

      },

      fetchProducts: function() {
        var parent = this;

        console.log('fetch products');

        $.ajax({
          type:'GET',
          url: '/client/products?latitude=' + parent.latitude + '&longitude=' + parent.longitude,
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

$('.add_product_trigger').on('click', function() {
  $('.add_product_modal').fadeIn();
});

$('.connect_product_trigger').on('click', function() {
  $('.connect_product_modal').fadeIn();
});

$('.add_dispensary_trigger').on('click', function() {
  $('.add_dispensary_modal').fadeIn();
});

$('.edit_company_trigger').on('click', function() {
  $('.edit_company_modal').fadeIn();
});

$('.edit_product_trigger').on('click', function() {
  $(this).parent().addClass('edit_active');
});

$('.modal_close').on('click', function() {
  $('.modal').fadeOut();
});

$('button.filter').on('click', function() {
  $(this).toggleClass('active');
  $('.dropdown').toggleClass('active');
  $(this).find('i').toggleClass('fa-angle-down');
  $(this).find('i').toggleClass('fa-angle-up');
});

$('.dropdown h4').on('click', function() {
  $(this).parent().toggleClass('active');
  $(this).find('i').toggleClass('fa-angle-down');
  $(this).find('i').toggleClass('fa-angle-up');
});

$('a.menu-button').on('click', function() {
  $('nav.mobile-nav').toggleClass('active');
});

