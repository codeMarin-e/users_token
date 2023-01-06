                    <div class="form-group row">
                        <div class="col-lg-12">
                            <label class="col-form-label">@lang('admin/users/user.packages_token')</label>
                            <input type="text"
                                   class="form-control"
                                   readonly="readonly"
                                   value="@if(isset($chUser) && $chUser->packages_token){{base64_encode($chUser->packages_token)}}@endif"
                            />
                        </div>
                    </div>
