<template>
    
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <form>
                        <input class="form-control input-lg" type="text" placeholder="Add Product">
                    </form>
                </div>
            </div>
        </div>
    </div>
    
</template>

<script>


        module.exports = {
            props: ['search'],

            data: function () {
                return {
                    products: []
                }
            },

            mounted() {
                this.fetchProducts();

                console.log('fetchProducts');
            },          

            methods: {

              fetchProducts: function() {
                var parent = this;

                $.ajax({
                  type:'GET',
                  url: '/products/',
                  dataType: 'json',
                  async: false,
                  success : function(data) {
                    parent.products = $(data.products);
                  }
                });
              },

            }
        }
    
</script>
