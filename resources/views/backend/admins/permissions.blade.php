@foreach ($data as $d)
                       
                        
                        <div class="col-md-3 c-inputs-stacked">
                            <div class="form-check">
                                <input type="checkbox" id="customRadio16" name="permission_id[]"
                                    class="form-check-input" value="{{ $d->id }}" 
                                    @foreach ($data2_ as $d2){{ 
                                    ($d->permission_id == $d2->id ? 'checked':($d->id == $d2->id  ? 'checked':'')) 
                                    }}  @endforeach
                                     />
                                <label class="form-check-label" for="customRadio16">{{ $d->name }}</label>
                            </div>

                        </div>
                       
                       
                        @endforeach