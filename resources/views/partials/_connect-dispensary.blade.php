<div id="company_autocomplete" class="modal add_dispensary_modal">
    <div class="modal-wrap">
      <i id="cancel" class="fa fa-times-circle-o modal_close" aria-hidden="true"></i>
      <h2>Add Dispensary</h2>

      <form name="dispensary_connect_form" class="form-horizontal" role="form" method="POST" action="#">
          {{ csrf_field() }}

        <div class="form-group{{ $errors->has('company') ? ' has-error' : '' }}">

                <div v-if="new_form == false">
                    <autocomplete-input v-if="company == null" :options="options" @select="onOptionSelect">
                        <template slot="item" scope="option">
                            <article class="media">
                                <div class="row">
                                    <div class="col-md-4">                              
                                      <img :src="option.thumbnail">
                                    </div>
                                    <div class="col-md-8">
                                        <p><strong>@{{ option.title }}</strong>
                                         <br>
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
                        placeholder="Search dispensaries..."
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
                            ></slot>
                        </li>
                    </ul>
                  </div>
                </script>

                <div v-if="confirm != null">
                    <p v-if="company == null">
                        Add the company <strong>@{{ confirm.title }}</strong>?
                        <button v-on:click="setCompany(confirm)">Yes</button> <button>cancel</button>
                    </p>
                </div>
            </div>

        </form>

    </div>
</div>