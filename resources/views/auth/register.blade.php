@extends('layouts.client')

@section('body_class', 'body__partners')

@section('content')
    <div class="partners-container onboard" id="onboard-autocomplete">
        <ul class="onboard-toggle">
            <li class="active"><a href="/register">CREATE ACCOUNT</a></li>
            <li><a href="/login">SIGN IN</a></li>
        </ul>

        <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
            {{ csrf_field() }}

            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name" class="col-md-4 control-label">Your Name</label>

                <div class="col-md-6">
                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
                <label for="category" class="col-md-4 control-label">Company Type</label>

                <div class="col-md-6">
                    <select v-on:change="categoryUpdate" v-model="category" class="form-control" id="category" name="category">
                        <option disabled selected>Please select type of company...</option>
                        <option value="dispensary">Dispensary</option>
                        <option value="edibles">Edibles / Topicals</option>
                    </select>

                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('category') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div v-show="category != null" class="form-group{{ $errors->has('company') ? ' has-error' : '' }}">
                <h4>Add Company Name</h4>

                <div v-if="new_form == false" id="onboard_autocomplete">
                    <autocomplete-input v-if="company == null" :options="options" @select="onOptionSelect">
                        <template slot="item" scope="option">
                            <strong>@{{ option.title }}</strong>
                        </template>
                    </autocomplete-input>
                </div>

                <div v-if="company != null">
                    <input type="hidden" name="company_id" :value="company.id"/>
                    <input type="hidden" name="company" :value="company.title"/>
                    <h4>@{{ company.title }} <small><a href="#" v-on:click="clearCompany()">change company</a></small></h4>
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
                        <input type="hidden" :value="keyword" name="company">
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
                        Create profile for <strong>@{{ confirm.title }}</strong>?
                        <button v-on:click="setCompany(confirm)">Yes</button> <button>cancel</button>
                    </p>
                </div>
            </div>

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                <div class="col-md-6">
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password" class="col-md-4 control-label">Password *must be at least 6 characters long</label>

                <div class="col-md-6">
                    <input id="password" type="password" class="form-control" name="password" required>

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                <div class="col-md-6">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-primary">
                        Register
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection


