require('./bootstrap');

window.Vue = require('vue');

Vue.component('autocomplete-input', require('./components/Autocomplete.vue'));

var onboard = document.getElementById('onboard-autocomplete');
var autocomplete = document.getElementById('autocomplete');
var company_autocomplete = document.getElementById('company_autocomplete');

if(company_autocomplete != null){

  const app = new Vue({
      el: '#company_autocomplete',

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
        company: null
      },

      mounted() {
        this.fetchCompanies();
      },

      methods: {

        onOptionSelect (option) {

          this.confirmCompany(option);
          
        },

        confirmCompany: function(option) {
          this.confirm = option;
        },

        setCompany: function(company) {
          this.company = company;

          document.dispensary_connect_form.action = "/company/connect/" + this.company.company_id;
          document.dispensary_connect_form.submit();
        },

        clearCompany: function() {
          this.confirm = null;
          this.company = null;
        },

        fetchCompanies: function() {
          var parent = this;

          $.ajax({
            type:'GET',
            url: '/companies/dispensary',
            dataType: 'json',
            async: false,
            success : function(data) {
              var companies = [];

              for (var i = data.companies.length - 1; i >= 0; i--) {
                var company = {
                  title: data.companies[i].name,
                  company_id: data.companies[i].id,
                  meta: data.companies[i].name + data.companies[i].company
                };
                companies.push(company);
              }

              parent.options = companies;
            }
          });
        },

      }

  });

}

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
        this.setCategory();
      },

      methods: {

        onOptionSelect (option) {
          if(option.id == 0) {
            this.new_form = true;
          } else {
            this.confirmCompany(option);
          }
        },

        setCategory: function() {
          this.category = this.getParameterByName('category');
        },

        getParameterByName: function(name, url) {
          if (!url) url = window.location.href;
          name = name.replace(/[\[\]]/g, "\\$&");
          var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
              results = regex.exec(url);
          if (!results) return null;
          if (!results[2]) return '';
          return decodeURIComponent(results[2].replace(/\+/g, " "));
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
                  title: data.companies[i].name,
                  id: data.companies[i].id
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
        product: null
      },

      mounted() {
        this.fetchProducts();
      },

      methods: {

        onOptionSelect (option) {
          if(option.product_id == 0) {
            this.new_form = true;
          } else {
            this.confirmProduct(option);
            this.product = option.product_id;
          }
        },

        confirmProduct: function(id) {
          this.confirm = id;
        },

        addProduct: function(id) {
          var parent = this;

          this.confirm = null;

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
                  product_id: data.products[i].id,
                  meta: data.products[i].name + data.products[i].company
                };
                products.push(product);
              }

              parent.options = products;
            }
          });
        },

      }

  });

}
