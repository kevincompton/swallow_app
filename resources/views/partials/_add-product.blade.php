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