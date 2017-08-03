<div class="modal connect_product_modal" id="autocomplete">
    <div class="modal-wrap">
        <i id="cancel" class="fa fa-times-circle-o modal_close" aria-hidden="true"></i>
        <h2>Add Product</h2>
        {!! Form::open(['url' => '/product/link']) !!}

            <div v-if="new_form == false">
                <autocomplete-input :options="options" @select="onOptionSelect">
                    <template slot="item" scope="option">
                        <strong>@{{ option.title }}</strong>
                    </template>
                </autocomplete-input>
            </div>

            <script id="autocomplete-input-template" type="text/x-template">
              <div class="autocomplete-input">
                <p class="control has-icon has-icon-right">
                  <input
                    v-model="keyword"
                    class="form-control input-lg"
                    name="product"
                    placeholder="Search products..."
                    @input="onInput($event.target.value)"
                    @keyup.esc="isOpen = false"
                    @blur="isOpen = false"
                    @keydown.down="moveDown"
                    @keydown.up="moveUp"
                    @keydown.enter="select"
                  >
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
                        ></slot>
                    </li>
                </ul>
              </div>
            </script>

            <div v-if="confirm">
                <p>
                    Add the product <strong>@{{ confirm.title }}</strong>?
                    <button v-on:click="addProduct(confirm.product_id)">Yes</button> <button>cancel</button>
                </p>
            </div>

            <div v-if="product != null">
                <input type="hidden" name="product_id" :value="product" />
            </div>

            <button type="submit" class="btn btn-default">Submit</button>
        {!! Form::close() !!}
    </div>
</div>