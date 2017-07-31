<div class="modal add_dispensary_modal">
    <div class="modal-wrap">
      <i id="cancel" class="fa fa-times-circle-o modal_close" aria-hidden="true"></i>
      <h2>Add Dispensary</h2>

      <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
          {{ csrf_field() }}

        <input type="hidden" v-model="category" value="dispensary" />

        <div v-show="category != null" class="form-group{{ $errors->has('company') ? ' has-error' : '' }}">
                <h4>Add @{{ category }}</h4>

                <div v-if="new_form == false" id="onboard_autocomplete">
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

                <div v-if="company != null">
                    <input type="hidden" name="wpid" :value="company.id"/>
                    <input type="hidden" name="company" :value="company.title"/>
                    <h2>@{{ company.title }} <small><a href="#" v-on:click="clearCompany()">change company</a></small></h2>
                </div>

                <div v-if="new_form" class="product-form">
                    <label for="company" class="col-md-4 control-label">Company Name</label>

                    <div class="col-md-6">
                        <input id="company" type="text" class="form-control" name="company" value="{{ old('company') }}" required>

                        @if ($errors->has('company'))
                            <span class="help-block">
                                <strong>{{ $errors->first('company') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <script id="autocomplete-input-template" type="text/x-template">
                  <div class="autocomplete-input">
                    <p class="control has-icon has-icon-right">
                      <input
                        v-model="keyword"
                        class="form-control input-lg"
                        placeholder="Search companies or type add new..."
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