
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('autocomplete-input', require('./components/Autocomplete.vue'));

var onboard = document.getElementById('onboard-autocomplete');
var autocomplete = document.getElementById('autocomplete');

if(onboard != null){

  const app2 = new Vue({
      el: '#onboard-autocomplete',

      data: {
        options: [
          {
            title: 'First Scene'
          },
          {
            title: 'Second Scene'
          },
          {
            title: 'Third Scene'
          },
          {
            title: 'Fourth Scene'
          }
        ],
        category: null,
        new_form: false,
        confirm: null,
        company: null
      },

      mounted() {
        this.fetchCompanies(this.category);
      },

      methods: {

        onOptionSelect (option) {
          if(option.id == 0) {
            this.new_form = true;
          } else {
            this.confirmCompany(option);
          }
        },

        confirmCompany: function(id) {
          this.confirm = id;
        },

        setCompany: function(company) {
          this.company = company;
          console.log(company);
        },

        clearCompany: function() {
          this.confirm = null;
          this.company = null;
        },

        categoryUpdate: function() {
          this.fetchCompanies(this.category);
        },

        fetchCompanies: function() {
          var parent = this;

          console.log('companies');

          $.ajax({
            type:'GET',
            url: '/companies/' + parent.category,
            dataType: 'json',
            async: false,
            success : function(data) {
              var companies = [];

              for (var i = data.companies.length - 1; i >= 0; i--) {
                var company = {
                  title: data.companies[i].post_title,
                  id: data.companies[i].ID
                };
                companies.push(company);
              }

              companies.push({title: 'Add new company...', id: 0});

              parent.options = companies;
            }
          });
        },

      }

  });
} else if(autocomplete != null) {

  const app = new Vue({
      el: '#autocomplete',

      data: {
        options: [
          {
            title: 'First Scene',
            description: 'lorem ipsum dolor amet.',
            thumbnail: 'http://lorempicsum.com/nemo/200/200/1',
            meta: 'hgkj'
          },
          {
            title: 'Second Scene',
            description: 'lorem ipsum dolor amet.',
            thumbnail: 'http://lorempicsum.com/nemo/200/200/2',
            meta: 'hgkj'
          },
          {
            title: 'Third Scene',
            description: 'lorem ipsum dolor amet.',
            thumbnail: 'http://lorempicsum.com/nemo/200/200/3',
            meta: 'hgkj'
          },
          {
            title: 'Fourth Scene',
            description: 'lorem ipsum dolor amet.',
            thumbnail: 'http://lorempicsum.com/nemo/200/200/4',
            meta: 'hgkj'
          }
        ],
        new_form: false,
        confirm: null,
        user_products: []
      },

      mounted() {
        this.fetchProducts();
        this.fetchUserProducts();
      },

      methods: {

        onOptionSelect (option) {
          if(option.product_id == 0) {
            this.new_form = true;
          } else {
            this.confirmProduct(option);
          }
        },

        confirmProduct: function(id) {
          this.confirm = id;
        },

        addProduct: function(id) {
          var parent = this;

          this.confirm = null;

          console.log('add product ' + id);
          $.ajax({
            type:'GET',
            url: '/product/link/' + id,
            dataType: 'json',
            async: false,
            success : function(data) {
              parent.fetchUserProducts();
            }
          });
        },

        fetchUserProducts: function() {
          var parent = this;

          $.ajax({
            type:'GET',
            url: '/user/products/',
            dataType: 'json',
            async: false,
            success : function(data) {
              for (var i = data.products.length - 1; i >= 0; i--) {
                data.products[i].image = "/images/products/" + data.products[i].image;
                data.products[i].edit = "/product/edit/" + data.products[i].id;
                data.products[i].detach = "/product/detach/" + data.products[i].id;
              }
              parent.user_products = data.products;
            }
          });
        },

        fetchProducts: function() {
          var parent = this;

          $.ajax({
            type:'GET',
            url: '/products/',
            dataType: 'json',
            async: false,
            success : function(data) {
              var products = [];

              for (var i = data.products.length - 1; i >= 0; i--) {
                var product = {
                  title: data.products[i].name,
                  description: data.products[i].company,
                  thumbnail: '/images/products/' + data.products[i].image,
                  product_id: data.products[i].id,
                  meta: data.products[i].name + data.products[i].company
                };
                products.push(product);
              }

              products.push({title: 'Add new product...', description: null, image: null, product_id: 0, meta: 'Add new product'});

              parent.options = products;
            }
          });
        },

      }

  });

}
